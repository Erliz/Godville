<?php
/**
 * User: Elio
 * Date: 17.11.12
 *
 * @property stdClass[] inventory
 * @property mixed      quest
 * @property mixed      gender
 * @property mixed      diary_last
 * @property mixed      town_name
 */

class Hero
{
    public $name;
    /** @var \PDO */
    protected $dbh;

    function __construct($name)
    {
        $this->dbh = Registry::$db;
        $this->name = $name;
    }

    public function logInventory()
    {
        if (empty($this->inventory)) {
            return;
        }
        $stmt = $this->dbh->prepare(
            "
            INSERT INTO `items`
              (`title`,`price`,`description`,`godpower`)
              VALUE (?,?,?,?)
        "
        );
        foreach ($this->inventory as $item => $info) {
            $stmt->execute(
                array(
                    $item,
                    $info->price,
                    (isset($info->description)) ? : '',
                    (isset($info->godpower)) ? : 0,
                )
            );
        }
    }

    public function logQuest()
    {
        if (empty($this->quest)) {
            return;
        }
        $stmt = $this->dbh->prepare(
            "
            INSERT INTO `quests`
              (`title`)
              VALUE (?)
        "
        );
        $stmt->execute(array($this->quest));
    }

    public function logDiary(){
        if (empty($this->diary_last)) {
            return;
        }
        $stmt = $this->dbh->prepare(
            "
            INSERT INTO `diary`
              (`text`,`sex`,`in_city`)
              VALUE (?,?,?);
        "
        );
        $stmt->execute(
            array(
                $this->diary_last,
                $this->gender,
                (empty($this->town_name))?0:1,
            )
        );
    }

    public static function fromJson(stdClass $data)
    {
        foreach ($data as $field => $value) {
            if ($field == 'name') {
                $instance = new Hero($data->name);
            }
            if ($instance) {
                if($field=='gender'){
                    $instance->$field = $value=="female"?0:1;
                } else {
                    $instance->$field = $value;
                }
            } else {
                throw new Exception('Name is not first filed');
            }
        }

        return $instance;
    }
}


/*
class stdClass#2 (24) {
  public $name =>
  string(5) ""
  public $godname =>
  string(5) ""
  public $gender =>
  string(6) "female"
  public $gold_approx =>
  string(23) "около 5 сотен"
  public $level =>
  int(11)
  public $quest =>
  string(79) "сыграть ноктюрн на флейте водосточных труб"
  public $quest_progress =>
  int(89)
  public $exp_progress =>
  int(42)
  public $health =>
  int(4)
  public $max_health =>
  int(140)
  public $inventory_num =>
  int(9)
  public $inventory_max_num =>
  int(12)
  public $alignment =>
  string(22) "миролюбивый"
  public $motto =>
  string(22) "For the shadow of moon"
  public $clan =>
  string(0) ""
  public $diary_last =>
  string(181) "Огнегривый Лев вдруг сложил лапы и что-то быстро зашептал. К кому ты обращаешься, балбе... Ай! Молния!"
  public $temple_completed_at =>
  NULL
  public $town_name =>
  string(0) ""
  public $distance =>
  int(139)
  public $arena_fight =>
  bool(false)
  public $inventory =>
  class stdClass#3 (9) {
    public $кольцо от парашюта =>
    class stdClass#4 (3) {
      public $cnt =>
      int(1)
      public $pos =>
      int(0)
      public $price =>
      int(0)
    }
    public $шоколадную медальку =>
    class stdClass#5 (3) {
      public $cnt =>
      int(1)
      public $pos =>
      int(1)
      public $price =>
      int(0)
    }
    public $бумажного журавлика =>
    class stdClass#6 (3) {
      public $cnt =>
      int(1)
      public $pos =>
      int(2)
      public $price =>
      int(0)
    }
    public $логарифмический абак =>
    class stdClass#7 (3) {
      public $cnt =>
      int(1)
      public $pos =>
      int(3)
      public $price =>
      int(0)
    }
    public $тайну третьего рейса =>
    class stdClass#8 (3) {
      public $cnt =>
      int(1)
      public $pos =>
      int(4)
      public $price =>
      int(0)
    }
    public $дробный трофей (½ шт) =>
    class stdClass#9 (3) {
      public $cnt =>
      int(1)
      public $pos =>
      int(5)
      public $price =>
      int(0)
    }
    public $клубок чемпионов =>
    class stdClass#10 (3) {
      public $cnt =>
      int(1)
      public $pos =>
      int(6)
      public $price =>
      int(0)
    }
    public $слиток коаксиала =>
    class stdClass#11 (3) {
      public $cnt =>
      int(1)
      public $pos =>
      int(7)
      public $price =>
      int(0)
    }
    public $синюю пиццу =>
    class stdClass#12 (3) {
      public $cnt =>
      int(1)
      public $pos =>
      int(8)
      public $price =>
      int(0)
    }
  }
  public $bricks_cnt =>
  int(8)
  public $godpower =>
  int(61)
  public $clan_position =>
  string(10) "фанат"
}

*/

<?php
/**
 * User: Elio
 * Date: 17.11.12
 *
 */
include_once('classes/autoloader.php');
Autoloader::init();

ini_set('default_charset', 'UTF-8');

$config = Array(
    "iniPath" => "conf.ini",
    "userDb"  => "user_base.ini",
    "url"     => "http://godville.net/gods/api/",
    "format"  => "json"
);

$ini = parse_ini_file($config['iniPath'], true);
$dbConf = $ini["data_base"];
Registry::$db = new PDO('mysql:host=' . $dbConf['host'] . ';dbname=' . $dbConf['database'], $dbConf['user'], $dbConf['passwd']);
Registry::$db->exec('SET CHARACTER SET '.$dbConf['charset']);
Registry::$db->exec('SET NAMES '.$dbConf['charset']);

$userList = explode(
    "\r\n",
    file_get_contents($config['userDb'])
);

foreach ($userList as $user) {
    $answer = file_get_contents($config['url'] . $user . "." . $config['format']);
    $data = json_decode($answer);
    $hero = Hero::fromJson($data);
    $hero->logInventory();
    $hero->logQuest();
    $hero->logDiary();
}
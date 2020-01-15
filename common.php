<?php
$serverRoot = __DIR__;

require('vendor/autoload.php');

use Illuminate\Database\Capsule\Manager as DB;
use Illuminate\Http\Request;
use Nameday\Config\Config;

$configuration = include($serverRoot . '/config/config.php');
Config::setConfig($configuration);

date_default_timezone_set($configuration['timeZone']);

$capsule = new DB;
$capsule->addConnection($configuration['DB']);
$capsule->setAsGlobal();
$capsule->bootEloquent();

// Ha még nem létezik a tábla autómatikusan létrehozzuk
$schema = DB::schema();
if (!$schema->hasTable("namedays")) {
	DB::statement(file_get_contents($serverRoot . '/sql/namedays.sql'));
}
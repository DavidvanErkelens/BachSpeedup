<?php
require_once 'vendor/autoload.php';
require_once 'config.php';
$load = new AutoIncluder(__DIR__, array(__DIR__ . '/vendor'));

$sql = new SqlFramework\SqlFramework($config, __DIR__ . '/tables');

$sql->createTables();
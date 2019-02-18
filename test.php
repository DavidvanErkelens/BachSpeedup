<?php
// Require composer classes
require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/config.php';

// AutoIncluder
$load = new AutoIncluder(__DIR__, array(__DIR__ . '/vendor'));

// Create backend
$backend = new Backend($config);

// $x = $backend->worktrack(1);

// var_dump($x->trackIDs());

// $x = $backend->track(81);

// echo $x->duration();

$work = $backend->work(1);
// $work->findDuplicates(true);
// echo $work->name() . PHP_EOL . PHP_EOL;
// var_dump($work->plotData());

var_dump($work->fitLine());
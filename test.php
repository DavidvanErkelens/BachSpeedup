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
echo $work->name() . PHP_EOL;

$tracks = $backend->worktrack(2);

echo $tracks->durationString();


// $filter = WorkTracksFilter::create();
// $filter->setWork($work);

// foreach ($backend->worktracks($filter) as $wtracks)
// {
//     // Get the release
//     $release = $wtracks->release();

//     // Get a track
//     $track = $release->trackByID(1);

//     echo $track->durationString();

//     break;
// }
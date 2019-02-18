<?php
// Require composer classes
require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/config.php';

// AutoIncluder
$load = new AutoIncluder(__DIR__, array(__DIR__ . '/vendor'));

// Create backend
$backend = new Backend($config);

// The work we're dealing with
$work = $backend->work(1);

// Get releases
$releases = $backend->releases();

// Filter releases
$releases->hasTracksWithDuration()->hasYear();

// Loop over releases
foreach ($releases as $r)
{
    // Show info
    echo "Release: {$r->title()} from {$r->year()}:" . PHP_EOL;

    // Loop tracks
    foreach ($r->tracks() as $index => $track) echo "{$index}: {$track->title()}" . PHP_EOL;
    
    // Show instructions
    echo PHP_EOL . "Enter the track range for work {$work->name()}:" . PHP_EOL;

    // Read input
    $line = readline('> ');

    // Input?
    if (strlen($line) > 0)
    {
        // Add entry
        $work->createTrackRange($r, $line);

        // Print
        echo "Stored range {$line} for work {$work->ID()} and release {$r->ID()}";
    }

    // No input
    else
    {
        // Print
        echo "No track entry added.";
    }

    // Show line
    echo PHP_EOL . str_repeat('-', 50) . PHP_EOL . PHP_EOL;
}
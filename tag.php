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
$releases->hasTracksWithDuration()->hasYear()->taggedForWork($work, false, true);

// Loop over releases
foreach ($releases as $r)
{
    // Skip first entries
    // if ($r->ID() <= 400) continue;

    // Show info
    echo "Release {$r->ID()}: {$r->title()} from {$r->year()}:" . PHP_EOL;

    // Loop tracks
    foreach ($r->tracks() as $index => $track) 
    {
        // String found?
        if (strpos($track->title(), "1043") !== FALSE) echo "\033[1;31m";

        // Show info
        echo "{$index}: {$track->title()} - {$track->durationString()}" . PHP_EOL;

        // Clear input
        echo "\033[0m";
    }
    
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
        // Add entry
        $work->createTrackRange($r, "SKIP");

        // Print
        echo "No track entry added.";
    }

    // Show line
    echo PHP_EOL . str_repeat('-', 50) . PHP_EOL . PHP_EOL;
}
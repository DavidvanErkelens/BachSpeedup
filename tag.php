<?php
// Require composer classes
require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/config.php';

// AutoIncluder
$load = new AutoIncluder(__DIR__, array(__DIR__ . '/vendor'));

// Create backend
$backend = new Backend($config);

// The work we're dealing with
$work = $backend->work(9);

// Get releases
$releases = $backend->releases();

// Filter releases
$releases->hasTracksWithDuration()->hasYear()->taggedForWork($work, false, true)->downloadedForWork($work);

// How much releases do we have to tag?
$totag = count($releases);

// If we're a multiple of 2, add 1 to make sure in cases of 1000 we get 4 instead of 3
$totagsafe = ($totag % 2 == 0) ? $totag + 1 : $totag;

// Format length of releases to tag
$totaglength = ceil(log10($totagsafe));

// Store counter
$c = 0;

// Loop over releases
foreach ($releases as $r)
{
    // Show info
    echo "Release {$r->ID()}: {$r->title()} from {$r->year()}:" . PHP_EOL;

    // Loop tracks
    foreach ($r->tracks() as $index => $track) 
    {
        // String found?
        if (strpos($track->title(), $work->query()) !== FALSE) echo "\033[1;31m";

        // Show info
        echo "{$index}: {$track->title()} - {$track->durationString()}" . PHP_EOL;

        // Clear input
        echo "\033[0m";
    }
    
    // Show instructions
    echo PHP_EOL . "Enter the track range for work {$work->name()}:" . PHP_EOL;

    // Format showcounter
    $show = str_pad(($c + 1), $totaglength, '0', STR_PAD_LEFT);

    // Read input
    $line = readline("[{$show}/{$totag}] > ");

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

    // Increment counter
    $c += 1;

    // Show line
    echo PHP_EOL . str_repeat('-', 50) . PHP_EOL . PHP_EOL;
}
<?php
// Require composer classes
require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/config.php';

// AutoIncluder
$load = new AutoIncluder(__DIR__, array(__DIR__ . '/vendor'));

// Create backend
$backend = new Backend($config);

// What range are we looking at?
list($startyear, $endyear) = array(1950, 2100);

// Get work param
if ($argc < 2 || !is_numeric($argv[1])) $work = 1;
else $work = $argv[1];

// The work we're dealing with
$work = $backend->work($work);

// Valid?
if (is_null($work)) $work = $backend->work(1);

// Get releases
$releases = $backend->releases();

// Filter releases
$releases->hasTracksWithDuration()->hasYear()->taggedForWork($work, true);

// Check range
$releases->range($startyear, $endyear);

// Get data
$plotdata = $work->plotData($startyear, $endyear);
$linefit = $work->fitLine($startyear, $endyear);

// Calculate number
$number = count($releases);

// Store total
$total = 0.0;
$minyear = 3000;
$maxyear = 0;

// Calculate parameters
foreach ($plotdata as $point) 
{
    // Increment total
    $total += $point[2];
    
    // Check years
    if ($point[0] < $minyear) $minyear = $point[0];
    if ($point[0] > $maxyear) $maxyear = $point[0];
}

// Show counter
echo "For work {$work->name()} we have {$number} tagged releases with duration, from {$minyear} to {$maxyear}" . PHP_EOL . PHP_EOL; 

// Calculate average
$average = durationString($total / count($releases));

// Calculate line values for min and max year
$startvalue = ($linefit['intercept'] + ($minyear * $linefit['slope']));
$endvalue = ($linefit['intercept'] + ($maxyear * $linefit['slope']));

// Calculate line values for min and max year
$startvalue_str = durationString($startvalue);
$endvalue_str = durationString($endvalue);

// Calculate difference 
$difference = $startvalue - $endvalue;
$decrease = number_format(($difference / $startvalue) * 100, 3);

// Calculate decrease per year
$peryear = number_format(($difference / $startvalue) * 100 / ($maxyear - $minyear), 3);

// Show average
echo "Average duration: {$average}" . PHP_EOL . PHP_EOL;
// echo "Timespan: {$minyear} - {$maxyear}" . PHP_EOL . PHP_EOL;
echo "Linefit {$minyear}: {$startvalue_str}" . PHP_EOL;
echo "Linefit {$maxyear}: {$endvalue_str}" . PHP_EOL . PHP_EOL;
echo "Decline: {$decrease}%" . PHP_EOL;
echo "Decline per year: {$peryear}%" . PHP_EOL;


function durationString(float $duration): string
{
    // Get the minutes
    $minutes = intval(floor($duration));

    // Get the seconds
    $seconds = intval(round(60 * ($duration - $minutes)));

    // Format
    $seconds = str_pad((string) $seconds, 2, '0', STR_PAD_LEFT);

    // Format string
    return "{$minutes}:{$seconds}";
}
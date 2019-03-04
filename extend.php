<?php

// Require composer classes
require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/config.php';

// AutoIncluder
$load = new AutoIncluder(__DIR__, array(__DIR__ . '/vendor'));

// Use Guzzle
use GuzzleHttp\Client;

// Create client
$client = new Client(['headers' => ['User-Agent' => 'BachSpeedup/0.1']]);

// Create backend
$backend = new Backend($config);

// Print newline
echo PHP_EOL;

// The work we're downloading for
// $work = $backend->work(1);

// Get all releases
$filter = new DiscogsReleaseFilter();
$filter->taggedForAnyWork();
$collection = $backend->releases($filter);

// Counter variables
$total = count($collection);
$count = 0;

// Echo newline
echo PHP_EOL;

// Loop over releases
foreach ($collection as $release)
{
    // Increment counter
    $count++;

    // Show status report
    echo "\r[{$count}/{$total}] Processing {$release->title()}";

    // This can throw
    try
    {
        // Get data
        $response = $client->get($release->url());
    }
    // Stop if someting goes wrong
    catch (Exception $e)
    {
        // Show error
        trigger_error("Encountered error for url {$url}!");
        
        // Stop executing
        break;
    }

    // Get status code
    if ($response->getStatusCode() != 200) 
    {
        // Show error
        trigger_error("Encountered error for url {$url}!");
        
        // Stop executing
        break;
    }

    // Parse data
    $data = json_decode($response->getBody(), true);

    // Get parameters
    $format = $data['formats'][0]['name'] ?? null;
    $country = $data['country'] ?? null;

    // Store in release
    if ($format)  $release->setFormat($format);
    if ($country) $release->setCountry($country);

    // Wait a small time (exact amount for 25 requests / minute)
    usleep(2400000);
}
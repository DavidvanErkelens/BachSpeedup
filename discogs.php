<?php
/**
 *  Discogs.php
 * 
 *  File that communicates with the Discogs API in order to fetch information
 *  about certain records
 * 
 *  @author         David van Erkelens <me@davidvanerkelens.nl>
 */

// Require composer classes
require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/config.php';

// AutoIncluder
$load = new AutoIncluder(__DIR__, array(__DIR__ . '/vendor'));

// Use Guzzle
use GuzzleHttp\Client;

// Load urls to get
$urls = array_map('trim', file(__DIR__ . '/urls'));
// $urls = array('https://api.discogs.com/releases/5914243');

// Create client
$client = new Client(['headers' => ['User-Agent' => 'BachSpeedup/0.1']]);

// Create backend
$backend = new Backend($config);

// Print newline
echo PHP_EOL;

// Get total
$total = count($urls);

// Loop over URLs
foreach ($urls as $i => $url)
{
    // Show message
    echo "\rProcessing {$url} [{$i}/{$total}]";

    // This can trhow
    try
    {
        // Get data
        $response = $client->get($url);
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
    $year = $data['year'] ?? 0;
    $quality = $data['data_quality'] ?? '[not set]';
    $thumbnail = $data['thumb'] ?? '';
    $title = $data['title'] ?? '';
    $master = $data['master_url'] ?? '';

    // Format array
    $params = array(
        'url'       =>  $url,
        'year'      =>  ($year),
        'quality'   =>  ($quality),
        'title'     =>  ($title),
        'master'    =>  ($master),
        'thumbnail' =>  ($thumbnail)
    );

    // create release
    $release = $backend->createRelease($params);

    // Loop over artists
    foreach ($data['artists'] as $artist)
    {
        // Get parameters
        $name = ($artist['name']);
        $id = ($artist['id']);

        // Set items
        $release->addArtist($name, $id);
    }

    // Loop over tracks
    foreach ($data['tracklist'] as $track)
    {
        // Get parameters
        $duration = ($track['duration']);
        $pos = ($track['position']);
        $type = ($track['type_']);
        $title = ($track['title']);

        // Add to release
        $release->addTrack($duration, $pos, $type, $title);
    }

    // Wait a small time (exact amount for 25 requests / minute)
    usleep(2400000);
}

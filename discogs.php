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

// Create client
$client = new Client(['headers' => ['User-Agent' => 'BachSpeedup/0.1']]);

// Create backend
$backend = new Backend($config);

// Print newline
echo PHP_EOL;

// The work we're downloading for
$work = $backend->work(9);

// Load urls to get
$urls = array_map('trim', file(__DIR__ . "/bwv{$work->query()}urls"));
// $urls = array('https://api.discogs.com/releases/4586492');

// Get total
$total = count($urls);

// Confirm
$string = "About to import {$total} URLs for work {$work->name()}. Press enter to continue...";

// Prompt
readline($string);

// Loop over URLs
foreach ($urls as $i => $url)
{
    // Show message
    echo "\rProcessing {$url} [{$i}/{$total}]";

    // Create filter
    $filter = new DiscogsReleaseFilter;
    $filter->setUrl($url);

    // Loop over results
    foreach ($backend->releases($filter) as $release)
    {
        // Add this release to the work
        $work->addDownloadedRelease($release);

        // Move on
        continue 2;
    }

    // This can throw
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

    // Hacky hacky hacky
    try
    {
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
    
        // Add release to the work
        $work->addDownloadedRelease($release);
    }

    // We'll just ignore things that go wrong
    catch (Exception $e) {}

    // Wait a small time (exact amount for 25 requests / minute)
    usleep(2400000);
}

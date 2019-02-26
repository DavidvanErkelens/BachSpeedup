<?php
// Require composer classes
require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../config.php';

// AutoIncluder
$load = new AutoIncluder(__DIR__ . '/..', array(__DIR__ . '/../vendor'));

// Create backend
$backend = new Backend($config);

// Use Smarty object to pass data to front end
$smarty = new Smarty();

// Get work ID
$wid = $_GET['work'];

// Number?
if (!is_numeric($wid)) $wid = 1;

// Fetch work
$work = $backend->work($wid);

// Exists?
if ($work === NULL) $work = $backend->work(1);

// Assign work name
$smarty->assign('work', $work->name());
$smarty->assign('workid', $work->ID());

// Show the plot
$smarty->display('index.tpl');
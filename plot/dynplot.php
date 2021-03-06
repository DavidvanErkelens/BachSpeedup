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

// Get ID
$id = $_GET['work'];

// Fetch work
$work = $backend->work($id);

// Add data
$smarty->assign('data', $work->plotData());

// Add linear regression params
$smarty->assign('regression', $work->fitLine());

// Assign work name
$smarty->assign('work', $work->name());

// Show the plot
$smarty->display('dynplot.tpl');
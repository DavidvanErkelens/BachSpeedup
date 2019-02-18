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

// Fetch work (now in DB: 1 = BWV1043, 2 = BWV1043 - Vivace)
$work = $backend->work(1);

// Add data
$smarty->assign('data', $work->plotData());

// Add linear regression params
$smarty->assign('regression', $work->fitLine());

// Show the plot
$smarty->display('dynplot.tpl');
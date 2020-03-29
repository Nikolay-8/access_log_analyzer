<?php
include dirname(__FILE__) . '/ClassLoader/SplClassLoader.php';
use Parser\LogParser;
use Counter\CounterManager;
use Output\JsonOutput;
use File\File;

$classLoader = new SplClassLoader();
$classLoader->register();

$logFilePath = isset($argv[1]) ? $argv[1] : './access.log';

$analyzerHandler = new Analyzer_Handler();
$logParser = new LogParser();

$logCounter = new CounterManager();
$logCounter->setParser($logParser);

$logFile = new File();
$logFile->init($logFilePath);

$analyzerHandler->setLogFile($logFile)->setCounter($logCounter)->handle();

JsonOutput::output($logCounter->getResult());
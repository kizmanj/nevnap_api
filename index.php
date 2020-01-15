#!/usr/bin/env php
<?php

require __DIR__.'/common.php';

use Symfony\Component\Console\Application;

$serverRoot = __DIR__;
$application = new Application();

$commandsDir = __DIR__ . '/src/Command/';
$commandFiles = scandir($commandsDir);

foreach ($commandFiles as $fileName) {
	if (is_dir($commandsDir . $fileName)) {
		continue;
	}
	$baseName = basename($fileName, '.php');

	$commandClass = new ReflectionClass('Nameday\\Command\\' . $baseName);
	if (!$commandClass->isAbstract()) {
		$application->add($commandClass->newInstance());
	}
}

$application->run();
<?php

@ob_end_flush();

set_include_path(implode(PATH_SEPARATOR, array(
	realpath(getcwd().'/library'),
	get_include_path()
)));

require_once './library/Generator.php';

$config = include 'config.php';
$zg = new Generator($config);
$zg->generate();
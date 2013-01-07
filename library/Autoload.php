<?php
require_once __DIR__ . "/SplClassLoader.php";

$classLoader = new SplClassLoader('Tzander', __DIR__);
$classLoader->register();
<?php
require __DIR__.'/vendor/autoload.php';

use Kreait\Firebase\Factory;

$factory = (new Factory)
    ->withServiceAccount('../red-dine-webapp-firebase-adminsdk-wnfze-9f4ab33b59.json');
$storage = $factory
    ->withDefaultStorageBucket("red-dine-webapp.appspot.com")
    ->createStorage();
$bucket = $storage->getBucket();
?>
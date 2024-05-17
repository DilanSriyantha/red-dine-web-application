<?php
require __DIR__.'/vendor/autoload.php';

use Kreait\Firebase\Factory;

$factory = (new Factory)
    ->withServiceAccount('../red-dine-webapp-firebase-adminsdk-wnfze-9f4ab33b59.json'); // change this line accordingly
$storage = $factory
    ->withDefaultStorageBucket("red-dine-webapp.appspot.com") // change this line accordingly
    ->createStorage();
$bucket = $storage->getBucket();
?>
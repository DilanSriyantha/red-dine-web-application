<?php
require __DIR__.'/vendor/autoload.php';

use Kreait\Firebase\Factory;

$factory = (new Factory)
    ->withServiceAccount('../red-dine-webapp-firebase-adminsdk-wnfze-0f6fd46e97.json'); // change this line accordingly
$storage = $factory
    ->withDefaultStorageBucket("red-dine-webapp.appspot.com") // change this line accordingly
    ->createStorage();
$bucket = $storage->getBucket();
?>
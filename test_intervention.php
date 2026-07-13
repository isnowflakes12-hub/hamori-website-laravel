<?php
require 'vendor/autoload.php';
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

$manager = new ImageManager(new Driver());
$img = $manager->createImage(100, 100);
$encoded = $img->encodeUsingFileExtension('webp', 75);
echo get_class($encoded);

<?php

use Hongkiat\Ollama\VisionEnabled\AltText;
use Hongkiat\Ollama\VisionEnabled\TableExtractor;
use Hongkiat\Ollama\VisionEnabled\VisualTesting;

require dirname(__DIR__) . '/vendor/autoload.php';

// 1. Image-to-Text Generation.
$response = (new AltText())->fromImage(dirname(__DIR__) . '/img/image-1.jpg');

// 2. Visual Data Extraction
// $response = (new TableExtractor())->fromImage(dirname(__DIR__) . '/img/image-2.jpg');

// 3. Visual Testing
// $response = (new VisualTesting())->fromImage(dirname(__DIR__) . '/img/image-3b.jpg');

echo (new Parsedown())->text($response);

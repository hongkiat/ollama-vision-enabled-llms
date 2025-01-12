<?php

namespace Hongkiat\Ollama\VisionEnabled\Contracts;

use Exception;
use Hongkiat\Ollama\VisionEnabled\Traits\WithOllama;

interface Prompt
{
    /**
     * Get response from the Ollama API.
     *
     * @param string $image The path to the image.
     */
    public function fromImage(string $image): string;
}

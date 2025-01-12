<?php

namespace Hongkiat\Ollama\VisionEnabled;

use Exception;
use Hongkiat\Ollama\VisionEnabled\Contracts\Prompt;
use Hongkiat\Ollama\VisionEnabled\Traits\WithOllama;

class AltText implements Prompt
{
    use WithOllama;

    public function fromImage(string $imagePath): string
    {
        if (!file_exists($imagePath)) {
            throw new Exception("Screenshot file does not exist");
        }

        $prompt = <<<EOT
        Generate concise, descriptive alt text for this image that:
        1. Describes key visual elements and their relationships
        2. Provides context and purpose
        3. Avoids redundant phrases like "image of" or "picture of"
        4. Includes any relevant text visible in the image
        5. Follows WCAG guidelines (130 characters max)

        Format as a single, clear sentence.
        EOT;

        $report = $this->sendPrompt($prompt, [$this->encodeImage($imagePath)]);

        return $report['response'];
    }
}

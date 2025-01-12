<?php

namespace Hongkiat\Ollama\VisionEnabled;

use Exception;
use Hongkiat\Ollama\VisionEnabled\Contracts\Prompt;
use Hongkiat\Ollama\VisionEnabled\Traits\WithOllama;

class VisualTesting implements Prompt
{
    use WithOllama;

    public function fromImage(string $imagePath): string
    {
        if (!file_exists($imagePath)) {
            throw new Exception("Screenshot file does not exist");
        }

        $prompt = <<<EOT
        Analyze this UI screenshot for color contrast issues, which includes:
        - Text vs background contrast ratios for all content.
        - Identify any text below WCAG 2.1 AA standards.
        - Flag low-contrast text.
        EOT;

        $report = $this->sendPrompt($prompt, [$this->encodeImage($imagePath)]);

        return $report['response'];
    }
}

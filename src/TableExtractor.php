<?php

namespace Hongkiat\Ollama\VisionEnabled;

use Exception;
use Hongkiat\Ollama\VisionEnabled\Contracts\Prompt;
use Hongkiat\Ollama\VisionEnabled\Traits\WithOllama;

class TableExtractor implements Prompt
{
    use WithOllama;

    public function fromImage(string $imagePath): string
    {
        $prompt = <<<EOT
        Extract the table from this image and format it as a Markdown table
        with the following requirements:

        1. Identify and include all column headers
        2. Preserve all data in each cell
        3. Maintain the alignment and relationships between columns
        4. Format output using Markdown table syntax:
            - Use | to separate columns
            - Use - for the header separator row
            - Align numbers to the right
            - Align text to the left

        Response should only contain the Markdown formatted table, without
        any additional or explanatory text or list before or after the table.
        EOT;

        $report = $this->sendPrompt($prompt, [$this->encodeImage($imagePath)]);

        return $report['response'];
    }
}

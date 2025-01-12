<?php

namespace Hongkiat\Ollama\VisionEnabled\Traits;

use Exception;

trait WithOllama
{
    private string $baseUrl;
    private string $model;

    public function __construct(string $baseUrl = "http://localhost:11434", string $model = "llama3.2-vision")
    {
        $this->baseUrl = $baseUrl;
        $this->model = $model;
    }

    /**
     * Make HTTP request to Ollama API
     */
    private function sendPrompt(string $prompt, array $images): array
    {
        $data = [
            'model' => $this->model,
            'prompt' => $prompt,
            'images' => $images,
            'stream' => false,
            'options' => [
                'temperature' => 0.3,
            ]
        ];

        $ch = curl_init($this->baseUrl . '/api/generate');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);

        $response = curl_exec($ch);

        if (curl_errno($ch)) {
            throw new Exception('Curl error: ' . curl_error($ch));
        }

        curl_close($ch);

        return json_decode($response, true);
    }

    /**
     * Encode image to base64
     */
    private function encodeImage(string $imagePath): string
    {
        return base64_encode(file_get_contents($imagePath));
    }
}

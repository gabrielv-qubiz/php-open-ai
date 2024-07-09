<?php

namespace App;
use Orhanerday\OpenAi\OpenAi;

class AiClient
{
    private const OPEN_AI_KEY = "OPEN_AI_API_KEY";
    private const OPEN_AI_DEFAULT_MODEL = "gpt-3.5-turbo";
    private const OPEN_AI_DEFAULT_MAX_TOKENS = 4000;
    private const OPEN_AI_DEFAULT_TEMPERATURE = 1.0;
    private const OPEN_AI_DEFAULT_FREQUENCY_PENALTY = 0;
    private const OPEN_AI_DEFAULT_PRESENCE_PENALTY = 0;

    private OpenAi $client;

    public function __construct()
    {
        $this->client = new OpenAi(self::OPEN_AI_KEY);
    }

    public function getAssistants()
    {
       return $this->client->listAssistants(['limit' => 10]);
    }

    public function getAssistant()
    {
        $assistantId = 'asst_VcmA0xoZiqckk1G4IP3fZp2u';
        return $this->client->retrieveAssistant($assistantId);
    }

    public function modifyAssistant()
    {
        $assistantId = 'asst_VcmA0xoZiqckk1G4IP3fZp2u';
        $data = [
            'instructions' => fopen('instructions.txt', 'rw+'),
        ];

        return $this->client->modifyAssistant($assistantId, $data);
    }

    public function chat(): mixed
    {
        return $this->client->chat([
            "model" => self::OPEN_AI_DEFAULT_MODEL,
            "messages" => [
                [
                    "role" => "system",
                    "content" => "You are a helpful assistant."
                ],
                [
                    "role" => "user",
                    "content" => "Who won the world series in 2020?"
                ],
                [
                    "role" => "assistant",
                    "content" => "The Los Angeles Dodgers won the World Series in 2020."
                ],
                [
                    "role" => "user",
                    "content" => "Where was it played?"
                ],
            ],
            "temperature" => 1.0,
            "max_tokens" => 4000,
            "frequency_penalty" => 0,
            "presence_penalty" => 0,
        ]);
    }
}
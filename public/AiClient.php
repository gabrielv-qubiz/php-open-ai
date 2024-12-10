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
            'instructions' => file_get_contents('instructions.txt'),
        ];

        return $this->client->modifyAssistant($assistantId, $data);
    }

    public function chat(): mixed
    {
        $message = $this->client->chat([
            "model" => self::OPEN_AI_DEFAULT_MODEL,
            "messages" => [
                [
                    "role" => "system",
                    "content" => "You are a helpful assistant."
                ],
                [
                    "role" => "assistant",
                    "content" => file_get_contents('instructions.txt')
                ],
                [
                    "role" => "user",
                    "content" => '
Is there coverage for the next situation based on the terms and conditions?
Address: My address
Location: bedroom
Main Category: Audio Video
Category: Computers and Mobiles
Policy Type: Household
Description: my computer was destroyed
Format the answer as a json with the format of :
"covered": with 1 for yes and 0 for no
"accuracyPercent": the percent of accuracy of the answer
"topNochAccuracy:" the percent of accuracy of the answer after validating the answer 10 times
"message": the answer
'
                ]
            ],
            "temperature" => 1.0,
            "max_tokens" => 4000,
            "frequency_penalty" => 0,
            "presence_penalty" => 0,
        ]);

        $x = json_decode($message);
        return [
            "data" => $message,
            "response" => $x->choices[0]->message->content,
        ];
    }
}
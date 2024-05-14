<?php
// ai-assistant.php

// Load environment variables from .env file
function loadEnv() {
    if (!file_exists('.env')) {
        return;
    }

    $env = file('.env', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($env as $line) {
        if (strpos(trim($line), '#') === 0) {
            continue;
        }

        list($name, $value) = explode('=', $line, 2);
        $_ENV[trim($name)] = trim($value);
    }
}

loadEnv();

$input = json_decode(file_get_contents('php://input'), true);
$userMessage = strtolower($input['message']);

// List of terms related to web hosting
$hostingTerms = ['hosting', 'plan', 'package', 'storage', 'bandwidth', 'email account', 'server', 'website', 'domain', 'greeting', 'hello', 'hi', 'hey', 'good morning', 'good afternoon', 'good evening'];

// Function to check if the message is related to web hosting or a greeting
function isHostingRelated($message, $terms) {
    foreach ($terms as $term) {
        if (strpos($message, $term) !== false) {
            return true;
        }
    }
    return false;
}

// Function to call OpenAI API
function callOpenAI($message) {
    $apiKey = $_ENV['OPENAI_API_KEY'];
    $url = 'https://api.openai.com/v1/engines/davinci-codex/completions';
    $data = [
        'prompt' => "You are a web hosting assistant for 1100.website. Only answer questions related to web hosting plans. Here are the plans:\n\n" .
                    "Basic: $5/month, 1 GB storage, 5 GB bandwidth, 1 email account\n" .
                    "Professional: $10/month, 5 GB storage, 25 GB bandwidth, 5 email accounts\n" .
                    "Business: $15/month, 10 GB storage, 50 GB bandwidth, 10 email accounts\n\n" .
                    "Customer: $message\nAI Assistant:",
        'max_tokens' => 150,
        'stop' => ["\n", "Customer:"]
    ];

    $options = [
        'http' => [
            'header' => "Content-Type: application/json\r\nAuthorization: Bearer $apiKey\r\n",
            'method' => 'POST',
            'content' => json_encode($data)
        ]
    ];

    $context = stream_context_create($options);
    $result = file_get_contents($url, false, $context);
    return json_decode($result, true)['choices'][0]['text'];
}

// Get AI response only if the question is related to web hosting or a greeting
if (isHostingRelated($userMessage, $hostingTerms)) {
    $aiResponse = callOpenAI($userMessage);
} else {
    $aiResponse = "I can only help with web hosting related questions. Please ask me about our hosting plans.";
}

// Return response
echo json_encode(['response' => $aiResponse]);
?>

<?php

header("Access-Control-Allow-Origin: *"); // Allow all origins
header("Access-Control-Allow-Methods: GET, POST, OPTIONS"); // Allow these request types
header("Access-Control-Allow-Headers: Content-Type"); // Allow specific headers
header("Content-Type: application/json");

// Handle preflight requests
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}

require_once "sortingStrategy/Context.php";
require_once "sortingStrategy/ConcreteSortingAlphabetical.php";
require_once "sortingStrategy/ConcreteSortingReverseAlphabetical.php";

use SortingGame\Strategies\Context;
use SortingGame\Strategies\ConcreteSortingAlphabetical;
use SortingGame\Strategies\ConcreteSortingReverseAlphabetical;

// Get the JSON input from Axios
$input = json_decode(file_get_contents("php://input"), true);

// Extract data
$items = $input['items'] ?? [];
$sortType = $input['sortType'] ?? 'alphabetical';

// Choose the sorting strategy based on user selection
$sortingStrategy = match ($sortType) {
    'alphabetical' => new ConcreteSortingAlphabetical(),
    'reverse' => new ConcreteSortingReverseAlphabetical(),
    default => throw new Exception("Invalid sorting type"),
};

// Execute sorting check
$context = new Context($sortingStrategy);
$isCorrect = $context->checkSorting($items);

// Send response
echo json_encode([
    "message" => $isCorrect ? "Sorting is correct!" : "Sorting is incorrect!",
    "status" => $isCorrect ? "success" : "error"
]);

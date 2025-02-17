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
require_once "sortingStrategy/ConcreteSortingCategory.php";
require_once "sortingStrategy/ConcreteSortingReverseCategory.php";
require_once "sortingStrategy/ConcreteSortingLength.php";
require_once "sortingStrategy/ConcreteSortingReverseLength.php";

use SortingGame\Strategies\Context;
use SortingGame\Strategies\ConcreteSortingAlphabetical;
use SortingGame\Strategies\ConcreteSortingReverseAlphabetical;
use SortingGame\Strategies\ConcreteSortingCategory;
use SortingGame\Strategies\ConcreteSortingReverseCategory;
use SortingGame\Strategies\ConcreteSortingLength;
use SortingGame\Strategies\ConcreteSortingReverseLength;

// Get the JSON input from Axios
$input = json_decode(file_get_contents("php://input"), true);

// Extract data
$items = $input['items'] ?? [];
$sortType = $input['sortType'] ?? 'alphabetical';

// Choose the sorting strategy based on user selection
$sortingStrategy = match ($sortType) {
    'alphabetical' => new ConcreteSortingAlphabetical(),
    'reverse' => new ConcreteSortingReverseAlphabetical(),
    'category' => new ConcreteSortingCategory(),
    'reverse-category' => new ConcreteSortingReverseCategory(),
    'length' => new ConcreteSortingLength(),
    'reverse-length' => new ConcreteSortingReverseLength(),
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

<?php
// Simple handler for buyagrade form submissions
// This will append submissions to suckers.html

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: buyagrade.html');
    exit;
}

$name = htmlspecialchars($_POST['name'] ?? '');
$email = htmlspecialchars($_POST['email'] ?? '');
$course = htmlspecialchars($_POST['course'] ?? '');
$amount = htmlspecialchars($_POST['amount'] ?? '');
$time = date('Y-m-d H:i:s');

$entry = "<li><strong>" . $time . "</strong> - " . $name . " (" . $email . ") paid $" . $amount . " for " . $course . "</li>\n";

$file = __DIR__ . '/suckers.html';

// If file doesn't exist, create with basic HTML structure
if (!file_exists($file)) {
    $initial = "<!doctype html>\n<html lang=\"en\">\n<head>\n  <meta charset=\"utf-8\">\n  <meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">\n  <title>Suckers</title>\n  <link rel=\"stylesheet\" href=\"index.css\">\n</head>\n<body>\n  <main>\n    <h1>Suckers</h1>\n    <ul id=\"entries\">\n";
    file_put_contents($file, $initial, LOCK_EX);
}

// Append entry before closing tags
// Read current content
$content = file_get_contents($file);

// Insert entry before closing tags
if (strpos($content, '</ul>') !== false) {
    $content = str_replace('</ul>', $entry . '</ul>', $content);
} else {
    $content .= "<ul id=\"entries\">\n" . $entry . "</ul>\n";
}

// Ensure closing main/body/html
if (strpos($content, '</main>') === false) {
    $content .= "</main>\n</body>\n</html>\n";
}

file_put_contents($file, $content, LOCK_EX);

// Redirect back to suckers page
header('Location: suckers.html');
exit;

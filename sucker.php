<?php
$required = ['name', 'section', 'cardnumber', 'cardtype'];

foreach ($required as $field) {
    if (!isset($_POST[$field]) || trim($_POST[$field]) === '') {
        echo '<h1>Sorry</h1>';
        echo '<p>You did not fill out the form completely. <a href="buyagrade.html">Try again?</a></p>';
        exit;
    }
}

$name = trim($_POST['name']);
$section = trim($_POST['section']);
$cardnumber = trim($_POST['cardnumber']);
$cardtype = trim($_POST['cardtype']);

$line = $name . ';' . $section . ';' . $cardnumber . ';' . $cardtype . PHP_EOL;
file_put_contents('suckers.html', $line, FILE_APPEND);

$all = file_get_contents('suckers.html');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Thanks, sucker!</title>
    <link rel="stylesheet" href="index.css">
</head>
<body>
    <main>
        <h1>Thanks, sucker!</h1>

        <p>Your information has been recorded.</p>

        <h2>Form input values</h2>
        <p>Name: <?= htmlspecialchars($name) ?></p>
        <p>Section: <?= htmlspecialchars($section) ?></p>
        <p>Card Number: <?= htmlspecialchars($cardnumber) ?></p>
        <p>Card Type: <?= htmlspecialchars($cardtype) ?></p>

        <h2>The current database contains:</h2>
        <pre><?= htmlspecialchars($all) ?></pre>

        <p><a href="buyagrade.html">Submit another response</a></p>
    </main>
</body>
</html>
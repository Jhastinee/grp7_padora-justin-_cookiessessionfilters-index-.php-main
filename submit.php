<?php
$dataFile = 'group7_data.txt';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $names = $_POST['name'];
    $images = $_POST['image'];
    $roles = $_POST['role'];
    $contacts = $_POST['contact'];
    $bios = $_POST['bio'];
    $newData = [];
    foreach ($names as $index => $name) {
        $newData[] = implode('|', [
            htmlspecialchars($name),
            htmlspecialchars($images[$index]),
            htmlspecialchars($roles[$index]),
            htmlspecialchars($contacts[$index]),
            htmlspecialchars($bios[$index])
        ]);
    }
    file_put_contents($dataFile, implode("\n", $newData));
    echo "<p class='success-message'>Team data updated successfully.</p>";
}
$teamArray = [];
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (file_exists($dataFile)) {
        $teamArray = file($dataFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Team Data</title>
    <link rel="stylesheet" href="manage.css">
</head>
<body>
<h1>x   Team Management</h1>
<form method="post">
    <?php
    foreach ($teamArray as $index => $line) {
        list($name, $image, $role, $contact, $bio) = explode('|', $line);
        echo "<fieldset>";
        echo "<legend>Team Member " . ($index + 1) . "</legend>";
        echo "<label for='name_$index'>Name:</label>";
        echo "<input type='text' id='name_$index' name='name[]' value='" . htmlspecialchars($name) . "' required><br>";
        echo "<label for='image_$index'>Image Filename:</label>";
        echo "<input type='text' id='image_$index' name='image[]' value='" . htmlspecialchars($image) . "' required><br>";
        echo "<label for='role_$index'>Role:</label>";
        echo "<input type='text' id='role_$index' name='role[]' value='" . htmlspecialchars($role) . "' required><br>";
        echo "<label for='contact_$index'>Contact:</label>";
        echo "<input type='text' id='contact_$index' name='contact[]' value='" . htmlspecialchars($contact) . "' required><br>";
        echo "<label for='bio_$index'>Bio:</label>";
        echo "<textarea id='bio_$index' name='bio[]' rows='4' cols='50' required>" . htmlspecialchars($bio) . "</textarea><br>";
        echo "</fieldset><br>";
    }
    ?>
    <input type="submit" value="Update Team Data">
</form>
<a href="index.php" class="back-button">Back to Main</a>
</body>
</html>

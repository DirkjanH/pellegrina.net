<?php
session_start();

// Initialize if not set yet
if (!isset($_SESSION['test'])) {
    $_SESSION['test'] = 0;
}

// Handle toggle action
if (isset($_POST['toggle_test'])) {
    // Toggle between 0 and 1
    $_SESSION['test'] = $_SESSION['test'] ? 0 : 1;
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Toggle session test</title>
</head>
<body>

<p>Current value of $_SESSION['test']: <?php echo (int)$_SESSION['test']; ?></p>

<form method="post">
    <label>
        <input type="radio"
               name="toggle_test"
               value="1"
               onchange="this.form.submit()"
            <?php echo $_SESSION['test'] ? 'checked' : ''; ?>>
        Test aan
    </label>
    <label>
        <input type="radio"
               name="toggle_test"
               value="0"
               onchange="this.form.submit()">
        Test uit
    </label>
    <noscript>
        <button type="submit">Save</button>
    </noscript>
</form>

</body>
</html>

<?php
require_once 'config/Database.php';
require_once 'models/CarRental.php';
require_once 'includes/functions.php';
require_once 'templates/form.php';
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Sistem Rental Mobil</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 p-8">
    <div class="max-w-4xl mx-auto bg-white rounded-lg shadow-md p-6">
        <h1 class="text-2xl font-bold mb-6">Sistem Rental Mobil</h1>
        
        <?php
        $database = new Database();
        $db = $database->getConnection();
        $rental = new CarRental($db);
        
        // Create table if not exists
        // $rental->createTable();

        // Render the form
        renderForm($rental->getCarPrices());

        // Process form submission
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $result = $rental->calculateRental($_POST);
            echo renderResult($result);
        }
        ?>
    </div>
</body>
</html>
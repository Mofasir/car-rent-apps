<?php
/**
 * File utama aplikasi
 * 
 * Fungsi:
 * - Inisialisasi session
 * - Load semua dependencies
 * - Setup koneksi database
 * - Handle form submission
 * - Render tampilan utama dengan tabs:
 *   - Form Input Rental
 *   - Daftar Transaksi
 */

session_start();
require_once 'config/Database.php';
require_once 'models/CarRental.php';
require_once 'includes/functions.php';
require_once 'templates/form.php';
require_once 'templates/transactions.php';

$database = new Database();
$db = $database->getConnection();
$rental = new CarRental($db);
                
// Membuat tabel jika belum tersedia
$rental->createTable();

// Memproses submit form
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $result = $rental->calculateRental($_POST);
    $_SESSION['rental_result'] = $result; 
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Sistem Rental Mobil</title>
    <link rel="icon" type="image/png" href="assets/car-logo.png">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
</head>
<body class="bg-gray-100 p-8">
    <div class="max-w-6xl mx-auto bg-white rounded-lg shadow-md p-6">
        <h1 class="text-2xl font-bold mb-6">Sistem Rental Mobil</h1>
        
        <div x-data="{ activeTab: 'input' }">
            <div class="mb-4">
                <button @click="activeTab = 'input'" :class="{ 'bg-blue-500 text-white': activeTab === 'input', 'bg-gray-200': activeTab !== 'input' }" class="px-4 py-2 rounded">Form Input Rental</button>
                <button @click="activeTab = 'transactions'" :class="{ 'bg-blue-500 text-white': activeTab === 'transactions', 'bg-gray-200': activeTab !== 'transactions' }" class="px-4 py-2 rounded ml-2">Daftar Transaksi Rental</button>
            </div>

            <div x-show="activeTab === 'input'">
                <?php
                // Me-render form
                renderForm($rental->getCarPrices());

                // Menampilkan hasil jika ada dalam session
                if (isset($_SESSION['rental_result'])) {
                    echo renderResult($_SESSION['rental_result']);
                    unset($_SESSION['rental_result']); // Membersihkan hasil dari session
                }
                ?>
            </div>

            <div x-show="activeTab === 'transactions'">
                <?php
                // Me-render tabel transaksi
                renderTransactions($rental->getAllTransactions());
                ?>
            </div>
        </div>
    </div>
</body>
</html>

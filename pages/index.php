<?php
require_once 'config.php';

// Get statistics
$stmt = $conn->query("SELECT COUNT(*) as total FROM client");
$totalClients = $stmt->fetch_assoc()['total'];

$stmt = $conn->query("SELECT COUNT(*) as total FROM voiture");
$totalCars = $stmt->fetch_assoc()['total'];

$stmt = $conn->query("SELECT COUNT(*) as total FROM location");
$activeRentals = $stmt->fetch_assoc()['total'];
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Système de Location de Voitures</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <nav class="bg-blue-600 text-white p-4">
        <div class="container mx-auto flex justify-between items-center">
            <h1 class="text-2xl font-bold">CarRental</h1>
            <div class="space-x-4">
                <a href="./client.php" class="hover:text-gray-200">Clients</a>
                <a href="./voitures.php" class="hover:text-gray-200">Voitures</a>
                <a href="./location.php" class="hover:text-gray-200">Locations</a>
            </div>
        </div>
    </nav>

    <main class="container mx-auto p-4">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <!-- Statistics Cards -->
            <div class="bg-white p-6 rounded-lg shadow">
                <h3 class="text-xl font-semibold text-gray-800">Total Clients</h3>
                <p class="text-3xl font-bold text-blue-600"><?php echo $totalClients; ?></p>
            </div>
            
            <div class="bg-white p-6 rounded-lg shadow">
                <h3 class="text-xl font-semibold text-gray-800">Total Voitures</h3>
                <p class="text-3xl font-bold text-blue-600"><?php echo $totalCars; ?></p>
            </div>
            
            <div class="bg-white p-6 rounded-lg shadow">
                <h3 class="text-xl font-semibold text-gray-800">Locations Actives</h3>
                <p class="text-3xl font-bold text-blue-600"><?php echo $activeRentals; ?></p>
            </div>
        </div>

        <div class="mt-8 bg-white p-6 rounded-lg shadow">
            <h2 class="text-2xl font-bold mb-4">Actions Rapides</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <a href="add_client.php" class="bg-blue-500 text-white p-4 rounded text-center hover:bg-blue-600">
                    Nouveau Client
                </a>
                <a href="add_car.php" class="bg-green-500 text-white p-4 rounded text-center hover:bg-green-600">
                    Nouvelle Voiture
                </a>
                <a href="add_rental.php" class="bg-purple-500 text-white p-4 rounded text-center hover:bg-purple-600">
                    Nouvelle Location
                </a>
            </div>
        </div>
    </main>
</body>
</html>
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
        <a href="./index.php"> <h1 class="text-2xl font-bold">CarRental</h1> </a>
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
                <button id="clientpop"  class="bg-blue-500 text-white p-4 rounded text-center hover:bg-blue-600">
                    Nouveau Client
                </button>
                <a id="voiturepop" class="bg-green-500 text-white p-4 rounded text-center hover:bg-green-600">
                    Nouvelle Voiture
                </a>
                <a id="locationspop"  class="bg-purple-500 text-white p-4 rounded text-center hover:bg-purple-600">
                    Nouvelle Location
                </a>
            </div>
        </div>
    </main>
    <!-- Modal for client -->
<div id="clientModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden">
    <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
        <h2 class="text-xl font-bold mb-4">Ajouter un nouveau client</h2>
        <form action="./client.php" method="POST" class="space-y-4">
            <input type="hidden" name="action" value="ajouter">
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Nom</label>
                    <input type="text" name="nom" required
                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700">Adresse</label>
                    <textarea name="adresse" required
                              class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"></textarea>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Téléphone</label>
                    <input type="tel" name="telephone" required
                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                </div>
            </div>
            <div class="text-right mt-4">
                <button type="button" onclick="closeClientModal()"
                        class="bg-gray-500 text-white px-4 py-2 rounded-md hover:bg-gray-600 mr-2">
                    Annuler
                </button>
                <button type="submit"
                        class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">
                    Ajouter le client
                </button>
            </div>
        </form>
    </div>
</div>
    <script src="/script.js"></script>

</body>
</html>
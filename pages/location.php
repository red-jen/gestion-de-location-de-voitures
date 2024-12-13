



<?php
require_once 'config.php';


$message = "";
$messageType = "";
// Traitement des actions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action'])) {
        switch ($_POST['action']) {
            case 'ajouter':
                $stmt = $conn->prepare("INSERT INTO location (id_client, id_voiture, date_debut, date_fin, prix_total) 
                                 VALUES (?, ?, ?, ?, ?)");
                $stmt->bind_param("iissd", 
                    $_POST['id_client'],
                    $_POST['id_voiture'],
                    $_POST['date_debut'],
                    $_POST['date_fin'],
                    $_POST['prix_total']
                );
                $stmt->execute();
                break;

            case 'supprimer':
                $stmt = $conn->prepare("DELETE FROM location WHERE id_location = ?");
                $stmt->bind_param("i", $_POST['id_location']);
                $stmt->execute();
                break;

            case 'modifier':
                $stmt = $conn->prepare("UPDATE location SET 
                         id_client = ?,
                         id_voiture = ?,
                         date_debut = ?,
                         date_fin = ?,
                         prix_total = ?
                         WHERE id_location = ?");
                $stmt->bind_param("iissdi",
                    $_POST['id_client'],
                    $_POST['id_voiture'],
                    $_POST['date_debut'],
                    $_POST['date_fin'],
                    $_POST['prix_total'],
                    $_POST['id_location']
                );
                $stmt->execute();
                break;
        }
    }
}

// Récupération des location
$result = $conn->query("SELECT * FROM location ORDER BY id_client, id_voiture");
$locations = [];
while($row = $result->fetch_assoc()) {
    $locations[] = $row;
}
?>









<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion Location Voitures</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
<nav class="bg-blue-600 text-white p-4 ">
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
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">

            <div class="bg-white p-6 rounded-lg shadow-md">
                <h2 class="text-xl font-bold mb-4">Nouvelle Location</h2>
                <form action=""  method="POST" class="space-y-4">
                <input type="hidden" name="action" value="ajouter">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">client</label>
                        <select name="id_client" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                            <option value="">Sélectionner un client
                            <?php
            $sql = "SELECT * from client";
            $result = mysqli_query($conn,$sql);
            while($i = mysqli_fetch_row($result)){
                echo '<option value="'.$i[0].'">'.$i[1].'</option>';
            }
            ?>
                            </option>
                          
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Voiture</label>
                        <select name="id_voiture" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                            <option value="">Sélectionner une voiture
                            <?php
            $sql = "SELECT * from voiture";
            $result = mysqli_query($conn,$sql);
            while($i = mysqli_fetch_row($result)){
                echo '<option value="'.$i[0].'">'.$i[1].'</option>';
            }
            ?>
                            </option>
                    
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Date de début</label>
                        <input type="date" name="date_debut" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Date de fin</label>
                        <input type="date" name="date_fin" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">prix</label>
                        <input type="text" name="prix_total" required
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                    </div>
                    <button type="submit" class="w-full bg-blue-600 text-white p-2 rounded-md hover:bg-blue-700">
                        Créer la location
                    </button>
                </form>
            </div>

 
    
            <!-- Liste des locations -->
            <div class="bg-white rounded-lg shadow-lg p-6 w-auto  lg:w-fit">
                <h2 class="text-xl font-bold mb-4  ">Liste des locations</h2>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    id_client complet
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    id de voiture
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    date de debut
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    date de fin
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    prix total
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <?php foreach ($locations as $location): ?>
                            <tr>
                                <td class="px-6 py-4">
                                    <div class="text-sm font-medium text-gray-900">
                                        <?= htmlspecialchars($location['id_client']) ?>
                                    </div>
                                 
                                </td>
                                <td class="px-6 py-4">
                                    <div class="text-sm text-gray-900">
                                        <?= htmlspecialchars($location['id_voiture']) ?>
                                    </div>
                                   
                                </td>
                                <td class="px-6 py-4">
                                <div class="text-sm text-gray-500">
                                        <?= htmlspecialchars($location['date_debut']) ?>
                                    </div>
                                   
                                </td>
                                <td class="px-6 py-4">
                                <div class="text-sm text-gray-500">
                                        <?= htmlspecialchars($location['date_fin']) ?>
                                    </div>
                                   
                                </td>
                                <td class="px-6 py-4">
                                <div class="text-sm text-gray-500">
                                        <?= htmlspecialchars($location['prix_total']) ?>
                                    </div>
                                   
                                </td>
                              
                                <td class="px-6 py-4 text-sm font-medium">
                                    <button onclick="editlocation(<?= $location['id_location'] ?>)"
                                            class="text-indigo-600 hover:text-indigo-900 mr-3">
                                        Modifier
                                    </button>
                                    <form action="" method="POST" class="inline">
                                        <input type="hidden" name="action" value="supprimer">
                                        <input type="hidden" name="id_location" value="<?= $location['id_location'] ?>">
                                        <button type="submit" class="text-red-600 hover:text-red-900"
                                                onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce location ?')">
                                            Supprimer
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>

    <script>
function editlocation(id) {
    // Fetch car data
    fetch(`get_location.php?id=${id}`)
        .then(response => response.json())
        .then(location => {
            // Create modal with edit form
            const modal = document.createElement('div');
            modal.className = 'fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full';
            modal.innerHTML = `
                <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
                    <h3 class="text-lg font-bold mb-4">Modifier le location</h3>
                    <form action="" method="POST">
                        <input type="hidden" name="action" value="modifier">
                       <input type="hidden" name="id_client" value="${location.id_location}"> 
                        <div class="space-y-4">
                          <div>
                        <label class="block text-sm font-medium text-gray-700">client</label>
                        <select name="id_client" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                            <option value="">Sélectionner un client
                            <?php
            $sql = "SELECT * from client";
            $result = mysqli_query($conn,$sql);
            while($i = mysqli_fetch_row($result)){
                echo '<option value="'.$i[0].'">'.$i[1].'</option>';
            }
            ?>
                            </option>
                          
                        </select>
                    </div>

                           <div>
                        <label class="block text-sm font-medium text-gray-700">Voiture</label>
                        <select name="id_voiture" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                            <option value="">${location.id_voiture}
                            <?php
            $sql = "SELECT * from voiture";
            $result = mysqli_query($conn,$sql);
            while($i = mysqli_fetch_row($result)){
                echo '<option value="'.$i[0].'">'.$i[1].'</option>';
            }
            ?>
                            </option>
                    
                        </select>
                    </div>
                           
                            <div>
                                <label class="block text-sm font-medium text-gray-700">telephone</label>
                                <input type="text" name="date_debut" value="${location.date_debut}" required
                                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">date_fin</label>
                                <input type="text" name="date_fin" value="${location.date_fin}" required
                                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                            </div>
                             <div>
                                <label class="block text-sm font-medium text-gray-700">prix_total</label>
                                <input type="text" name="prix_total" value="${location.prix_total}" required
                                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                            </div>
                           
                            <div class="text-right">
                                <button type="button" onclick="this.closest('.fixed').remove()"
                                        class="bg-gray-500 text-white px-4 py-2 rounded-md hover:bg-gray-600 mr-2">
                                    Annuler
                                </button>
                                <button type="submit"
                                        class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">
                                    Enregistrer
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            `;
            document.body.appendChild(modal);
        });
}
</script>
</body>
</html>
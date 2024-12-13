<?php
require_once 'config.php';


$message = "";
$messageType = "";
// Traitement des actions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action'])) {
        switch ($_POST['action']) {
            case 'ajouter':
                $stmt = $conn->prepare("INSERT INTO client (nom, telephone, adresse) 
                                 VALUES (?, ?, ?)");
                $stmt->bind_param("sss", 
                    $_POST['nom'],
                    $_POST['telephone'],
                    $_POST['adresse']
                );
                $stmt->execute();
                break;

            case 'supprimer':
                $stmt = $conn->prepare("DELETE FROM client WHERE id_client = ?");
                $stmt->bind_param("i", $_POST['id_client']);
                $stmt->execute();
                break;

            case 'modifier':
                $stmt = $conn->prepare("UPDATE client SET 
                         nom = ?,
                         telephone = ?,
                         adresse = ?
                         WHERE id_client = ?");
                $stmt->bind_param("sssi",
                    $_POST['nom'],
                    $_POST['telephone'],
                    $_POST['adresse'],
                    $_POST['id_client']
                );
                $stmt->execute();
                break;
        }
    }
}

// Récupération des client
$result = $conn->query("SELECT * FROM client ORDER BY nom, telephone");
$clients = [];
while($row = $result->fetch_assoc()) {
    $clients[] = $row;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Clients</title>
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

    <div class="container mx-auto px-4">
        <!-- Formulaire d'ajout -->
        <div class="bg-white rounded-lg shadow-lg p-6 mb-8">
            <h2 class="text-xl font-bold mb-4">Ajouter un nouveau client</h2>
            <form action="" method="POST" class="space-y-4">
                <input type="hidden" name="action" value="ajouter">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Nom</label>
                        <input type="text" name="nom" required
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                    </div>
                  
                    <div class="md:col-span-2">
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
                <div class="text-right">
                    <button type="submit"
                            class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">
                        Ajouter le client
                    </button>
                </div>
            </form>
        </div>

        <!-- Liste des clients -->
        <div class="bg-white rounded-lg shadow-lg p-6">
            <h2 class="text-xl font-bold mb-4">Liste des clients</h2>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Nom complet
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Adresse
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Contact
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <?php foreach ($clients as $client): ?>
                        <tr>
                            <td class="px-6 py-4">
                                <div class="text-sm font-medium text-gray-900">
                                    <?= htmlspecialchars($client['nom']) ?>
                                </div>
                               
                            </td>
                            <td class="px-6 py-4">
                            <div class="text-sm text-gray-500">
                                    <?= htmlspecialchars($client['adresse']) ?>
                                </div>
                               
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm text-gray-900">
                                    <?= htmlspecialchars($client['telephone']) ?>
                                </div>
                               
                            </td>
                          
                            <td class="px-6 py-4 text-sm font-medium">
                                <button onclick="editClient(<?= $client['id_client'] ?>)"
                                        class="text-indigo-600 hover:text-indigo-900 mr-3">
                                    Modifier
                                </button>
                                <form action="" method="POST" class="inline">
                                    <input type="hidden" name="action" value="supprimer">
                                    <input type="hidden" name="id_client" value="<?= $client['id_client'] ?>">
                                    <button type="submit" class="text-red-600 hover:text-red-900"
                                            onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce client ?')">
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
    <script>
function editClient(id) {
    // Fetch car data
    fetch(`get_client.php?id=${id}`)
        .then(response => response.json())
        .then(client => {
            // Create modal with edit form
            const modal = document.createElement('div');
            modal.className = 'fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full';
            modal.innerHTML = `
                <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
                    <h3 class="text-lg font-bold mb-4">Modifier le client</h3>
                    <form action="" method="POST">
                        <input type="hidden" name="action" value="modifier">
                       <input type="hidden" name="id_client" value="${client.id_client}"> 
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">FULL NAME</label>
                                <input type="text" name="nom" value="${client.nom}" required
                                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">telephone</label>
                                <input type="text" name="telephone" value="${client.telephone}" required
                                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">adresse</label>
                                <input type="text" name="adresse" value="${client.adresse}" required
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
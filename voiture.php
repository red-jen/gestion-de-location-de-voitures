
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Voitures</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <nav class="bg-blue-600 p-4 mb-8">
        <div class="container mx-auto">
            <h1 class="text-white text-2xl font-bold">Gestion des Voitures</h1>
        </div>
    </nav>

    <div class="container mx-auto px-4">
        <!-- Formulaire d'ajout -->
        <div class="bg-white rounded-lg shadow-lg p-6 mb-8">
            <h2 class="text-xl font-bold mb-4">Ajouter une nouvelle voiture</h2>
            <form action="" method="POST" class="space-y-4">
                <input type="hidden" name="action" value="ajouter">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Marque</label>
                        <input type="text" name="marque" required
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Modèle</label>
                        <input type="text" name="modele" required
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Immatriculation</label>
                        <input type="text" name="immatriculation" required
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Année</label>
                        <input type="number" name="annee" required
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Kilométrage</label>
                        <input type="number" name="kilometrage" required
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Prix par jour</label>
                        <input type="number" name="prix_jour" step="0.01" required
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Statut</label>
                        <select name="statut" required
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                            <option value="disponible">Disponible</option>
                            <option value="louée">Louée</option>
                        </select>
                    </div>
                </div>
                <div class="text-right">
                    <button type="submit"
                            class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">
                        Ajouter la voiture
                    </button>
                </div>
            </form>
        </div>

        <!-- Liste des voitures -->
        <div class="bg-white rounded-lg shadow-lg p-6">
            <h2 class="text-xl font-bold mb-4">Liste des voitures</h2>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Véhicule
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Détails
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Prix/jour
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Statut
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <?php foreach ($voitures as $voiture): ?>
                        <tr>
                            <td class="px-6 py-4">
                                <div class="text-sm font-medium text-gray-900">
                                    <?= htmlspecialchars($voiture['marque']) . ' ' . htmlspecialchars($voiture['modele']) ?>
                                </div>
                                <div class="text-sm text-gray-500">
                                    <?= htmlspecialchars($voiture['immatriculation']) ?>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm text-gray-900">
                                    Année: <?= htmlspecialchars($voiture['annee']) ?>
                                </div>
                                <div class="text-sm text-gray-500">
                                    <?= number_format($voiture['kilometrage']) ?> km
                                </div>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-900">
                                <?= number_format($voiture['prix_jour'], 2) ?> €
                            </td>
                            <td class="px-6 py-4">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                    <?= $voiture['statut'] === 'disponible' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' ?>">
                                    <?= htmlspecialchars($voiture['statut']) ?>
                                </span>
                            </td>
                            <td class="px-6 py-4 text-sm font-medium">
                                <button onclick="editVoiture(<?= $voiture['id_voiture'] ?>)"
                                        class="text-indigo-600 hover:text-indigo-900 mr-3">
                                    Modifier
                                </button>
                                <form action="" method="POST" class="inline">
                                    <input type="hidden" name="action" value="supprimer">
                                    <input type="hidden" name="id_voiture" value="<?= $voiture['id_voiture'] ?>">
                                    <button type="submit" class="text-red-600 hover:text-red-900"
                                            onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette voiture ?')">
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
</body>
</html>
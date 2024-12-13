
let locationspop = document.getElementById('locationspop');
const contratmodal = document.getElementById('contratmodal');
let voiturepop = document.getElementById('voiturepop');
const voituremodel = document.getElementById('voituremodel');

// Get modal elements
const clientModal = document.getElementById('clientModal');
const clientButton = document.getElementById('clientpop');
















function opencontratmodal() {
    contratmodal.classList.remove('hidden');
}

// Function to close client modal
function closecontratmodal() {
    contratmodal.classList.add('hidden');
}

// Event listeners
locationspop.addEventListener('click', opencontratmodal);





function openvoituremodel() {
    voituremodel.classList.remove('hidden');
}

// Function to close client modal
function closevoituremodel() {
    voituremodel.classList.add('hidden');
}

// Event listeners
voiturepop.addEventListener('click', openvoituremodel);

// Function to open client modal
function openClientModal() {
    clientModal.classList.remove('hidden');
}

// Function to close client modal
function closeClientModal() {
    clientModal.classList.add('hidden');
}

// Event listeners
clientButton.addEventListener('click', openClientModal);

// Close modal when clicking outside

// clientpop.addEventListener('click' , ()=>{
//     window.alert('heeey')
//     // let div = document.createElement('div');
//     // div.innerHTML = `
//         // <div class="bg-white rounded-lg shadow-lg p-6 mb-8">
//         //     <h2 class="text-xl font-bold mb-4">Ajouter un nouveau client</h2>
//         //     <form action="" method="POST" class="space-y-4">
//         //         <input type="hidden" name="action" value="ajouter">
//         //         <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
//         //             <div>
//         //                 <label class="block text-sm font-medium text-gray-700">Nom</label>
//         //                 <input type="text" name="nom" required
//         //                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
//         //             </div>
                  
//         //             <div class="md:col-span-2">
//         //                 <label class="block text-sm font-medium text-gray-700">Adresse</label>
//         //                 <textarea name="adresse" required
//         //                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"></textarea>
//         //             </div>
//         //             <div>
//         //                 <label class="block text-sm font-medium text-gray-700">Téléphone</label>
//         //                 <input type="tel" name="telephone" required
//         //                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
//         //             </div>
                   
                   
//         //         </div>
//         //         <div class="text-right">
//         //             <button type="submit"
//         //                     class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">
//         //                 Ajouter le client
//         //             </button>
//         //         </div>
//         //     </form>
//         // </div>
//     // `;
//     // document.body.appendChild('div');
// });

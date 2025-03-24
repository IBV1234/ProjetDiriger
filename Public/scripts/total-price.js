document.addEventListener('DOMContentLoaded', function () {
    const Empty = document.getElementById('sessionEmpty')?.value ?? "true";
    window.isEmpty = (Empty === "true");
    if (!window.isEmpty && window.isEmpty!=="") {
        //querySelectorAll('input[type="number"]: Sélectionne tous les champs de quantité 
        //[id^="quantity-"] → Sélectionne tous les inputs dont l'ID commence par "quantity-

        // Sélectionne tous les champs de quantité dont l'ID commence par "quantity-"
        const quantityInputs = document.querySelectorAll('input[type="number"][id^="quantity-"]');
        window.prixTotalElement = document.getElementById('prixTotal'); // Élément affichant le prix total
        // Fonction pour recalculer et mettre à jour le prix total
        function updatePrixTotal() {
            let total = 0;

            quantityInputs.forEach(input => {
                const price = parseFloat(input.getAttribute('data-price')); // Récupère le prix unitaire 
                const quantity = parseInt(input.value, 10) ?? 0; // Récupère la quantité sélectionnée
                total += price * quantity;
            });

            window.prixTotalElement.textContent = total.toFixed(); // Affichage avec 2 décimales
        }

        // Ajoute un écouteur d'événement à chaque input pour mettre à jour le prix total
        quantityInputs.forEach(input => {
            input.addEventListener('change', updatePrixTotal);
        });

        // Initialise le prix total au chargement de la page
        updatePrixTotal();
    }



});


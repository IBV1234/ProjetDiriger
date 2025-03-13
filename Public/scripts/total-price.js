document.addEventListener('DOMContentLoaded', function() {
    console.log(' 1');
    //querySelectorAll('input[type="number"]: Sélectionne tous les champs de quantité 
    //[id^="quantity-"] → Sélectionne tous les inputs dont l'ID commence par "quantity-
    const quantityInputs = document.querySelectorAll('input[type="number"][id^="quantity-"]');
    const prixTotalElement = document.getElementById('prixTotal');

    quantityInputs.forEach(input => {//forEach(input => {...}) → Parcourt chaque input de quantité
        input.addEventListener('change', function() {// input.addEventListener('change', function() {...}) → Déclenche une action lorsqu'un utilisateur modifie la quantité.
            let total = 0;
            quantityInputs.forEach(input => {//Recalcule le total pour chaque produit dans le panier.
                const price = parseFloat(input.getAttribute('data-price'));// Récupère le prix unitaire du produit depuis l'attribut HTML data-price (parseFloat convertit en nombre).
                const quantity = parseInt(input.value);//Récupère la quantité sélectionnée par l'utilisateur
                total += price * quantity;
                console.log(price, quantity, total);
            });
            //Met à jour l'affichage du prix total dans <span id="prixTotal">
            prixTotalElement.textContent = total.toFixed(2);//toFixed(2) → Affiche 2 décimales (ex: 9.50 au lieu de 9.5).
        });
    });
});

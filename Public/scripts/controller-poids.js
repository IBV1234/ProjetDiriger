document.addEventListener('DOMContentLoaded', function () {
    // Vérifie si le panier est vide
     
    if (!window.isEmpty && window.isEmpty!=="") {
        // Récupère les éléments essentiels
        const maxPoids = parseInt(document.getElementById('maxPoids').value, 10); // Poids maximal autorisé
        const afficherPoidsTotalElement = document.getElementById('poidsTotal'); // Affichage du poids total
        const quantityInputs = document.querySelectorAll('input[type="number"][id^="quantity-"]'); // Tous les champs de quantité
        const dexteriter = document.getElementById('Dex'); // Affichage de la dextérité
        const soldeJoueur = document.getElementById('caps').textContent;
        let isCorrectUtilite =false;

        
        function getResultUtiliter(Tabutilites){
            let isInPanier = false;
            for (const utiliteValue  of Tabutilites) {
                if(utiliteValue == '1'){
                    isInPanier = true;
                    break;
                }
            }
            return isInPanier;
        }
      
        function updatePoidsTotal() {        // Fonction pour recalculer et mettre à jour le poids total

            let totalPoids = 0;

            quantityInputs.forEach(input => {
                const quantity = parseInt(input.value, 10) ; // Assure une valeur numérique
                const poidsElement = input.closest('.col').querySelector('#poids'); // Récupère l'élément contenant le poids
                const poids = parseFloat(poidsElement.innerText) ; // Convertit en nombre
                const utilites = Array.from(document.querySelectorAll('.col #utilite')); // Récupère tous les inputs utilite dans les colonnes    
                totalPoids += poids * quantity;
                const valeursUtilites = utilites.map(utilite => utilite.defaultValue);

                isCorrectUtilite = getResultUtiliter(valeursUtilites);

            });

            afficherPoidsTotalElement.textContent = totalPoids.toFixed(); // Met à jour l'affichage
        }

        // Ajoute un écouteur d'événement à chaque input pour recalculer le poids total lors des changements
        quantityInputs.forEach(input => {
            input.addEventListener('change', updatePoidsTotal);
        });

        // Fonction appelée lors du paiement
        window.pay = function () {
            let totalPoids = parseFloat(afficherPoidsTotalElement.textContent) ;
            let dex = parseInt(dexteriter.textContent, 10);
                let solde = parseInt(soldeJoueur);
                let prixTotal = parseInt(window.prixTotalElement.textContent);
                
            if(isCorrectUtilite){
                if( prixTotal <=solde ){
                    if ( totalPoids > maxPoids) {
                        const userConfirmed = confirm(
                            'Le poids total de votre panier dépasse le poids maximum autorisé. Voulez-vous continuer?'
                        );
        
                        if (userConfirmed) {
                            dex -= 1; // Réduction de la dextérité si l'utilisateur dépasse le poids max
                            dexteriter.textContent = dex.toFixed();
                            document.getElementById('payerForm').submit();
                        } else {
                            dexteriter.textContent = dex.toFixed(); // Réaffiche la dextérité sans changement
                        }
                    } else {
                        document.getElementById('payerForm').submit();
                    }
                }else{
                    confirm("Vous n'avez pas assez de caps pour cette achat");
                    
                    
                }
            }else{
                confirm("Les types d'items nourritures et les  types d'items médicaments sont obligatoire dans le panier");
            }
        };

        // Initialise le poids total au chargement de la page
        updatePoidsTotal();
    }
});


//informations
/*
 window.pay = function () { ... }, cela définit la fonction pay sur l'objet global window, 
 ce qui permet d'y accéder depuis n'importe quel autre endroit de ton code JavaScript, 
 même dans des contextes différents (par exemple, dans des gestionnaires d'événements ou d'autres scripts externes(fichier js)).

 function pay() { ... }, la fonction pay serait définie dans la portée du bloc où elle se trouve. 
 Cela signifie que si on l'appelle dans un autre contexte (comme un événement ou dans un autre autre fichier js), 
 elle ne serait pas accessible
*/
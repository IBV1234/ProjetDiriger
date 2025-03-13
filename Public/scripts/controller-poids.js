document.addEventListener('DOMContentLoaded', function() {

    const isEmpty = document.getElementById('sessionEmpty').value;

  if(!isEmpty){

    const getMaxPoids = document.getElementById('maxPoids').value ;// prend le poids maximun
    const AfficherPoidsTotalElement = document.getElementById('poidsTotal');// variable pour afficher le poid total
    const quantityInputs = document.querySelectorAll('input[type="number"][id^="quantity-"]');// tous les inputs de type number avec le id=quantity-
    const dexteriter = document.getElementById('Dex');//variable qui contient la dexterité

    quantityInputs.forEach(input => {//Parcourt chaque input de quantité

        input.addEventListener('change', function() {// Déclenche une action lorsqu'un utilisateur modifie la quantité.
            let totalPoids = 0;
            let quantity = 0
            let getPoids = 0
            let  dex  = parseInt(dexteriter.textContent);

            quantityInputs.forEach(input => {//Recalcule le total pour chaque produit dans le panier.
                totalPoids = 0;
                quantity = 0
                quantity = parseInt(input.value);
                getPoids = 0
                getPoids = parseFloat(input.closest('.col').querySelector('#poids').innerText); // contient le poids de chaque items à la fois
                totalPoids += getPoids * quantity;
            });

            
            if(totalPoids > getMaxPoids){
                const userConfirmed = confirm('Le poids total de votre panier dépasse le poids maximum autorisé. Voulez-vous continuer?');

                if (userConfirmed) {
                    dex-=1;
                    dexteriter.textContent = dex.toFixed();
                    AfficherPoidsTotalElement.textContent = totalPoids.toFixed(2);

                }else{

                    totalPoids = getPoids * quantity ; // Adjust totalPoids
                    AfficherPoidsTotalElement.textContent = totalPoids.toFixed(1);
                    console.log(AfficherPoidsTotalElement.textContent ,"poidTotal si annuler");
                    dexteriter.textContent = dex.toFixed();
                }
            }else{
                AfficherPoidsTotalElement.textContent = totalPoids.toFixed(1);//toFixed(2) → Affiche 1 décimales (ex: 9.5)

            }

        });
    });


  }
});

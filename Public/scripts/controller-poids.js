document.addEventListener('DOMContentLoaded', function () {
    // Vérifie si le panier est vide
    if (!window.isEmpty && window.isEmpty !== "") {


        // Récupère les éléments essentiels
        const maxPoids = parseInt(document.getElementById('maxPoids').value, 10); // Poids maximal autorisé
        const afficherPoidsTotalElement = document.getElementById('poidsTotal'); // Affichage du poids total
        const quantityInputs = document.querySelectorAll('input[type="number"][id^="quantity-"]'); // Tous les champs de quantité
        const dexteriter = document.getElementById('Dex'); // Affichage de la dextérité
        const soldeJoueur = document.getElementById('caps').textContent;
        const poidTotalSac = document.getElementById('poidsSacDos').textContent;
        const utilitesSac = document.getElementById('utilite').value; // Récupère tous les inputs utilite dans les colonnes    

        let isCorrectUtiliteInSac = false;
        let isUtiliteInPanier = false;


    

        // Fonction pour envoyer un requête post au controller UpdateItemPanier pour update la quantité dans la bd
        window.updateItemQuantity = function(inputElement)  {
            // Récupérer les données de l'élément
            const itemId = inputElement.getAttribute('data-id');
            const newQuantity = inputElement.value;
        
         
            // Préparer les données à envoyer
            const data = {
                id: itemId,
                quantite: newQuantity
            };
        
            // Envoyer la requête AJAX
            fetch('/updateItemPanier', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(data)
            })
            .catch(error => {
                console.error('Erreur:', error);
                console.log('Une erreur est survenue lors de la mise à jour.');
            });
        }


        
            //fonction poour savoir si il y a une utilité 1 dans le sac à dos
        function getResultUtiliteInSac(utilites) {
            let isInSac = false;
            if (utilites == '1') {
                isInSac = true;

            }

            return isInSac;
        }

        //fonction poour savoir si il y a une utilité 1 dans le panier
        function getResultUtiliterInPanier(utilites) {
            let isInPainer = false;
            for (const utilite of utilites) {
                if (utilite == '1') {
                    isInPainer = true;
                    break;
                }

            }

            return isInPainer;
        }



        function updatePoidsTotal() {  // Fonction pour recalculer et mettre à jour le poids total

            let totalPoids = 0;

            quantityInputs.forEach(input => {
                const quantity = parseInt(input.value, 10); // Assure une valeur numérique
                const poidsElement = input.closest('.col').querySelector('#poids'); // Récupère l'élément contenant le poids
                const poids = parseFloat(poidsElement.innerText); // Convertit en nombre
                const utilites = Array.from(document.querySelectorAll('.col #utilites')); // Récupère tous les inputs utilite dans les colonnes    

                totalPoids += poids * quantity;
                let TabUtilites = utilites.map(utilite => utilite.defaultValue);
                isUtiliteInPanier = getResultUtiliterInPanier(TabUtilites)
                isCorrectUtiliteInSac = getResultUtiliteInSac(utilitesSac);

            });

            afficherPoidsTotalElement.textContent = totalPoids.toFixed(); // Met à jour l'affichage
        }


        // Ajoute un écouteur d'événement à chaque input pour recalculer le poids total lors des changements
        quantityInputs.forEach(input => {
            input.addEventListener('change', updatePoidsTotal);
        });


        function showModal(callback,text =null) {// Fonction de pop out et confirm custum avec un promesse on peut le faire avec un callback aussi

           // return new Promise((resolve) => {// Promise:permet de gérer cette attente sans bloquer l'exécution du reste du code(ok ou annuler).
                const modal = document.getElementById("confirmationModal")
             
                modal.classList.add("show"); // Afficher le modal
                const okButton = document.getElementById("okBtn");
                const cancelButton = document.getElementById("cancelBtn");
                const messageElement = document.getElementById("message"); // Récupérer l'élément de message
               
                if(text!=null)messageElement.textContent = text; // Mettre à jour le message
                // Ajouter les événements
                const onOkClick = () => {
                    modal.classList.remove("show");
                    callback(true);
                    cleanup();//Supprime les écouteurs d'événements pour éviter les bugs.
                };
        
                const onCancelClick = () => {
                    modal.classList.remove("show");
                    callback(false);
                    cleanup();
                };
        
                const cleanup = () => {//Si l'utilisateur ouvre et ferme plusieurs fois le modal, les événements click peuvent s'accumuler et causer des bugs.
                    okButton.removeEventListener("click", onOkClick);
                    cancelButton.removeEventListener("click", onCancelClick);
                };
        
                okButton.addEventListener("click", onOkClick);//Quand l'utilisateur clique sur un bouton, l'action correspondante est exécutée avec la foncton à droite
                cancelButton.addEventListener("click", onCancelClick);
           // });
        }



        // Fonction appelée lors du paiement
        window.pay = function () {
            let totalPoidsPanier = parseFloat(afficherPoidsTotalElement.textContent);
            let dex = parseInt(dexteriter.textContent, 10);
            let solde = parseInt(soldeJoueur);
            let prixTotal = parseInt(window.prixTotalElement.textContent);
            let totalPoidAuthorisé = totalPoidsPanier + parseInt(poidTotalSac);

            if (isCorrectUtiliteInSac == false && isUtiliteInPanier != false) isCorrectUtiliteInSac = isUtiliteInPanier;
            if (isCorrectUtiliteInSac == false && isUtiliteInPanier == false) isCorrectUtiliteInSac = false;

            if (isCorrectUtiliteInSac) {
                if (prixTotal <= solde) {
                    if (totalPoidAuthorisé > maxPoids) {
              
                        //showModal().then((userConfirmed) => { promesse

                            showModal((userConfirmed) => {// callback

                            if ((userConfirmed)) {
                                dex -= 1; // Réduction de la dextérité si l'utilisateur dépasse le poids max
                                dexteriter.textContent = dex.toFixed();
                                document.getElementById('payerForm').submit();
                            } else {

                                dexteriter.textContent = dex.toFixed(); // Réaffiche la dextérité sans changement
                            }
                       }, "Vous avez dépassé le poids maximum autorisé, êtes-vous sûr de vouloir continuer ?");


                    } else {
                        document.getElementById('payerForm').submit();
                    }
                } else {
                    // confirm("Vous n'avez pas assez de caps pour cette achat");
                    showModal((callback) => {
                        if (callback) {
                            console.log("");
                        } else {
                            console.log(""); // Réaffiche la dextérité sans changement
                        }
                    }, "Vous n'avez pas assez de caps pour cette achat");
                }

                
            } else {
               // confirm("Les types d'items nourritures et les  types d'items médicaments sont obligatoire dans le panier");
                showModal((callback) => {
                    if (callback) {
                        console.log("");
                    } else {
                        console.log(""); // Réaffiche la dextérité sans changement
                    }
                }, "Les types d'items nourritures et les  types d'items médicaments sont obligatoire dans le panier");
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

 la promesse est une manière de gérer les opérations asynchrones en JavaScript.
 Elle permet d'exécuter du code après qu'une opération asynchrone soit terminée,
 sans bloquer l'exécution du reste du code. Mais dans ce cas,
 on utilise un callback pour gérer l'affichage du modal et la réponse de l'utilisateur. car le but est de bloquer 
 l'exécution du reste du code jusqu'à ce que l'utilisateur prenne une décision.
*/

document.addEventListener('DOMContentLoaded', function () {
    function maxDex(idItem,action) {


        // Préparer les données à envoyer
        const data = {
            isMaxDex: true,
            action:action
        };

        // Envoyer la requête AJAX
        fetch(`/item-sac?id=${idItem}`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-Requested-With': 'XMLHttpRequest'// indique que c’est une requête AJAX pour s'assurer d'envoyer une reponse en json et non html dans le controller qui affiche une vue

            },
            body: JSON.stringify(data)
        })
            .then(response => {
                return response.json();
            })
            .then(result => {
                console.log("Réponse JSON :", result); 
                if (result.redirect) {
                    window.location.href = result.redirect;
                }
            })
            .catch(error => {
                console.error('Erreur:', error);
            });
        
    }

    function showModal(callback, text = null) {

        const modal = document.getElementById("confirmationModal")

        modal.classList.add("show");
        const okButton = document.getElementById("okBtn");
        const cancelButton = document.getElementById("cancelBtn");
        const messageElement = document.getElementById("message");

        if (text != null) messageElement.textContent = text;
        const onOkClick = () => {
            modal.classList.remove("show");
            callback(true);
            cleanup();
        };

        const onCancelClick = () => {
            modal.classList.remove("show");
            callback(false);
            cleanup();
        };

        const cleanup = () => {
            okButton.removeEventListener("click", onOkClick);
            cancelButton.removeEventListener("click", onCancelClick);
        };

        okButton.addEventListener("click", onOkClick);
        cancelButton.addEventListener("click", onCancelClick);
    }

    window.sell_eat_btn = function (action) {

        const dex = document.getElementById('dexteriter').value;
        const vie = document.getElementById('vie').value;
        const sell = document.getElementById('sell').value ?? null;
        const eat = document.getElementById('eat')?.value ?? null;
        const idTem = document.getElementById('idItem').value ;

        if (eat !== null || sell !== null) {

            let dexteriter = parseInt(dex,10);
            let hp = parseInt(vie,10);
            let messae ="";
            if(action=="use") messae ="consommer";
            if(action=="sell") messae ="vendre";

                if(dexteriter < 100 && hp< 100){
                    if(dexteriter ==99 && hp == 99) dexteriter = 100; hp = 100;
                    document.getElementById('action').value = action;
                    document.getElementById('sell_eat_form').submit();

                }else{
                        showModal((callback) => {
                            if (callback) {
                                maxDex(idTem,action);
                                console.log("");
                            } else {
                                console.log("");
                            }
                        }, `Vous ne pouvez plus augmenter votre dextériter.Voulez-vous toujours ${messae} ?`)
                    
                }
        } 
    }

});


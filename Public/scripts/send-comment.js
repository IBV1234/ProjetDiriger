document.addEventListener('DOMContentLoaded', function () {

    const comment = document.getElementById('comment');

    const etoiles = document.getElementById('quantity');

    const labelQt = document.getElementById('labelQt');
    const hiddeItem = () => {
        comment.classList.add("hide-add-message");
        etoiles.classList.add("hide-add-message");
        labelQt.classList.add("hide-add-message");
    }

    function showModal(callback, text = null) {

        const modal = document.getElementById("confirmationModalDetail")

        modal.classList.add("show");
        const okButton = document.getElementById("okBtnDetail");
        const cancelButton = document.getElementById("cancelBtnDetail");
        const messageElement = document.getElementById("messageDetail");

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

    document.getElementById('ajoutCommentaire').addEventListener("keydown", (event) => {

        if (event.key == "Enter") {
            event.preventDefault(); // Empêche le saut de ligne par défaut dans le textarea
         
            let texte = comment.value.trim();
            let etoile =  etoiles.value.trim();
           
            
            if (texte !== "" && etoile !== "" && texte.length > 0 && etoile.length > 0) {

                    if(etoile >=0 && etoile <= 5){
                        document.getElementById('ajoutCommentaire').submit();

                    }else{
                        showModal((callback) => {
                            if (callback) {
                                console.log("");
                            } else {
                                console.log("");
                            }
                        }, "Vous devez mettre une évaluation entre 0 et 5")
                    }
            } else {
                showModal((callback) => {
                    if (callback) {
                        console.log("");
                    } else {
                        console.log("");
                    }
                }, "Vous devez inscrire un commentaire et mettre une évaluation")

            }
        }
    })
    window.showTextAerea = function () {
        comment.classList.remove("hide-add-message");
        etoiles.classList.remove("hide-add-message");
        labelQt.classList.remove("hide-add-message");

    }
    hiddeItem();
});
document.addEventListener('DOMContentLoaded', function () {
    const comment = document.getElementById('comment');
    const etoiles = document.getElementById('quantity');
    const labelQt = document.getElementById('labelQt');
    const hiddeItem =()=>{
        comment.classList.add("hide-add-message");
        etoiles.classList.add("hide-add-message");
        labelQt.classList.add("hide-add-message");
    }
    comment.addEventListener("keydown", (event) => {
        if (event.key == "Enter") {
            event.preventDefault(); // Empêche le saut de ligne par défaut dans le textarea
            let texte = comment.value.trim();
            let etoile = parseInt(etoiles.value, 10);

            if (texte !== "" && texte !== null && etoiles.value.trim() !== "") {
                document.getElementById('ajoutCommentaire').submit();
            } else {
                confirm("Vous devez inscrire un commentaire et mettre une évaluation");

            }
        }
    })
    window.showTextAerea=function(){
        comment.classList.remove("hide-add-message");
        etoiles.classList.remove("hide-add-message");
        labelQt.classList.remove("hide-add-message");

    }
    hiddeItem();
});
<?php

require 'partials/head.php';
require 'partials/header.php';

?>

<div class="container-sm rounded-3 pb-5 bg-yellow-fallout">
    <div class="pt-4 d-flex justify-content-between align-items-center">
    <div></div><div></div>
        <p class="fw-semibold fs-2 bg-color-yellow-text px-2 rounded-1 ms-5">Modification du profil</p>
        <a class="mb-3 bg-lightblue-fallout account-display-modify px-2 pt-1 pb-1" href="/account"><i class="bi bi-arrow-left-square"></i></a>
        <div></div>
    </div>
    <div class="container-sm px-4 py-5 rounded-3 bg-lightblue-fallout max-width-profil pb-4">
        <div class="mx-auto">
            <div class="d-flex mb-4 mt-n5"> 
                <img class="pfp-image mx-auto" src="public/images/placeholder-square.jpg">
            </div>
            <div class="mb-3 account-display mx-auto bg-lightblue-fallout-contrast p-2">
                Nom & Prenom<br>
                <?php $name = $user->getFirstName() . " " . $user->getLastName() ?>
                <input type="text" class="form-control mt-1" disabled value="<?php echo $name ?>">
            </div>
            <div class="mb-3 account-display mx-auto bg-lightblue-fallout-contrast p-2">
                Nom d'utilisateur<br>
                <input type="text" class="form-control mt-1" disabled value="<?php echo $user->getAlias() ?>">
            </div>
            <div class="mb-3 account-display mx-auto bg-lightblue-fallout-contrast p-2">
                Email<br>
                <input type="email" class="form-control mt-1" disabled value="<?php echo $user->getEmail() ?>">
            </div>
            <div class="mb-3 account-display mx-auto bg-lightblue-fallout-contrast p-2">
                Mot de passe<br>
                <input type="password" class="form-control mt-1 mb-2" disabled value="*******">
                <a class="mb-3 bg-lightblue-fallout account-display-modify-password px-2 pt-1 pb-1" href=""><i class="bi bi-pencil-square"></i></a>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', () => {
    let isEditing = false; 

    const modifyIcon = document.querySelector('.account-display-modify-password');
    const passwordInput = document.querySelector('input[type="password"]');
    const passwordContainer = passwordInput.parentElement; 

    const clearFeedbackLabel = () => {
        const existingLabel = passwordContainer.querySelector('.feedback-label');
        if (existingLabel) {
            existingLabel.remove(); 
        }
    };

    const togglePasswordEdit = () => {
        if (isEditing) return; 

        isEditing = true; 

        clearFeedbackLabel(); 

        const newPasswordInput = document.createElement('input');
        newPasswordInput.type = 'password';
        newPasswordInput.className = 'form-control mt-1 mb-2';
        newPasswordInput.placeholder = 'New password';

        const verifyPasswordInput = document.createElement('input');
        verifyPasswordInput.type = 'password';
        verifyPasswordInput.className = 'form-control mt-1 mb-2';
        verifyPasswordInput.placeholder = 'Verify password';

        const checkmarkIcon = document.createElement('a');
        checkmarkIcon.className = 'mb-3 bg-lightblue-fallout account-display-modify px-2 pt-1 pb-1';
        checkmarkIcon.href = '#';
        checkmarkIcon.innerHTML = '<i class="bi bi-check"></i>';

        const cancelIcon = document.createElement('a');
        cancelIcon.className = 'mb-3 m-2 bg-lightblue-fallout account-display-modify px-2 pt-1 pb-1';
        cancelIcon.href = '#';
        cancelIcon.innerHTML = '<i class="bi bi-x"></i>';

        passwordInput.style.display = 'none'; 
        modifyIcon.style.display = 'none'; 

        passwordContainer.appendChild(newPasswordInput);
        passwordContainer.appendChild(verifyPasswordInput);
        passwordContainer.appendChild(checkmarkIcon);
        passwordContainer.appendChild(cancelIcon);

        let feedbackLabel = passwordContainer.querySelector('.feedback-label');
        if (!feedbackLabel) {
            feedbackLabel = document.createElement('div');
            feedbackLabel.className = 'mt-2 fw-bold feedback-label';
            passwordContainer.appendChild(feedbackLabel);
        }

        checkmarkIcon.addEventListener('click', (event) => {
            event.preventDefault();
            const newPassword = newPasswordInput.value;
            const verifyPassword = verifyPasswordInput.value;

            if (newPassword === verifyPassword) {
                feedbackLabel.textContent = 'Password changed successfully!';
                feedbackLabel.className = 'mt-2 fw-bold feedback-label text-success';
                // Example for AJAX or controller call
                // fetch('/your-controller-endpoint', {
                //     method: 'POST',
                //     headers: { 'Content-Type': 'application/json' },
                //     body: JSON.stringify({ userId: USER_ID, password: newPassword })
                // }).then(response => response.json())
                //   .then(data => console.log(data))
                //   .catch(error => console.error('Error:', error));

                // Restore original state
                cancelIcon.click();
            } else {
                feedbackLabel.textContent = 'Passwords do not match.';
                feedbackLabel.className = 'mt-2 fw-bold feedback-label text-danger';
            }
        });

        cancelIcon.addEventListener('click', (event) => {
            event.preventDefault();

            newPasswordInput.remove();
            verifyPasswordInput.remove();
            checkmarkIcon.remove();
            cancelIcon.remove();

            passwordInput.style.display = ''; 
            modifyIcon.style.display = ''; 

            isEditing = false; 
        });
    };

    modifyIcon.addEventListener('click', (event) => {
        event.preventDefault();
        togglePasswordEdit(); 
    });
});
</script>

<?php require 'partials/footer.php' ?>
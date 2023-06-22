$(document).ready(function () {
    // verification pop-up
    function showAlert(message, type) {
        var alertElement = document.createElement('div');
        alertElement.classList.add('alert', 'alert-' + type, 'alert-dismissible', 'fade', 'show');
        alertElement.innerHTML = `
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        ${message}
    `;

        var container = document.getElementById('alert-container');
        container.appendChild(alertElement);

        setTimeout(function () {
            alertElement.classList.remove('show');
            setTimeout(function () {
                alertElement.remove();
            }, 300);
        }, 5000);
    }


    const Modal = document.getElementById('verifyModal');
    if (Modal) {
        Modal.addEventListener('show.bs.modal', event => {
            const button = event.relatedTarget;
            const content = button.getAttribute('data-bs-content');
            const modalConfirmButton = Modal.querySelector('.modal-confirm-button');;
            modalConfirmButton.innerHTML = content;
            const actionInput = Modal.querySelector('input[name="action"]');
            actionInput.value = content;
        })
    };
    $('#validationForm').submit(function (event) {
        event.preventDefault();
        var formData = $(this).serialize();
        $.ajax({
            type: 'POST',
            url: 'validate.php',
            data: formData,
            success: function (data) {
                $("#verifyModal").modal('toggle');
                console.log(data);
                if (data != 'password is incorrect') {
                    showAlert(data, 'success');
                } else {
                    showAlert(data, 'danger');
                }
            }
        });
    });





});
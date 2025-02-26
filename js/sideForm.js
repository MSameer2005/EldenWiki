// JavaScript per aprire e chiudere la forma rettangolare a scomparsa
document.addEventListener('DOMContentLoaded', (event) => {
    var openFormButton = document.getElementById('openFormButton');
    var closeFormButton = document.getElementById('closeFormButton');
    var sideForm = document.getElementById('sideForm');

    openFormButton.onclick = function () {
        sideForm.style.width = '25%';
    }

    closeFormButton.onclick = function () {
        sideForm.style.width = '0';
    }

    window.onclick = function (event) {
        if (event.target == sideForm) {
            sideForm.style.width = '0';
        }
    }
});

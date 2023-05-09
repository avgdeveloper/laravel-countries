import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

var editModals = document.querySelectorAll(".open-edit-modal");
editModals.forEach(function(modal) {
  modal.addEventListener("click", function() {
    var countryId = this.getAttribute('data-id');
    var countryName = this.getAttribute('data-name');
    var countryIso = this.getAttribute('data-iso');
    var userId = this.getAttribute('data-user-id');

    document.querySelector('.modal-body #countryId').value = countryId;
    document.querySelector('.modal-body #countryName').value = countryName;
    document.querySelector('.modal-body #countryIso').value = countryIso;
    document.querySelector('.modal-body #userId').value = userId;
    var countryDeleteLink = document.querySelector('.modal-footer #countryDelete');
    var href = countryDeleteLink.getAttribute("data-base-href");
    href += "/" + countryId;
    countryDeleteLink.setAttribute("href", href);
  });
});
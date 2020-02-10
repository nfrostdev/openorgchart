// Header navigation expansion.
const burger = document.getElementById('primary-burger');
const menu = document.getElementById('primary-menu');

function togglePrimaryMenu() {
    burger.classList.toggle('is-active');
    burger.setAttribute('aria-expanded', burger.getAttribute('aria-expanded') === 'true' ? 'false' : 'true');
    menu.classList.toggle('is-active');
}

burger.addEventListener('click', togglePrimaryMenu);

function showSubmitButtonLoading() {
    document.getElementById('submit-button').classList.add('is-loading')
}

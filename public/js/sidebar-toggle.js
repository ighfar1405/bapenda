//  check if DOM is fully loaded
document.addEventListener('DOMContentLoaded', () => {
    initToggle();
});

const initToggle = () => {
    document.querySelector('#burger-btn').addEventListener('click', () => {
        const mainWrapper = document.querySelector('#panel');
        const sidebar = document.querySelector('#sidenav-main');

        mainWrapper.classList.toggle('panel-widden');
        sidebar.classList.toggle('sidebar-hide');
    });
}
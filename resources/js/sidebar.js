if (document.getElementById('sidebar') && document.getElementById('toggleSidebar') && document.getElementById('menuIcon')){

    document.addEventListener('DOMContentLoaded', function () {
        const toggleSidebarButton = document.getElementById('toggleSidebar');
        const sidebar = document.getElementById('sidebar');
        const menuIcon = document.getElementById('menuIcon');

        toggleSidebarButton.addEventListener('click', function () {
            const isOpen = sidebar.classList.contains('translate-x-0');
            if (isOpen) {
                sidebar.classList.remove('translate-x-0');
                sidebar.classList.add('-translate-x-full');
                menuIcon.setAttribute('d', 'M4 6h16v2H4V6zm0 5h16v2H4v-2zm0 5h16v2H4v-2z');
            } else {
                sidebar.classList.remove('-translate-x-full');
                sidebar.classList.add('translate-x-0');
                menuIcon.setAttribute('d', 'M4 6h16v2H4V6zm0 7h16v2H4v-2zm0 7h16v2H4v-2z');
            }
        });
    });

}

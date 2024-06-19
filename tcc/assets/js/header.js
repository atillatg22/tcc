document.addEventListener("DOMContentLoaded", function() {
    let sidebar = document.querySelector(".sidebar");
    let closeBtn = document.querySelector("#btn");
    let logOutBtn = document.querySelector("#log_out");

    closeBtn.addEventListener("click", () => {
        sidebar.classList.toggle("open");
        menuBtnChange();
    });

    logOutBtn.addEventListener("click", (e) => {
        e.preventDefault(); // Evita o comportamento padrão do link

        Swal.fire({
            title: 'Você deseja realmente sair?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            cancelButtonText: 'Cancelar',
            confirmButtonText: 'Sair'
        }).then((result) => {
            if (result.isConfirmed) {
                // Aqui você pode adicionar o redirecionamento para a página de logout
                window.location.href = "index.php";
            }
        });
    });

    function menuBtnChange() {
        if (sidebar.classList.contains("open")) {
            closeBtn.classList.replace("bx-menu", "bx-menu-alt-right");
        } else {
            closeBtn.classList.replace("bx-menu-alt-right", "bx-menu");
        }
    }
});

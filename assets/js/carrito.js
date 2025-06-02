document.addEventListener("DOMContentLoaded", function () {
    // Selecciona todos los formularios de productos
    const forms = document.querySelectorAll(".form-carrito");
    const carritoSidebar = document.getElementById("carrito-sidebar");
    const contenidoCarrito = document.getElementById("contenido-carrito");
    const cerrarBtn = document.getElementById("cerrar-carrito");

    forms.forEach(form => {
        form.addEventListener("submit", function (e) {
            e.preventDefault(); 
            const productId = this.dataset.id;

            // Llamo al controlador del carrito para añadir el producto al carrito 
            fetch("../controllers/carritoController.php", {
                method: "POST",
                headers: { "Content-Type": "application/x-www-form-urlencoded" },
                body: `product_id=${productId}&action=add`
            })
            .then(() => {
                // Después de añadir los productos, pido el HTML del carrito ya con todas las cosas
                fetch("../api/carrito.php")
                    .then(res => res.text())
                    .then(html => {
                        // Relleno el sidebar 
                        contenidoCarrito.innerHTML = html;
                        // Muestro el sidebar
                        carritoSidebar.classList.add("activo");
                        // Muestro el botón de cerrar
                        cerrarBtn.classList.remove("oculto"); 
                    });
            });
        });
    });

    // Al clicar en el botón de cerrar, oculto el sideba
    cerrarBtn.addEventListener("click", () => {
        carritoSidebar.classList.remove("activo");
        cerrarBtn.classList.add("oculto");
    });

    // Si clico fuera del sidebar y fuera del botón de añadir, se cierra también
    document.addEventListener("click", function (e) {
        if (
            carritoSidebar.classList.contains("activo") &&
            !carritoSidebar.contains(e.target) &&
            !e.target.closest(".form-carrito")
        ) {
            carritoSidebar.classList.remove("activo");
            cerrarBtn.classList.add("oculto");
        }
    });
});

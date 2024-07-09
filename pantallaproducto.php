<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Productos - Don Perico</title>
    <link rel="stylesheet" href="css/global.css">
    <link rel="stylesheet" href="css/producto.css">
</head>
<body>
    <?php include('headerindex.php'); ?>
    
    <div class="contenedor-productos">
        <aside class="filtros">
            <h2>Yoghurt</h2>
            <p id="productos-count">0 productos</p>
            <div class="subcategorias">
                <h3>Subcategorías</h3>
                <ul id="categorias-list">
                    </ul>
            </div>
            <div class="filtros-adicionales">
                <h3>Filtros</h3>
                <label for="promociones">
                    <input type="checkbox" id="promociones"> Promociones
                </label>
                <h3>Marca</h3>
                </div>
        </aside>
        <section class="productos">
            <div class="ordenar">
                <label for="ordenar">Ordenar</label>
                <select id="ordenar">
                    <option value="recomendados">Recomendados</option>
                    <option value="precio-asc">Precio: Menor a Mayor</option>
                    <option value="precio-desc">Precio: Mayor a Menor</option>
                </select>
            </div>
            <div class="lista-productos" id="productos-list">
                </div>
        </section>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Cargar categorías y productos desde logicapantallaproducto.php
            fetch('logicapantallaproducto.php')
                .then(response => response.json())
                .then(data => {
                    // Actualizar el conteo de productos
                    document.getElementById('productos-count').innerText = `${data.productos.length} productos`;

                    // Cargar categorías y subcategorías
                    const categoriasList = document.getElementById('categorias-list');
                    data.categorias.forEach(categoria => {
                        const categoriaItem = document.createElement('li');
                        categoriaItem.innerHTML = `<strong>${categoria.nombre}</strong>`;
                        const subcategoriasList = document.createElement('ul');
                        categoria.subcategorias.forEach(subcategoria => {
                            const subcategoriaItem = document.createElement('li');
                            subcategoriaItem.innerHTML = `<a href="#">${subcategoria.nombre}</a>`;
                            subcategoriasList.appendChild(subcategoriaItem);
                        });
                        categoriaItem.appendChild(subcategoriasList);
                        categoriasList.appendChild(categoriaItem);
                    });

                    // Cargar productos
                    const productosList = document.getElementById('productos-list');
                    data.productos.forEach(producto => {
                        const productoDiv = document.createElement('div');
                        productoDiv.classList.add('producto');
                        productoDiv.innerHTML = `
                            <img src="${producto.imagen}" alt="${producto.nombre}">
                            <p class="precio">$${producto.precio}</p>
                            <p class="descripcion">${producto.nombre}</p>
                            <button class="btn-agregar" data-id="${producto.id}">Agregar</button>
                        `;
                        productosList.appendChild(productoDiv);
                    });

                    // Agregar eventos a los botones "Agregar"
                    const addButtons = document.querySelectorAll('.btn-agregar');
                    addButtons.forEach(button => {
                        button.addEventListener('click', function() {
                            const productId = this.getAttribute('data-id');

                            fetch('logicapantallaproducto.php', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/x-www-form-urlencoded'
                                },
                                body: `action=add&product_id=${productId}`
                            })
                            .then(response => response.json())
                            .then(data => {
                                console.log('Producto agregado al carrito:', data);
                                actualizarCarrito(data.cart); // Llamada para actualizar el carrito
                            })
                            .catch(error => console.error('Error:', error));
                        });
                    });
                })
                .catch(error => console.error('Error:', error));
        });
    </script>
</body>
</html>

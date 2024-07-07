let carrito = [];

function agregarAlCarrito(id, nombre, precio, stock) {
    let producto = carrito.find(p => p.id === id);
    if (producto) {
        if (producto.cantidad < stock) {
            producto.cantidad += 1;
        } else {
            alert('No hay suficiente stock disponible');
        }
    } else {
        carrito.push({ id, nombre, precio, cantidad: 1, stock });
    }
    actualizarCarrito();
}

function quitarDelCarrito(id) {
    let producto = carrito.find(p => p.id === id);
    if (producto) {
        if (producto.cantidad > 1) {
            producto.cantidad -= 1;
        } else {
            carrito = carrito.filter(p => p.id !== id);
        }
    }
    actualizarCarrito();
}

function actualizarCarrito() {
    const listaCarrito = document.getElementById('carrito-lista');
    const totalCarrito = document.getElementById('total-carrito');
    const carritoInput = document.getElementById('carrito');
    listaCarrito.innerHTML = '';
    let total = 0;

    carrito.forEach(producto => {
        total += producto.precio * producto.cantidad;
        listaCarrito.innerHTML += `<li>${producto.nombre} - ${producto.cantidad} x $${producto.precio} 
        <button onclick="agregarAlCarrito(${producto.id}, '${producto.nombre}', ${producto.precio}, ${producto.stock})">+</button>
        <button onclick="quitarDelCarrito(${producto.id})">-</button></li>`;
    });

    totalCarrito.innerText = total.toFixed(2);
    carritoInput.value = JSON.stringify(carrito);
}

document.getElementById('form-procesar-compra').addEventListener('submit', function(event) {
    if (carrito.length === 0) {
        alert('El carrito está vacío');
        event.preventDefault();
        return;
    }

    // Aquí puedes agregar la lógica para procesar la compra
    // y disminuir el stock de productos en la base de datos
    alert('Compra procesada');
    carrito = [];
    actualizarCarrito();
});

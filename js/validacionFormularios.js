function validarCampo(inputId, outputId, inputType){
    var value = document.getElementById(inputId).value;
    var correoPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
    var telefonoPattern = /^[0-9]{8,15}$/;
    var rutPattern = /^\d{1,2}\.\d{3}\.\d{3}-[kK\d]$/;

    if(inputType == "letras"){
        if (value.trim() == "") {
            document.getElementById(outputId).innerText = "No puede estar vacío.";
            return false;
        } else if(inputId == "rut") {
            if (!rutPattern.test(value)){
                document.getElementById(outputId).innerText = "El RUT no tiene un formato válido. Ejemplo: 1.111.111-1";
                return false;
            } else {
                document.getElementById(outputId).innerText = "";
                return true;
            }
        } else if (inputId == "telefono"){
            if (!telefonoPattern.test(value)){
                document.getElementById(outputId).innerText = "El teléfono debe tener entre 8 y 15 dígitos.";
                return false;
            } else {
                document.getElementById(outputId).innerText = "";
                return true;
            }
        } else if (inputId == "correo"){
            if (!correoPattern.test(value)){
                document.getElementById(outputId).innerText = "Por favor ingrese un correo electrónico válido.";
                return false;
            } else {
                document.getElementById(outputId).innerText = "";
                return true;
            }
        } else if (inputId == "contrasena"){
            if (value.length < 5) {
                document.getElementById(outputId).innerText = "La contraseña debe tener un minimo de 5 caracteres.";
                return false;
            } else {
                document.getElementById(outputId).innerText = "";
                return true;
            }
        } else {
            document.getElementById(outputId).innerText = "";
            return true;
        }
    } else {
        if (value <= 0) {
            document.getElementById(outputId).innerText = "No puede ser 0.";
            return false;
        } else {
            document.getElementById(outputId).innerText = "";
            return true;
        }
    }
}

// Función para verificar si todos los campos son válidos
function validateForm() {
    let valido = true;

    let camposFormulario = [
        {"nombreCampo": "name", "subTexto":"nombreOutput", "tipo": "letras"},
        {"nombreCampo": "rut", "subTexto":"rutOutput", "tipo": "letras"},
        {"nombreCampo": "telefono", "subTexto":"telefonoOutput", "tipo": "letras"},
        {"nombreCampo": "correo", "subTexto":"correoOutput", "tipo": "letras"},
        {"nombreCampo": "contrasena", "subTexto":"contrasenaOutput", "tipo": "letras"},
        {"nombreCampo": "cargo", "subTexto":"cargoOutput", "tipo": "letras"},
        {"nombreCampo": "sueldo", "subTexto":"sueldoOutput", "tipo": "numeros"},
        {"nombreCampo": "descripcion", "subTexto":"descripcionOutput", "tipo": "letras"},
        {"nombreCampo": "precio", "subTexto":"precioOutput", "tipo": "numeros"},
        {"nombreCampo": "cantidad", "subTexto":"cantidadOutput", "tipo": "numeros"}
    ]

    camposFormulario.forEach((elemento) => {
        if(document.getElementById(elemento.nombreCampo)){ 
            if(!validarCampo(elemento.nombreCampo, elemento.subTexto, elemento.tipo)){
                valido = false;
            }
        }
    });

    if (!valido) {
        document.getElementById('buttonSubmit').disabled = true;
    } else {
        document.getElementById('buttonSubmit').disabled = false;
    }
}

// Se agregan los eventos de validación a los campos de entrada
document.addEventListener("DOMContentLoaded", function() {
    if(document.getElementById('name')){
        document.getElementById('name').addEventListener('input', function() {
            validarCampo('name', 'nombreOutput', "letras");
            validateForm();
        });
    }
    if(document.getElementById('rut')){
        document.getElementById('rut').addEventListener('input', function() {
            validarCampo('rut', 'rutOutput', "letras");
            validateForm();
        });
    }
    if(document.getElementById('telefono')){
        document.getElementById('telefono').addEventListener('input', function() {
            validarCampo('telefono', 'telefonoOutput', "letras");
            validateForm();
        });
    }
    if(document.getElementById('correo')){
        document.getElementById('correo').addEventListener('input', function() {
            validarCampo('correo', 'correoOutput', "letras");
            validateForm();
        });
    }
    if(document.getElementById('contrasena')){
        document.getElementById('contrasena').addEventListener('input', function() {
            validarCampo('contrasena', 'contrasenaOutput', "letras");
            validateForm();
        });
    }
    if(document.getElementById('cargo')){
        document.getElementById('cargo').addEventListener('input', function() {
            validarCampo('cargo', 'cargoOutput', "letras");
            validateForm();
        });
    }
    if(document.getElementById('sueldo')){
        document.getElementById('sueldo').addEventListener('input', function() {
            validarCampo('sueldo', 'sueldoOutput', "numeros");
            validateForm();
        });
    }    
    if(document.getElementById('descripcion')){
        document.getElementById('descripcion').addEventListener('input', function() {
            validarCampo('descripcion', 'descripcionOutput', "letras");
            validateForm();
        });
    }
    if(document.getElementById('precio')){
        document.getElementById('precio').addEventListener('input', function() {
            validarCampo('precio', 'precioOutput', "numeros");
            validateForm();
        });
    }
    if(document.getElementById('cantidad')){
        document.getElementById('cantidad').addEventListener('input', function() {
            validarCampo('cantidad', 'cantidadOutput', "numeros");
            validateForm();
        });
    }
    validateForm();
});

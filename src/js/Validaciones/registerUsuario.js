function validarFormulario() {
    // Obtener los valores de los campos
    var nombre = document.getElementById("nombre_cli").value.trim();
    var apellidos = document.getElementById("apellidos_cli").value.trim();
    var direccion = document.getElementById("direccion_cli").value.trim();
    var telefono = document.getElementById("telefono_cli").value.trim();
    var correo = document.getElementById("correo_cli").value.trim();
    var contraseña = document.getElementById("contraseña").value.trim();
    var genero = document.getElementById("genero_cli").value;
    var fechaNacimiento = document.getElementById("fecha_nac_cli").value;

    // Expresión regular para validar correo electrónico
    var emailRegex = /^\S+@\S+\.\S+$/;

    // Validar que la contraseña tenga al menos 4 caracteres
    if (contraseña.length < 4) {
        alert("La contraseña debe tener al menos 4 caracteres.");
        return false;
    }

    // Validar que el teléfono contenga solo números
    if (!/^\d+$/.test(telefono)) {
        alert("El teléfono solo puede contener números.");
        return false;
    }

    // Validar que se haya ingresado una dirección de correo electrónico válida
    if (!emailRegex.test(correo)) {
        alert("Por favor, ingresa una dirección de correo electrónico válida.");
        return false;
    }

    // Validar que el nombre no contenga números
    if (/\d/.test(nombre)) {
        alert("El nombre no puede contener números.");
        return false;
    }

    // Validar que el apellido no contenga números
    if (/\d/.test(apellidos)) {
        alert("Los apellidos no pueden contener números.");
        return false;
    }

    // Calcular la edad a partir de la fecha de nacimiento


    // Si todas las validaciones son exitosas, el formulario se enviará
    return true;
}

// Bloquear entrada de números en el campo de nombre
 // Bloquear entrada de caracteres especiales en el campo de nombre
 document.getElementById("nombre_cli").addEventListener("input", function() {
    this.value = this.value.replace(/[^a-zA-Z]/g, "");
});

// Bloquear entrada de caracteres especiales en el campo de apellidos
document.getElementById("apellidos_cli").addEventListener("input", function() {
    this.value = this.value.replace(/[^a-zA-Z]/g, "");
});

// Bloquear entrada de letras en el campo de teléfono
 // Bloquear entrada de letras y caracteres especiales en el campo de teléfono
 document.getElementById("telefono_cli").addEventListener("input", function() {
    this.value = this.value.replace(/[^\d]/g, "");
});
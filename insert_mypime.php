<?php

include 'conexion.php';

// Verificar la conexión
if (mysqli_connect_errno()) {
    echo "Error en la conexión a MySQL: " . mysqli_connect_error();
    exit();
}

// Recibir datos del formulario
$nit_mypime = $_POST['nit_mypime'];
$name_mypime = $_POST['name_mypime'];
$photo = $_POST['photo'];
$address_mypime = $_POST['address_mypime'];
$phone_mypime = $_POST['phone_mypime'];
$email_mypime = $_POST['email_mypime'];
$user_mypime = $_POST['user_mypime'];
$password_mypime = $_POST['password_mypime'];

// Consulta para insertar los datos en la tabla tbl_mypimes
$query = "INSERT INTO tbl_mypimes (nit_mypime, name_mypime, photo, address_mypime, phone_mypime, email_mypime, user_mypime, password_mypime, fecha_registro_mypime) 
          VALUES ('$nit_mypime', '$name_mypime', '$photo', '$address_mypime', '$phone_mypime', '$email_mypime', '$user_mypime', '$password_mypime', NOW())";

// Ejecutar la consulta
if (mysqli_query($conexion, $query)) {
    echo "MyPIME agregada exitosamente.";
} else {
    echo "Error al agregar MyPIME: " . mysqli_error($conexion);
}

// Cerrar conexión
mysqli_close($conexion);

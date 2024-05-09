<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Iniciar Sesión</title>
  <link rel="stylesheet" href="../css/output.css">
</head>
<body class="bg-fondo bg-cover bg-center bg-fixed bg-no-repeat min-h-screen flex justify-center items-center">
  <div class="w-96 h-96 flex flex-col bg-white px-8 py-7 rounded-xl box-border shadow-2xl gap-5">
    <h1 class="text-lg text-center font-bold mb-10 text-yellow-500">Iniciar sesion</h1>

    <?php
      //  Show success or error messages (Keep your PHP code)
      session_start();
      if (isset($_SESSION['success_login'])) {
        echo "<p class='message success'>" . $_SESSION['success_login'] . "</p>";
        unset($_SESSION['success_login']);
      }
      if (isset($_SESSION['error_login'])) {
        echo "<p class='message error'>" . $_SESSION['error_login'] . "</p>";
        unset($_SESSION['error_login']);
      }
    ?>

    <form action="process_login_cliente.php" method="POST" class="space-y-4 justify-center">
      <div class="flex flex-col mb-6">
        <label for="correo_cli" class="text-gray-700 mb-2 flex items-center">
          <span class="absolute left-[58%] top-[41%] pl-3 w-5 h-5 bg-center bg-cover rounded-full bg-iconu"></span>
        </label>
        <input type="email" id="correo_cli" name="correo_cli" required class="rounded-b-xl border-b border-gray-300 px-3 py-2 focus:outline-none focus:ring-blue-500 focus:border-blue-500" placeholder="Correo electronico">
      </div>

      <div class="flex flex-col mb-6">
        <label for="contraseña" class="text-gray-700 mb-2 flex items-center">
          <span class="absolute left-[58%] top-[52%] pl-3 w-5 h-5 bg-center bg-cover rounded-full bg-iconp"></span>
        </label>
        <input type="password" id="contraseña" name="contraseña" required class="rounded-b-xl border-b border-gray-300 px-3 py-2 focus:outline-none focus:ring-blue-500 focus:border-blue-500" placeholder="Contraseña">
      </div>

      <p class="mt-4 text-center text-gray-500">¿No tienes una cuenta? <a href="./registro_cliente.php" class="text-blue-500 hover:underline">Registrate aquí</a></p>

      <button type="submit" class="w-full rounded-3xl bg-yellow-500 py-2 px-4 text-white font-medium hover:bg-yellow-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">Iniciar</button>
    </form>
  </div>
</body>
</html>

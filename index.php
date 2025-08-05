<?php
include './database/db_connection.php';

$message = "";
$toastClass = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    // Prepare and execute
    $stmt = $conn->prepare("SELECT senha FROM usuarios WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($db_password);
        $stmt->fetch();

        if ($senha === $db_password) {
            $message = "Login successful";
            $toastClass = "bg-success";
            // Start the session and redirect to the dashboard or home page
            session_start();
            $_SESSION['email'] = $email;
            header("Location: painel.html");
            exit();
        } else {
            $message = "Incorrect password";
            $toastClass = "bg-danger";
        }
    } else {
        $message = "Email not found";
        $toastClass = "bg-warning";
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login - Reporte Já</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="/styles/style.css">
</head>
<body>

<div class="login-container">
  <img src="assets/img/logo.jpeg" alt="Logo do sistema Reporte Já" class="img-fluid mb-4" style="max-height: 100px;">
  <h2>Bem-vindo(a) ao Reporte Já – Área Administrativa</h2>
  <p class="mb-4">Acesse sua conta para gerenciar as ocorrências de manutenção.</p>

  <form method="POST" action="">
    <div class="mb-3 text-start">
      <label class="form-label">E-mail</label>
      <input type="email" name='email' class="form-control" placeholder="Digite seu e-mail">
    </div>
    <div class="mb-3 text-start">
      <label class="form-label">Senha</label>
      <input type="password" name='senha'  class="form-control" placeholder="Digite sua senha">
    </div>
    <button type="submit" class="btn btn-primary w-100">Entrar</button>
    <div class="mt-2">
      <a href="#">Esqueceu sua senha?</a>
    </div>
  </form>
</div>

<footer>
  © 2025 Reporte Já. Todos os direitos reservados.
</footer>

<hr class="my-5">

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="./scripts/Entrar.js"></script>
</body>
</html>
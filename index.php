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
    <link rel="stylesheet" href="styles/entrar.css">
</head>
<body>

    <div class="main-wrapper">
        <div class="welcome-section">
            <img src="./assets/img/logo2.jfif" alt="Logo do sistema Reporte Já" class="logo-img">
            <p class="welcome-title">Bem-vindo(a) ao Reporte Já – Área Administrativa</p>
            <p class="welcome-description">Acesse sua conta para gerenciar as ocorrências de manutenção.</p>
        </div>

        <div class="login-section">
            <h3 class="login-title">Login</h3>

            <form class="login-form" method="POST" action="">
                <div class="form-group">
                    <label for="email">Seu e-mail</label>
                    <input type="email" name='email' id="email" class="form-control" placeholder="exemplo333@gmail.com">
                </div>
                <div class="form-group">
                    <label for="password">Sua senha</label>
                    <input type="password" name='senha' id="password" class="form-control" placeholder="1234667">
                </div>
                <div class="forgot-password">
                    <a href="#">Esqueceu a sua senha?</a>
                </div>
                <button type="submit" class="btn-login">Login</button>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
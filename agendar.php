<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "smile_system";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  die("Falha na conexão: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $nome = $_POST['nome'];
  $nascimento = $_POST['nascimento'];
  $email = $_POST['email'];
  $telefone = $_POST['telefone'];

  $sql = "INSERT INTO agendamentos (nome, nascimento, email, telefone) VALUES ('$nome', '$nascimento', '$email', '$telefone')";
  
  if ($conn->query($sql) === TRUE) {
    echo "<script>alert('Consulta agendada com sucesso!');</script>";
  } else {
    echo "Erro: " . $conn->error;
  }
}
$conn->close();
?>

<!doctype html>
<html lang="pt-BR">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Agendar Consulta - Smile System</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <header class="site-header">
    <nav class="nav">
      <a class="logo" href="index.html">
        <img src="img/logo.png" alt="Smile System" class="logo-img">
        <span class="brand">Smile System</span>
      </a>
      <ul class="nav-links">
        <li><a href="index.html">Início</a></li>
        <li><a href="servicos.html">Serviços</a></li>
        <li><a href="agendar.php" class="active">Agendar</a></li>
        <li><a href="sobre.html">Sobre</a></li>
      </ul>
    </nav>
  </header>

  <main class="container">
    <h1>Agendar Consulta</h1>
    <form action="agendar.php" method="POST" class="form-agendar">
      <label>Nome completo:</label>
      <input type="text" name="nome" required>

      <label>Data de nascimento:</label>
      <input type="date" name="nascimento" required>

      <label>E-mail:</label>
      <input type="email" name="email" required>

      <label>Celular/Telefone:</label>
      <input type="text" name="telefone" required>

      <button type="submit" class="btn-primary">Enviar</button>
    </form>
  </main>

  <footer class="site-footer">
    <p>© <span id="year"></span> Smile System — Todos os direitos reservados</p>
  </footer>

  <script>
    document.getElementById('year').textContent = new Date().getFullYear();
  </script>
</body>
</html>

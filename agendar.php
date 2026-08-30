<?php

declare(strict_types=1);

$servername = 'localhost';
$username = 'root';
$password = '';
$dbname = 'smile_system';

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    http_response_code(500);
    exit('Não foi possível conectar ao banco de dados.');
}
$conn->set_charset('utf8mb4');

$mensagem = '';
$tipoMensagem = '';
$valores = [
    'nome' => '',
    'nascimento' => '',
    'email' => '',
    'telefone' => '',
    'data_consulta' => '',
    'hora_consulta' => '',
    'observacoes' => '',
];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    foreach ($valores as $campo => $_) {
        $valores[$campo] = trim((string)($_POST[$campo] ?? ''));
    }

    $erros = [];
    $dataNascimento = DateTime::createFromFormat('Y-m-d', $valores['nascimento']);
    $dataConsulta = DateTime::createFromFormat('Y-m-d', $valores['data_consulta']);

    if ($valores['nome'] === '' || mb_strlen($valores['nome']) < 3) {
        $erros[] = 'Informe seu nome completo.';
    }
    if (!$dataNascimento || $dataNascimento->format('Y-m-d') !== $valores['nascimento']) {
        $erros[] = 'Informe uma data de nascimento válida.';
    }
    if (!filter_var($valores['email'], FILTER_VALIDATE_EMAIL)) {
        $erros[] = 'Informe um e-mail válido.';
    }
    if (!preg_match('/^[0-9 ()+.-]{8,20}$/', $valores['telefone'])) {
        $erros[] = 'Informe um telefone válido.';
    }
    if (!$dataConsulta || $dataConsulta->format('Y-m-d') !== $valores['data_consulta'] || $valores['data_consulta'] < date('Y-m-d')) {
        $erros[] = 'Escolha uma data futura para a consulta.';
    }
    if (!preg_match('/^(08|09|10|11|13|14|15|16|17):[0-5][0-9]$/', $valores['hora_consulta'])) {
        $erros[] = 'Escolha um horário de atendimento válido.';
    }
    if ($dataNascimento && $dataConsulta && $dataNascimento >= $dataConsulta) {
        $erros[] = 'A data de nascimento deve ser anterior à data da consulta.';
    }
    if (mb_strlen($valores['observacoes']) > 500) {
        $erros[] = 'As observações devem ter no máximo 500 caracteres.';
    }

    if (!$erros) {
        $ocupacao = $conn->prepare("SELECT id FROM agendamentos WHERE data_consulta = ? AND hora_consulta = ? AND status IN ('pendente', 'confirmado') LIMIT 1");
        $ocupacao->bind_param('ss', $valores['data_consulta'], $valores['hora_consulta']);
        $ocupacao->execute();
        $ocupacao->store_result();

        if ($ocupacao->num_rows > 0) {
            $erros[] = 'Esse horário já foi solicitado. Escolha outro, por favor.';
        }
        $ocupacao->close();
    }

    if (!$erros) {
        $stmt = $conn->prepare('INSERT INTO agendamentos (nome, nascimento, email, telefone, data_consulta, hora_consulta, observacoes) VALUES (?, ?, ?, ?, ?, ?, ?)');
        $stmt->bind_param('sssssss', $valores['nome'], $valores['nascimento'], $valores['email'], $valores['telefone'], $valores['data_consulta'], $valores['hora_consulta'], $valores['observacoes']);

        if ($stmt->execute()) {
            $mensagem = 'Solicitação recebida! A clínica entrará em contato para confirmar o horário.';
            $tipoMensagem = 'sucesso';
            $valores = array_fill_keys(array_keys($valores), '');
        } else {
            $mensagem = 'Não foi possível salvar a solicitação. Tente novamente.';
            $tipoMensagem = 'erro';
        }
        $stmt->close();
    } else {
        $mensagem = implode(' ', $erros);
        $tipoMensagem = 'erro';
    }
}

function e(string $valor): string
{
    return htmlspecialchars($valor, ENT_QUOTES, 'UTF-8');
}

$minData = date('Y-m-d');
?>
<!doctype html>
<html lang="pt-BR">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Agendar consulta — Clínica Odontológica</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <header class="site-header">
    <nav class="nav">
      <a class="logo" href="index.html"><img src="img/logo.png" alt="Clínica Odontológica" class="logo-img"><span class="brand">Clínica Odontológica</span></a>
      <ul class="nav-links">
        <li><a href="index.html">Início</a></li><li><a href="servicos.html">Serviços</a></li><li><a href="agendar.php" class="active">Agendar</a></li><li><a href="sobre.html">Sobre</a></li>
      </ul>
    </nav>
  </header>
  <main class="container">
    <h1>Agendar Consulta</h1>
    <p>Preencha seus dados e escolha uma preferência de data e horário. O agendamento será confirmado pela equipe.</p>
    <?php if ($mensagem !== ''): ?><div class="alert <?= e($tipoMensagem) ?>" role="alert"><?= e($mensagem) ?></div><?php endif; ?>
    <form action="agendar.php" method="POST" class="form-agendar">
      <label for="nome">Nome completo:</label><input id="nome" type="text" name="nome" value="<?= e($valores['nome']) ?>" minlength="3" maxlength="120" required>
      <label for="nascimento">Data de nascimento:</label><input id="nascimento" type="date" name="nascimento" value="<?= e($valores['nascimento']) ?>" required>
      <label for="email">E-mail:</label><input id="email" type="email" name="email" value="<?= e($valores['email']) ?>" maxlength="160" required>
      <label for="telefone">Celular/Telefone:</label><input id="telefone" type="tel" name="telefone" value="<?= e($valores['telefone']) ?>" maxlength="20" required>
      <label for="data_consulta">Data preferida:</label><input id="data_consulta" type="date" name="data_consulta" value="<?= e($valores['data_consulta']) ?>" min="<?= e($minData) ?>" required>
      <label for="hora_consulta">Horário preferido:</label><select id="hora_consulta" name="hora_consulta" required><option value="">Selecione um horário</option><?php foreach (['08:00','09:00','10:00','11:00','13:00','14:00','15:00','16:00','17:00'] as $hora): ?><option value="<?= $hora ?>" <?= $valores['hora_consulta'] === $hora ? 'selected' : '' ?>><?= $hora ?></option><?php endforeach; ?></select>
      <label for="observacoes">Observações (opcional):</label><textarea id="observacoes" name="observacoes" maxlength="500" rows="4"><?= e($valores['observacoes']) ?></textarea>
      <button type="submit" class="btn-primary">Solicitar agendamento</button>
    </form>
  </main>
  <footer class="site-footer"><p>© <span id="year"></span> Clínica Odontológica — Todos os direitos reservados</p></footer>
  <script>document.getElementById('year').textContent = new Date().getFullYear();</script>
</body>
</html>

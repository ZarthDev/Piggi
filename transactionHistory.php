<?php
  session_start();
  if (!isset($_SESSION['logado'])) {
    header("Location: index.php");
    exit();
  }

  try {
    $conn = new PDO("mysql:host=localhost;dbname=Piggi;charset=utf8", "root", "");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $conn->prepare("
      SELECT t.valor, t.destinatario, 
             COALESCE(cd.nome_cartao, cc.nome_cartao) AS nome_cartao
      FROM tb_transacoes t
      LEFT JOIN cartoes_debito cd ON t.id_cartao = cd.id
      LEFT JOIN cartoes_credito cc ON t.id_cartao = cc.id
      WHERE t.id_user = :id_user
      ORDER BY t.id_transacao DESC
    ");
    $stmt->bindParam(':id_user', $_SESSION['usuario_id']);
    $stmt->execute();
    $transacoes = $stmt->fetchAll(PDO::FETCH_ASSOC);

  } catch (PDOException $e) {
    echo "Erro: " . $e->getMessage();
    exit();
  }
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Histórico de Transações - Piggi</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #fdf2f8;
      font-family: 'Segoe UI', sans-serif;
    }
    .container {
      margin-top: 50px;
    }
    .table-container {
      background: white;
      padding: 30px;
      border-radius: 15px;
      box-shadow: 0 0 20px rgba(255, 192, 203, 0.4);
    }
    h2 {
      color: #d63384;
      font-weight: bold;
    }
    .table th {
      background-color: #f8d7da;
      color: #721c24;
    }
    .btn-voltar {
      background-color: #d63384;
      color: white;
    }
    .btn-voltar:hover {
      background-color: #bd296f;
    }
  </style>
</head>
<body>

<div class="container">
  <div class="table-container">
    <h2 class="mb-4">Histórico de Transações</h2>
    
    <?php if (count($transacoes) > 0): ?>
      <div class="table-responsive">
        <table class="table table-striped align-middle">
          <thead>
            <tr>
              <th>Valor (R$)</th>
              <th>Destinatário</th>
              <th>Cartão Usado</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($transacoes as $t): ?>
              <tr>
                <td>R$ <?= number_format($t['valor'], 2, ',', '.') ?></td>
                <td><?= htmlspecialchars($t['destinatario']) ?></td>
                <td><?= htmlspecialchars($t['nome_cartao'] ?? 'Desconhecido') ?></td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    <?php else: ?>
      <p>Você ainda não possui transações registradas.</p>
    <?php endif; ?>

    <a href="home.php" class="btn btn-voltar mt-3">← Voltar para o início</a>
    <a href="deleteHistory.php" class="btn btn-voltar mt-3">← Limpar Histórico</a>
  </div>
</div>

</body>
</html>

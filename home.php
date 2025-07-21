<?php
  session_start();
  if (!isset($_SESSION['logado'])) {
    header("Location: index.php");
    exit();
  }
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Piggi - Home</title>

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Bootstrap Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
  <!-- Custom CSS -->
  <style>
    body {
      background-color: #fff0f5;
      font-family: 'Segoe UI', sans-serif;
    }
    .bg-pink {
      background-color: #e83e8c !important;
    }
    .text-pink {
      color: #e83e8c !important;
    }
    .card-credit, .card-debit {
      border-radius: 20px;
      color: white;
      padding: 20px;
      border: solid 2px #000;
    }
    .section-title {
      font-weight: 600;
      color: #e83e8c;
      margin-top: 40px;
    }
    .card-objective {
      border-left: 5px solid #e83e8c;
      padding-left: 15px;
      margin-bottom: 10px;
    }
  </style>
</head>
<body>
  <nav class="navbar navbar-expand-lg bg-pink navbar-dark">
    <div class="container">
      <a class="navbar-brand fw-bold" href="#">
        <i class="bi bi-piggy-bank-fill me-2"></i>Piggi
      </a>
      <div class="d-flex">
        <span class="navbar-text text-white me-3">
          Olá, <strong><?php echo $_SESSION['usuario_nome']; ?></strong>
        </span>
        <a href="logout.php" class="btn btn-outline-light btn-sm">Sair</a>
      </div>
    </div>
  </nav>

  <div class="container py-4">
    <h3 class="section-title">Meus Cartões</h3>
    <div class="row g-4">
      <?php 
        $servidor = "localhost";
        $usuario = "root";
        $senha = "";
        $banco = "Piggi";

        try {
          $conn = new PDO("mysql:host=$servidor;dbname=$banco;charset=utf8", $usuario, $senha);
          $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

          $queryDebito = "SELECT * FROM cartoes_debito WHERE id_user = :id_user";
          $queryCredito = "SELECT * FROM cartoes_credito WHERE id_user = :id_user";
          $stmtDebito = $conn->prepare($queryDebito);
          $stmtCredito = $conn->prepare($queryCredito);

          $stmtDebito->bindParam(':id_user', $_SESSION['usuario_id']);
          $stmtCredito->bindParam(':id_user', $_SESSION['usuario_id']);
          $stmtDebito->execute();
          $stmtCredito->execute();

          $_SESSION['cartoes'] = [
            'debito' => $stmtDebito->fetchAll(PDO::FETCH_ASSOC),
            'credito' => $stmtCredito->fetchAll(PDO::FETCH_ASSOC)
          ];
        } catch (PDOException $e) {
          echo "Erro: " . $e->getMessage();
        }

        foreach ($_SESSION['cartoes']['credito'] as $cartaoCredito): ?>
          <div class="col-md-6">
            <div class="card card-credit" style="background: linear-gradient(135deg, <?php echo htmlspecialchars($cartaoCredito['cor_cartao']); ?>, #f78db4);">
              <h5 class="mb-1"><?php echo htmlspecialchars($cartaoCredito['nome_cartao']); ?></h5>
              <small>Fechamento: <?php echo htmlspecialchars($cartaoCredito['data_fechamento']); ?> / Vencimento: <?php echo htmlspecialchars($cartaoCredito['data_vencimento']); ?></small>
              <p class="mt-2">Limite disponível: <strong>R$ <?php echo number_format($cartaoCredito['limite_disponivel'], 2, ',', '.'); ?></strong></p>
              <form method="POST" action="cardDetails.php">
                <input type="hidden" name="id_cartao" value="<?php echo htmlspecialchars($cartaoCredito['id']); ?>@credito">
                <button class="btn btn-outline-light">Ver Detalhes</button>
              </form>
            </div>
          </div>
        <?php endforeach; ?>

        <?php foreach ($_SESSION['cartoes']['debito'] as $cartaoDebito): ?>
          <div class="col-md-6">
            <div class="card card-debit" style="background: linear-gradient(135deg, <?php echo htmlspecialchars($cartaoDebito['cor_cartao']); ?>, #f78db4);">
              <h5 class="mb-1"><?php echo htmlspecialchars($cartaoDebito['nome_cartao']); ?></h5>
              <p class="mt-2">Saldo disponível: <strong>R$ <?php echo number_format($cartaoDebito['saldo_disponivel'], 2, ',', '.'); ?></strong></p>
              <form method="POST" action="cardDetails.php">
                <input type="hidden" name="id_cartao" value="<?php echo htmlspecialchars($cartaoDebito['id']); ?>@debito">
                <button href="#" class="btn btn-outline-light">Ver Detalhes</button>
              </form>
            </div>
          </div>
        <?php endforeach; ?>
        <span><a class='btn btn-outline-danger' href="newCard.php">Cadastrar Cartão</a></span>
    </div>

    <!-- Contas -->
    <h3 class="section-title">Minhas Contas</h3>
    <div class="card mb-3">
      <?php
        if (isset($_SESSION['cartoes']['debito']) && count($_SESSION['cartoes']['debito']) > 0) {
          foreach ($_SESSION['cartoes']['debito'] as $cartaoDebito): ?>
            <div class="card-body">
              <h5><?php echo htmlspecialchars($cartaoDebito['nome_cartao']); ?></h5>
              <p>Saldo: <strong class="text-success">R$ <?php echo number_format($cartaoDebito['saldo_disponivel'], 2, ',', '.'); ?></strong></p>
              <a href="#" class="btn btn-sm btn-outline-pink">+ Nova Transação</a>
            </div>
            <hr>
          <?php endforeach;
        } else { ?>
          <div class="card-body">
            <p>Nenhuma conta cadastrada.</p>
          </div>
      <?php } ?>
    </div>

    <!-- Metas -->
    <h3 class="section-title">Metas Financeiras</h3>
    <div class="row">
      <div class="col-md-4">
        <div class="card card-objective">
          <div class="card-body">
            <h6>Saúde</h6>
            <p>R$ 500 / R$ 1.000</p>
            <div class="progress">
              <div class="progress-bar bg-pink" style="width: 50%"></div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card card-objective">
          <div class="card-body">
            <h6>Social</h6>
            <p>R$ 300 / R$ 600</p>
            <div class="progress">
              <div class="progress-bar bg-pink" style="width: 50%"></div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card card-objective">
          <div class="card-body">
            <h6>Investimento</h6>
            <p>R$ 1.000 / R$ 2.000</p>
            <div class="progress">
              <div class="progress-bar bg-pink" style="width: 50%"></div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

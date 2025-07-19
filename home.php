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

    <!-- Cartões -->
    <h3 class="section-title">Meus Cartões</h3>
    <div class="row g-4">
      <?php foreach ($_SESSION['cartoes']['credito'] as $cartaoCredito): ?>
        <div class="col-md-6">
          <div class="card card-credit" style="background: linear-gradient(135deg, <?php echo htmlspecialchars($cartaoCredito['cor_cartao']); ?>, #f78db4);">
            <h5 class="mb-1"><?php echo htmlspecialchars($cartaoCredito['nome_cartao']); ?></h5>
            <small>Fechamento: <?php echo htmlspecialchars($cartaoCredito['data_fechamento']); ?> / Vencimento: <?php echo htmlspecialchars($cartaoCredito['data_vencimento']); ?></small>
            <p class="mt-2">Limite disponível: <strong>R$ <?php echo number_format($cartaoCredito['limite_disponivel'], 2, ',', '.'); ?></strong></p>
            <button type="button" class="btn btn-outline-light ver-detalhes" data-bs-toggle="modal" data-bs-target="#detalhesModal" id="detalhes-credito-<?php echo $cartaoCredito['id']; ?>">
                Ver Detalhes
            </button>
          </div>
        </div>
      <?php endforeach; ?>
        <?php foreach ($_SESSION['cartoes']['debito'] as $cartaoDebito): ?>
            <div class="col-md-6">
            <div class="card card-debit" style="background: linear-gradient(135deg, <?php echo htmlspecialchars($cartaoDebito['cor_cartao']); ?>, #f78db4);">
                <h5 class="mb-1"><?php echo htmlspecialchars($cartaoDebito['nome_cartao']); ?></h5>
                <p class="mt-2">Saldo disponível: <strong>R$ <?php echo number_format($cartaoDebito['saldo_disponivel'], 2, ',', '.'); ?></strong></p>
                <button type="button" class="btn btn-outline-light ver-detalhes" data-bs-toggle="modal" data-bs-target="#detalhesModal" id="detalhes-debito-<?php echo $cartaoDebito['id']; ?>">
                    Ver Detalhes
                </button>
            </div>
            </div>
      <?php endforeach; ?>
      <span><a class='btn btn-outline-danger' href="newCard.php">Cadastrar Cartão</a></span>
    </div>

    <!-- Contas -->
    <h3 class="section-title">Minhas Contas</h3>
    <div class="card mb-3">
      <div class="card-body">
        <h5>Conta Banco do Brasil</h5>
        <p>Saldo: <strong class="text-success">R$ 4.780,00</strong></p>
        <a href="#" class="btn btn-sm btn-outline-pink">+ Nova Transação</a>
      </div>
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

  <script>
    document.querySelectorAll('.ver-detalhes').forEach(btn => {
      btn.addEventListener('click', function () {
        const idCompleto = this.id; // exemplo: detalhes-credito-3
        const partes = idCompleto.split('-'); // ['detalhes', 'credito', '3']
        const tipo = partes[1]; // credito ou debito
        const idCartao = partes[2];

        console.log('Tipo:', tipo);
        console.log('ID do Cartão:', idCartao);

        // Exemplo: preencher dinamicamente o modal
        const tituloModal = document.getElementById('modalTitulo');
        tituloModal.textContent = `Cartão ${tipo.toUpperCase()} #${idCartao}`;

        const corpoModal = document.getElementById('modalBody');
        corpoModal.innerHTML = `Exibir informações do cartão <strong>${tipo}</strong> com ID <strong>${idCartao}</strong>.`;

      });
    });
  </script>


  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<div class="modal fade" id="detalhesModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="modalTitulo">Detalhes</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" id="modalBody">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Fechar</button>
        <button type="button" class="btn btn-danger">Salvar</button>
      </div>
    </div>
  </div>
</div>

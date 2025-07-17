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
      background: linear-gradient(135deg, #e83e8c, #f78db4);
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
          Olá, <strong>Usuário</strong>
        </span>
        <a href="#" class="btn btn-outline-light btn-sm">Sair</a>
      </div>
    </div>
  </nav>

  <div class="container py-4">

    <!-- Cartões -->
    <h3 class="section-title">Meus Cartões</h3>
    <div class="row g-4">
      <div class="col-md-6">
        <div class="card card-credit">
          <h5 class="mb-1">Cartão Crédito Nubank</h5>
          <small>Fechamento: 10 / Vencimento: 20</small>
          <p class="mt-2">Limite disponível: <strong>R$ 1.200,00</strong></p>
        </div>
      </div>
      <div class="col-md-6">
        <div class="card card-debit">
          <h5 class="mb-1">Cartão Débito Inter</h5>
          <small>Saldo disponível:</small>
          <p class="mt-2"><strong>R$ 2.450,00</strong></p>
        </div>
      </div>
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

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

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
  <title>Piggi - Nova Meta</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  
  <style>
    body {
      background-color: #ffeaf4;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .container-form {
      max-width: 600px;
      margin: 50px auto;
      background-color: #fff0f6;
      padding: 30px;
      border-radius: 15px;
      box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    }

    h2 {
      text-align: center;
      color: #d63384;
      margin-bottom: 25px;
    }

    .btn-rosa {
      background-color: #ff69b4;
      color: white;
      border: none;
    }

    .btn-rosa:hover {
      background-color: #e255a1;
    }

    label {
      font-weight: bold;
      color: #d63384;
    }
  </style>
</head>
<body>
  <div class="container-form">
    <h2>Adicionar Nova Meta</h2>
    <form action="cadastrarMeta.php" method="post">
      <div class="mb-3">
        <label for="nome_meta" class="form-label">Nome da Meta</label>
        <input type="text" class="form-control" id="nome_meta" name="nome_meta" required>
      </div>

      <div class="mb-3">
        <label for="valor_desejado" class="form-label">Valor Desejado (R$)</label>
        <input type="number" step="0.01" min="0" class="form-control" id="valor_desejado" name="valor_desejado" required>
      </div>

      <div class="mb-3">
        <label for="valor_atual" class="form-label">Quanto Você Já Tem (R$)</label>
        <input type="number" step="0.01" min="0" class="form-control" id="valor_atual" name="valor_atual" required>
      </div>

      <div class="d-grid gap-2">
        <button type="submit" class="btn btn-rosa">Salvar Meta</button>
        <a href="home.php" class="btn btn-rosa">Voltar</a>
      </div>
    </form>
  </div>
</body>
</html>

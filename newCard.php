<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Adicionar Cartão - Piggi</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
  <style>
    body {
      background-color: #ffe6f0;
    }

    .card-form {
      background-color: white;
      padding: 30px;
      border-radius: 15px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .preview-card {
      width: 100%;
      height: 180px;
      border-radius: 15px;
      padding: 20px;
      color: white;
      margin-bottom: 20px;
    }

    .form-check-input:checked {
      background-color: #ff66b2;
      border-color: #ff66b2;
    }

    .btn-piggi {
      background-color: #ff66b2;
      color: white;
    }

    .btn-piggi:hover {
      background-color: #e0559c;
    }
  </style>
</head>

<body>
  <div class="container mt-5">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card-form">
          <h2 class="text-center mb-4">Adicionar Cartão</h2>

          <div id="card-preview" class="preview-card" style="background-color: #ff66b2">
            <h5 id="preview-nome">Nome do Cartão</h5>
            <p id="preview-banco">Banco</p>
            <p id="preview-tipo">Tipo de Cartão</p>
          </div>

          <form method="POST" action="processNewCard.php">
            <div class="mb-3">
              <label for="nome" class="form-label">Nome do Cartão</label>
              <input type="text" class="form-control" id="nome" name="nome">
            </div>

            <div class="mb-3">
              <label for="banco" class="form-label">Banco</label>
              <input type="text" class="form-control" id="banco" name="banco">
            </div>

            <div class="mb-3">
              <label class="form-label">Tipo de Cartão</label><br>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="tipo" id="credito" value="credito">
                <label class="form-check-label" for="credito">Crédito</label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="tipo" id="debito" value="debito">
                <label class="form-check-label" for="debito">Débito</label>
              </div>
            </div>

            <div class="mb-3">
              <label for="cor" class="form-label">Cor do Cartão</label>
              <input type="color" class="form-control form-control-color" id="cor" name="cor" value="#ff66b2">
            </div>

            <div id="credito-fields" style="display: none;">
              <div class="mb-3">
                <label for="limite" class="form-label">Limite Total</label>
                <input type="number" class="form-control" id="limite" name="limite">
              </div>

              <div class="mb-3">
                <label for="disponivel" class="form-label">Limite Disponível</label>
                <input type="number" class="form-control" id="disponivel" name="disponivel">
              </div>

              <div class="mb-3">
                <label for="fechamento" class="form-label">Dia de Fechamento</label>
                <input type="date" class="form-control" id="fechamento" name="fechamento" min="1" max="31">
              </div>

              <div class="mb-3">
                <label for="vencimento" class="form-label">Dia de Vencimento</label>
                <input type="date" class="form-control" id="vencimento" name="vencimento" min="1" max="31">
              </div>
            </div>

            <div id="debito-fields" style="display: none;">
              <div class="mb-3">
                <label for="saldo" class="form-label">Saldo Disponível</label>
                <input type="number" step="0.01" min="0" class="form-control" id="saldo" name="saldo">
              </div>
            </div>

            <div class="text-center">
              <button type="submit" class="btn btn-piggi">Cadastrar Cartão</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <script>
    const tipoInputs = document.querySelectorAll('input[name="tipo"]');
    const creditoFields = document.getElementById('credito-fields');
    const debitoFields = document.getElementById('debito-fields');
    const nomeInput = document.getElementById('nome');
    const bancoInput = document.getElementById('banco');
    const corInput = document.getElementById('cor');

    tipoInputs.forEach(input => {
      input.addEventListener('change', () => {
        if (input.value === 'credito') {
          creditoFields.style.display = 'block';
          debitoFields.style.display = 'none';
          document.getElementById('preview-tipo').innerText = 'Cartão de Crédito';
        } else {
          creditoFields.style.display = 'none';
          debitoFields.style.display = 'block';
          document.getElementById('preview-tipo').innerText = 'Cartão de Débito';
        }
      });
    });

    nomeInput.addEventListener('input', () => {
      document.getElementById('preview-nome').innerText = nomeInput.value || 'Nome do Cartão';
    });

    bancoInput.addEventListener('input', () => {
      document.getElementById('preview-banco').innerText = bancoInput.value || 'Banco';
    });

    corInput.addEventListener('input', () => {
      document.getElementById('card-preview').style.backgroundColor = corInput.value;
    });
  </script>
</body>

</html>
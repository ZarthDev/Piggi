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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro - Piggi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            background: #ffeaf2;
        }

        .card {
            border: none;
            border-radius: 1rem;
            box-shadow: 0 0 30px rgba(0, 0, 0, 0.1);
        }

        .btn-piggi {
            background-color: #ff69b4;
            color: white;
        }

        .btn-piggi:hover {
            background-color: #ff85c1;
            color: white;
        }

        .form-control:focus {
            box-shadow: none;
            border-color: #ff69b4;
        }
    </style>
</head>

<body>
    <div class="container d-flex justify-content-center align-items-center vh-100">
        <div class="card p-5" style="max-width: 500px; width: 100%;">
            <div class="text-center mb-4">
                <img src="images/icone-do-cofrinho-com-traco-rosa-by_vexels.png" alt="Logo Piggi" width="150">
                <h3 class="mt-2">Nova Transação</h3>
            </div>
            <form action="processNewTransaction.php" method="POST">
                <div class="mb-3">
                    <label for="valor" class="form-label"><strong>Valor</strong></label>
                    <input type="number" class="form-control" id="valor" name="valor" placeholder="R$200" required>
                </div>
                <div class="mb-3">
                    <label for="destino" class="form-label"><strong>Destino</strong></label>
                    <input type="text" class="form-control" id="destino" name="destino" placeholder="Nome do Destinatário" required>
                </div>
                <div class="d-grid">
                    <input type="hidden" name="id_cartao" value="<?php echo htmlspecialchars($_POST['id_cartao']); ?>">
                    <button type="submit" class="btn btn-piggi">Confirmar Transação</button>
                    <a href="home.php" class="btn btn-danger mt-2">Cancelar</a>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
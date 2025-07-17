<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Piggi - Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/styles.css">
</head>
<body class="bg-light">

    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="card p-4 shadow-lg border-0" style="max-width: 400px; width: 100%;">
            <div class="text-center mb-4">
                <img src="images/icone-do-cofrinho-com-traco-rosa-by_vexels.png" alt="Logo Piggi" width="150">
                <h2 class="mt-2" style="color: #e83e8c;">Piggi</h2>
                <p class="text-muted">Controle suas finanças com fofura 🐷</p>
            </div>
            <form action="login.php" method="POST">
                <div class="mb-3">
                    <label for="email" class="form-label">E-mail</label>
                    <div class="input-group">
                        <span class="input-group-text bg-pink"><i class="bi bi-envelope-fill text-white"></i></span>
                        <input type="email" class="form-control" id="email" name="email" required placeholder="seu@email.com">
                    </div>
                </div>

                <div class="mb-3">
                    <label for="senha" class="form-label">Senha</label>
                    <div class="input-group">
                        <span class="input-group-text bg-pink"><i class="bi bi-lock-fill text-white"></i></span>
                        <input type="password" class="form-control" id="senha" name="senha" required placeholder="Digite sua senha">
                    </div>
                </div>

                <div class="d-grid">
                    <button type="submit" class="btn btn-pink">Entrar</button>
                </div>
            </form>
            <div class="text-center mt-3">
                <small>Não tem conta? <a href="#" class="text-pink">Cadastre-se</a></small>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

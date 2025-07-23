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

    <style>
        /* Splash screen */
        #splash {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: #fff;
            z-index: 9999;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            transition: opacity 0.5s ease;
        }

        #splash img {
            width: 150px;
        }

        #splash h1 {
            margin-top: 20px;
            font-size: 2rem;
            color: #e83e8c;
        }

        #splash.fade-out {
            opacity: 0;
            pointer-events: none;
        }
    </style>
</head>
<body class="bg-light">

    <!-- Splash Screen -->
    <div id="splash">
        <img src="images/icone-do-cofrinho-com-traco-rosa-by_vexels.png" alt="Logo Piggi">
        <h1>Piggi</h1>
        <div class="spinner-border text-secondary" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
    </div>

    <!-- Conteúdo principal -->
    <div id="main-content" style="display: none;">
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
                    <small>Não tem conta? <a href="cadastrar.php" class="text-pink">Cadastre-se</a></small>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Splash JS -->
    <script>
        window.addEventListener('load', function () {
            const splash = document.getElementById('splash');
            const mainContent = document.getElementById('main-content');

            setTimeout(() => {
                splash.classList.add('fade-out');
                mainContent.style.display = 'block';
            }, 2500); // tempo de splash (2.5 segundos)
        });
    </script>
</body>
</html>

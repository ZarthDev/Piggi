<?php
    session_start();
    if (!isset($_SESSION['logado'])) {
        header("Location: index.php");
        exit();
    }

    $servidor = "localhost";
    $usuario = "root";
    $senha = "";
    $banco = "Piggi";

    try {
        $conn = new PDO("mysql:host=$servidor;dbname=$banco;charset=utf8", $usuario, $senha);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $conn->prepare("DELETE FROM tb_transacoes WHERE id_user = :id_user");
        $stmt->bindParam(':id_user', $_SESSION['usuario_id']);
        $stmt->execute();

        header("Location: transactionHistory.php");
        exit();
    } catch (PDOException $e) {
        echo "Erro: " . $e->getMessage();
    }
?>
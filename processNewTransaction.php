<?php
    session_start();
    if (!isset($_SESSION['logado'])) {
        header("Location: index.php");
        exit();
    }

    $servidor = "localhost";
    $usuario = "root";
    $senha = "";
    $banco = "piggi";

    try {
        $conn = new PDO("mysql:host=$servidor;dbname=$banco;charset=utf8", $usuario, $senha);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $query = "insert into tb_transacoes (id_user, valor, destinatario, id_cartao) values (:id_user, :valor, :destinatario, :id_cartao)";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':id_user', $_SESSION['usuario_id']);
        $stmt->bindParam(':valor', $_POST['valor']);
        $stmt->bindParam(':destinatario', $_POST['destino']);
        $stmt->bindParam(':id_cartao', $_POST['id_cartao']);
        $stmt->execute();
        
        $queryUpdate = "UPDATE cartoes_debito SET saldo_disponivel = saldo_disponivel - :valor WHERE id = :id_cartao AND id_user = :id_user";
        $stmtUpdate = $conn->prepare($queryUpdate);
        $stmtUpdate->bindParam(':valor', $_POST['valor']);
        $stmtUpdate->bindParam(':id_cartao', $_POST['id_cartao']);
        $stmtUpdate->bindParam(':id_user', $_SESSION['usuario_id']);
        $stmtUpdate->execute();
        
        header("Location: home.php");
        exit();
    } catch (PDOException $e) {
        echo "Erro de conexão: " . $e->getMessage();
        exit();
    }
?>
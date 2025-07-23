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
        
        $queryVerifyMetas = "SELECT * FROM tb_metas WHERE id_user = :id_user";
        $stmtVerify = $conn->prepare($queryVerifyMetas);
        $stmtVerify->bindParam(':id_user', $_SESSION['usuario_id']);
        $stmtVerify->execute();
        $metas = $stmtVerify->fetchAll(PDO::FETCH_ASSOC);

        foreach ($metas as $meta) {
            if ($_POST['destino'] == $meta['nome_meta']) {
                $queryUpdateMeta = "UPDATE tb_metas SET valor_atual = valor_atual + :valor WHERE id_meta = :id_meta AND id_user = :id_user";
                $stmtUpdateMeta = $conn->prepare($queryUpdateMeta);
                $stmtUpdateMeta->bindParam(':valor', $_POST['valor']);
                $stmtUpdateMeta->bindParam(':id_meta', $meta['id_meta']);
                $stmtUpdateMeta->bindParam(':id_user', $_SESSION['usuario_id']);
                $stmtUpdateMeta->execute();
            }
        }

        header("Location: home.php");
        exit();
    } catch (PDOException $e) {
        echo "Erro de conexão: " . $e->getMessage();
        exit();
    }
?>
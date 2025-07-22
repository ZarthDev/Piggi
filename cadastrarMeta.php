<?php
session_start();
if (!isset($_SESSION['logado'])) {
    header("Location: index.php");
    exit();
}

$nome_meta = trim($_POST['nome_meta']);
$valor_desejado = str_replace(',', '.', $_POST['valor_desejado']);
$valor_atual = str_replace(',', '.', $_POST['valor_atual']);

$valor_desejado = floatval($valor_desejado);
$valor_atual = floatval($valor_atual);

try {
    $conn = new PDO("mysql:host=localhost;dbname=Piggi;charset=utf8", "root", "");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $conn->prepare("INSERT INTO tb_metas (id_user, nome_meta, valor_desejado, valor_atual) VALUES (:id_user, :nome_meta, :valor_desejado, :valor_atual)");
    $stmt->bindParam(':id_user', $_SESSION['usuario_id'], PDO::PARAM_INT);
    $stmt->bindParam(':nome_meta', $nome_meta);
    $stmt->bindParam(':valor_desejado', $valor_desejado);
    $stmt->bindParam(':valor_atual', $valor_atual);
    $stmt->execute();

    header("Location: home.php");
    exit();
} catch (PDOException $e) {
    echo "Erro: " . $e->getMessage();
}
?>

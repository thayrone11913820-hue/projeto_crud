
<?php
try {
    $pdo = new PDO(
        "pgsql:host=localhost;port=5432;dbname=projeto_crud",
        "postgres",
        "123456"
    );

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "SELECT * FROM tarefas ORDER BY id DESC";
    $stmt = $pdo->query($sql);
    $tarefas = $stmt->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    die("Erro ao conectar: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Lista de Tarefas</title>
</head>
<body>

    <h1>Mensagens cadastradas</h1>

    <?php foreach ($tarefas as $tarefa): ?>
        <p>
            <strong>Nome:</strong>
            <?= htmlspecialchars($tarefa['nome']) ?>
        </p>

        <p>
            <strong>Mensagem:</strong>
            <?= htmlspecialchars($tarefa['mensagem']) ?>
        </p>

        <hr>
    <?php endforeach; ?>

    <a href="contato.php">Voltar ao formulário</a>

</body>
</html>

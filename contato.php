
<?php
$status = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nome = trim($_POST["nome"]);
    $mensagem = trim($_POST["mensagem"]);

    try {
        $pdo = new PDO(
            "pgsql:host=localhost;port=5432;dbname=projeto_crud",
            "postgres",
            "123456"
        );

        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "INSERT INTO tarefas (nome, mensagem) VALUES (:nome, :mensagem)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ":nome" => $nome,
            ":mensagem" => $mensagem
        ]);

        $status = "Mensagem cadastrada com sucesso!";
    } catch (PDOException $e) {
        $status = "Erro ao salvar a mensagem.";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Connect+ | Contato</title>

<style>
* {
    box-sizing: border-box;
}

body {
    margin: 0;
    font-family: Arial, sans-serif;
    background: linear-gradient(135deg, #050914, #101d35);
    color: white;
    min-height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
}

.container {
    background: #111c30;
    width: 90%;
    max-width: 500px;
    padding: 35px;
    border-radius: 18px;
    border: 1px solid #263b5c;
    box-shadow: 0 10px 35px #0008;
}

h1 {
    color: #3998ff;
    text-align: center;
    margin-bottom: 10px;
}

.descricao {
    text-align: center;
    color: #aabbd2;
    margin-bottom: 30px;
}

label {
    display: block;
    margin-bottom: 8px;
    color: #dceaff;
}

input, textarea {
    width: 100%;
    padding: 13px;
    margin-bottom: 20px;
    background: #091426;
    border: 1px solid #304866;
    border-radius: 9px;
    color: white;
    font-size: 15px;
    outline: none;
}

input:focus, textarea:focus {
    border-color: #3998ff;
}

textarea {
    resize: vertical;
}

button {
    width: 100%;
    padding: 14px;
    background: #1677e8;
    border: none;
    border-radius: 9px;
    color: white;
    font-size: 16px;
    font-weight: bold;
    cursor: pointer;
    transition: 0.3s;
}

button:hover {
    background: #3998ff;
    transform: translateY(-2px);
}

.status {
    background: #123c31;
    color: #7fffc5;
    padding: 12px;
    border-radius: 8px;
    text-align: center;
    margin-bottom: 20px;
}

a {
    display: block;
    text-align: center;
    margin-top: 22px;
    color: #3998ff;
    text-decoration: none;
}

a:hover {
    text-decoration: underline;
}
</style>
</head>

<body>

<div class="container">

    <h1>Connect+</h1>
    <p class="descricao">Envie sua mensagem para nós</p>

    <?php if ($status !== ""): ?>
        <div class="status">
            <?= htmlspecialchars($status) ?>
        </div>
    <?php endif; ?>

    <form method="POST" action="contato.php">

        <label for="nome">Seu nome</label>
        <input type="text" id="nome" name="nome" required>

        <label for="mensagem">Sua mensagem</label>
        <textarea id="mensagem" name="mensagem" rows="5" required></textarea>

        <button type="submit">Enviar mensagem</button>

    </form>

    <a href="listar.php">Ver mensagens cadastradas</a>

</div>

</body>
</html>

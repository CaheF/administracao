<?php
// Caminho do arquivo onde os dados serão salvos
$arquivo = 'usuarios.csv';
$usuarios = []; // Array para armazenar usuários

// Verificar se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT); // Criptografa a senha
    $imagem = $_FILES['imagem']['name'];
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($imagem);

    // Move a imagem para o diretório de uploads
    if (move_uploaded_file($_FILES['imagem']['tmp_name'], $target_file)) {
        // Abrir o arquivo em modo de adição
        $handle = fopen($arquivo, 'a');

        // Gravar os dados no arquivo
        fputcsv($handle, [$nome, $email, $senha, $target_file]);

        // Fechar o arquivo
        fclose($handle);

        echo "Usuário cadastrado com sucesso!";
    } else {
        echo "Erro ao fazer upload da imagem.";
    }
}

// Ler usuários do arquivo
if (file_exists($arquivo)) {
    $handle = fopen($arquivo, 'r');
    while (($data = fgetcsv($handle)) !== FALSE) {
        $usuarios[] = $data;
    }
    fclose($handle);
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Usuários</title>
</head>
<body>
    <h1>Cadastro de Usuários</h1>
    <form method="POST" action="" enctype="multipart/form-data">
        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome" required><br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br>

        <label for="senha">Senha:</label>
        <input type="password" id="senha" name="senha" required><br>

        <label for="imagem">Imagem:</label>
        <input type="file" id="imagem" name="imagem" accept="image/*" required><br>

        <button type="submit">Cadastrar</button>
    </form>

    <h2>Usuários Cadastrados</h2>
    <ul>
        <?php foreach ($usuarios as $usuario): ?>
            <li>
                <strong>Nome:</strong> <?php echo htmlspecialchars($usuario[0]); ?><br>
                <strong>Email:</strong> <?php echo htmlspecialchars($usuario[1]); ?><br>
                <strong>Imagem:</strong><br>
                <img src="<?php echo htmlspecialchars($usuario[3]); ?>" alt="Imagem do usuário" style="max-width: 100px;"><br>
            </li>
        <?php endforeach; ?>
    </ul>
</body>
</html>

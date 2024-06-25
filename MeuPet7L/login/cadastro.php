<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="login.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
</head>
<body>
<header>
    <div class="header-content">
        <h1 class="logo"><a  href="http://localhost/MeuPet7L/MeuPet7L/">Meu Pet 7L</a></h1>
    </div>
</header>

<!-- Formulário de Cadastro -->
<form class="formC" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
    <h5>Cadastro</h5>
    <div class="input-row">
        <label for="usuario">Nome completo</label>
        <input class="caixa" type="text" name="usuario" id="usuario">
    </div>
    <div class="input-row">
        <label for="email_cadastro">E-mail</label>
        <input class="caixa" type="text" name="email" id="email_cadastro">
    </div>
    <div class="input-row">
        <label for="senha_cadastro">Senha</label>
        <input class="caixa" type="password" name="senha" id="senha_cadastro"> 
    </div>
    <a href="login.php" class="suporte" id="irLogin"><p>Já possuo uma conta!</p></a>

<!--///////////////////////////////////////////////////////////////////////////-->

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['cadastrar'])) {
    $usuario = $_POST['usuario'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    if(!empty($usuario) && !empty($email) && !empty($senha)) {
        // Se todos os campos estiverem preenchidos
        $host = 'localhost';
        $user = 'root';
        $password = ''; 
        $database = 'meupet7l';

        // Cria conexão
        $conn = new mysqli($host, $user, $password, $database);

        // Checa a conexão
        if ($conn->connect_error) {
            die("Erro ao conectar ao banco de dados: " . $conn->connect_error);
        }

        // Verifica se o e-mail já está em uso
        $verify_query = $conn->query("SELECT email FROM users WHERE email = '$email'");
        if($verify_query->num_rows != 0) {
            echo "<div class='message'>Este e-mail já está em uso. Por favor, tente outro.</div>";
        } else {
            // Hash a senha
            $hashed_password = password_hash($senha, PASSWORD_DEFAULT);

            // Prepara e executa a declaração SQL para inserir o usuário no banco de dados
            $stmt = $conn->prepare("INSERT INTO users (usuario, email, senha) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $usuario, $email, $hashed_password);

            if ($stmt->execute()) {
                // Sucesso no registro, redireciona o usuário para a página de sucesso
                header("Location: sucesso.php");
                exit(); // Certifique-se de sair após o redirecionamento
            } else {
                echo "Erro ao registrar usuário: " . $conn->error;
            }

            // Fecha a declaração
            $stmt->close();
        }

        // Fecha a conexão com o banco de dados
        $conn->close();
    } else {
        // Se algum dos campos estiver faltando
        echo "<div class='message'>Todos os campos do formulário devem ser preenchidos.</div>";
    }
}
?>


<!--///////////////////////////////////////////////////////////////////////////-->

    <button type="submit" class="cadastrar" name="cadastrar">Cadastrar</button> <!-- Botão de submit -->
</form>
</body>
</html>

<!--
http://localhost/MeuPet7L/MeuPet7L/login/login.php#
http://localhost/phpmyadmin/index.php?route=/sql&pos=0&db=meupet7l&table=users
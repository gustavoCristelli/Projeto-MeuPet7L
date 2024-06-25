<?php

session_start();

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

?>

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

<!-- Formulário de Login -->
<form class="formL" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
    <h5>Login</h5>
    <div class="input-row">
        <label for="email">E-mail</label>
        <input class="caixa" type="text" name="email" id="email">
    </div>
    <div class="input-row">
        <label for="senha">Senha</label>
        <input class="caixa" type="password" name="senha" id="senha">
    </div>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['entrar'])) {

        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $senha = mysqli_real_escape_string($conn, $_POST['senha']);
        
        $tipo_usuario = ($_POST['radio'] == 'tutor' ? 'users' : 'vet');

        $result = mysqli_query($conn, "SELECT * FROM $tipo_usuario WHERE email='$email'") or die ("Erro na consulta: " . mysqli_error($conn));
        $row = mysqli_fetch_assoc($result);

        // Se for um veterinário, verifica se o email existe na tabela e se a senha está correta (COM HASH)
        if ($tipo_usuario == 'users') {
            if(is_array($row) && password_verify($senha, $row['senha'])) {
                $_SESSION['validUser'] = $row['email'];
                $_SESSION['usuario'] = $row['usuario'];
                $_SESSION['tipo_usuario'] = 'tutor'; // Defina como 'tutor' para tutor/dono
                header("Location: http://localhost/MeuPet7L/MeuPet7L/");
                exit();
            } else {
                echo "<div class='message'>E-mail ou senha incorretos.</div>";
            }

        // Se for um veterinário, verifica se o email existe na tabela e se a senha está correta (SEM HASH)
        } else {
            if(is_array($row) && $senha === $row['senha']) {
                $_SESSION['validUser'] = $row['email'];
                $_SESSION['usuario'] = $row['usuario'];
                $_SESSION['tipo_usuario'] = 'vet'; // Defina como 'vet' para veterinário
                header("Location: http://localhost/MeuPet7L/MeuPet7L/");
                exit();
            } else {
                echo "<div class='message'>E-mail ou senha incorretos.</div>";
            }
        }
    }
    ?>

    <h5>Fazer login como:</h5>
    <div class="container">
        <div class="row">
            <label>
                <div class="col">
                    <input type="radio" name="radio" value="tutor" checked>
                    <span>Tutor/Dono</span>
                </div>
            </label>
            <label>
                <div class="col">
                    <input type="radio" name="radio" value="veterinario">
                    <span>Veterinário</span>
                </div>
            </label>
        </div>
    </div>
    <a href="cadastro.php" class="suporte" id="irCadastro"><p>Não possui uma conta? Cadastre-se!</p></a>
    <button type="submit" class="entrar" name="entrar">Entrar</button> <!-- Botão de submit -->
</form>
</body>
</html>

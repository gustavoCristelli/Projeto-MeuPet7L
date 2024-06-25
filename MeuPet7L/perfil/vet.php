<?php
// Inicia a sessão para acessar variáveis de sessão
session_start();

// Conecta ao banco de dados
$host = 'localhost';
$user = 'root';
$password = ''; 
$database = 'meupet7l';

$conn = new mysqli($host, $user, $password, $database);

// Se o botão logout for pressionado
if (isset($_POST['logout'])) {
    // Limpa todas as variáveis de sessão
    $_SESSION = array();
    // Destrói a sessão
    session_destroy();
    // Redireciona o usuário de volta para a página de login (ou qualquer outra página que você queira)
    header("Location: http://localhost/MeuPet7L/MeuPet7L/");
    exit(); // Certifique-se de sair após o redirecionamento
}

// Verifica se o usuário está logado
if (!isset($_SESSION['validUser'])) {
    // Se não estiver logado, redirecione para a página de login
    header("Location: http://localhost/MeuPet7L/MeuPet7L/");
    exit();
}

// Carrega os dados atuais do usuário da tabela correspondente
$email = $_SESSION['validUser']; // Utilize o email para identificar o usuário
$tipo_usuario = $_SESSION['tipo_usuario']; // Tipo de usuário (users ou vet)

// Determina a tabela a ser consultada e atualizada com base no tipo de usuário
$tabela = ($tipo_usuario == 'tutor') ? 'users' : 'vet';

$sql = "SELECT * FROM $tabela WHERE email = '$email'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    // Defina as variáveis de sessão com os dados atuais do usuário, se ainda não estiverem definidas
    if (!isset($_SESSION['usuario'])) {
        $_SESSION['usuario'] = $row['usuario'];
    }

} else {
    echo "Usuário não encontrado.";
    exit();
}

$conn->close(); // Feche a conexão com o banco de dados no final do arquivo PHP
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="perfil.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
</head>
<body>
    <header>
        <div class="header-content">
            <h1 class="logo"><a  href="http://localhost/MeuPet7L/MeuPet7L/">Meu Pet 7L</a></h1>
        </div>
    </header>

    <!-- Formulário de Logout -->
    <div class="fundo">
        <form method="post" action="" class="vet">

            <table><thead>

                <th><h2>Portal do veterinário</h2></th>
                <tr>
                <td><?php if (isset($_SESSION['usuario'])) {echo "<h4>Bem-vindo de volta, " . $_SESSION['usuario'] . "! :)</h4>";}?></td>
                </tr>
                <tr>
                    <td><button class="logout" type="submit" name="logout">Logout</button></td>
                </tr>

            </table>
        </form>
    </div>
</body>
</html>

<?php
// Inicialize a sessão se ela ainda não estiver inicializada
if (!isset($_SESSION)) {
    session_start();
}

// Verifica se o usuário está logado
if (!isset($_SESSION['validUser'])) {
    // Se não estiver logado, redirecione para a página de login
    header("Location: http://localhost/MeuPet7L/MeuPet7L/");
    exit();
}

// Conecta ao banco de dados (substitua com suas credenciais)
$host = 'localhost';
$user = 'root';
$password = '';
$database = 'meupet7l';

$conn = new mysqli($host, $user, $password, $database);

// Verifica a conexão
if ($conn->connect_error) {
    die("Erro ao conectar ao banco de dados: " . $conn->connect_error);
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
    // Defina as variáveis de sessão com os dados atuais do usuário
    $_SESSION['usuario'] = $row['usuario'];
    $_SESSION['pet'] = $row['pet'];
    $_SESSION['raça'] = $row['raça'];
    $_SESSION['telefone'] = $row['telefone'];
    $_SESSION['idade'] = $row['idade'];
} else {
    echo "Usuário não encontrado.";
    exit();
}

// Lógica para atualizar os dados do perfil
if (isset($_POST['salvar'])) {
    // Captura dos novos dados do formulário
    $usuario_novo = $_POST['usuario'];
    $pet_novo = $_POST['pet'];
    $raça_nova = $_POST['raça'];
    $telefone_novo = $_POST['telefone'];
    $idade_nova = $_POST['idade'];

    // Monta a query SQL para atualizar os dados na tabela correspondente
    $sql_update = "UPDATE $tabela SET ";

    $updates = array();

    // Adiciona os campos ao array $updates se eles não estiverem vazios
    if (!empty($usuario_novo)) {
        $updates[] = "usuario = '$usuario_novo'";
    }
    if (!empty($pet_novo)) {
        $updates[] = "pet = '$pet_novo'";
    }
    if (!empty($raça_nova)) {
        $updates[] = "raça = '$raça_nova'";
    }
    if (!empty($telefone_novo)) {
        $updates[] = "telefone = '$telefone_novo'";
    }
    if (!empty($idade_nova)) {
        $updates[] = "idade = '$idade_nova'";
    }

    // Monta a query SQL final apenas com os campos atualizados
    $sql_update .= implode(", ", $updates);
    $sql_update .= " WHERE email = '$email'";

    if (!empty($updates)) {
        if ($conn->query($sql_update) === TRUE) {
            // Atualiza as variáveis de sessão com os novos dados
            $_SESSION['usuario'] = $usuario_novo;
            $_SESSION['pet'] = $pet_novo;
            $_SESSION['raça'] = $raça_nova;
            $_SESSION['telefone'] = $telefone_novo;
            $_SESSION['idade'] = $idade_nova;

            echo "Dados atualizados com sucesso!";
            // Redireciona para a página de perfil após a atualização
            header("Location: http://localhost/MeuPet7L/MeuPet7L/perfil/perfil.php");
            exit();
        } else {
            echo "Erro ao atualizar os dados: " . $conn->error;
        }
    } else {
        echo "Nenhum dado foi alterado.";
    }
}

$conn->close(); // Feche a conexão com o banco de dados no final do arquivo PHP
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Perfil</title>
    <link rel="stylesheet" href="editar.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
</head>
<body>
    <header>
        <div class="header-content">
            <h1 class="logo"><a href="http://localhost/MeuPet7L/MeuPet7L/">Meu Pet 7L</a></h1>
        </div>
    </header>

    <!-- Formulário de edição do perfil -->
    <div class="fundo">
        <form method="post" action="">

            <table>
                <tbody>
                    <tr>
                        <td><h3>Nome</h3></td>
                        <td><h3>Pet</h3></td>
                    </tr>
                    <tr>
                        <td><input class="caixa" type="text" name="usuario" id="usuario" value="<?php echo isset($_SESSION['usuario']) ? $_SESSION['usuario'] : ''; ?>" placeholder="Digite o usuário"></td>
                        <td><input class="caixa" type="text" name="pet" id="pet" value="<?php echo isset($_SESSION['pet']) ? $_SESSION['pet'] : ''; ?>" placeholder="Digite o pet"></td>
                    </tr>
                    <tr>
                        <td><h3>E-mail</h3></td>
                        <td><h3>Raça</h3></td>
                    </tr>
                    <tr>
                        <td><input class="caixa" type="text" name="email" id="email" value="<?php echo isset($_SESSION['validUser']) ? $_SESSION['validUser'] : ''; ?>" placeholder="Digite o email"></td>
                        <td><input class="caixa" type="text" name="raça" id="raça" value="<?php echo isset($_SESSION['raça']) ? $_SESSION['raça'] : ''; ?>" placeholder="Digite a raça"></td>
                    </tr>
                    <tr>
                        <td><h3>Telefone</h3></td>
                        <td><h3>Idade</h3></td>
                    </tr>
                    <tr>
                        <td><input class="caixa" type="text" name="telefone" id="telefone" value="<?php echo isset($_SESSION['telefone']) ? $_SESSION['telefone'] : ''; ?>" placeholder="Digite o telefone"></td>
                        <td><input class="caixa" type="text" name="idade" id="idade" value="<?php echo isset($_SESSION['idade']) ? $_SESSION['idade'] : ''; ?>" placeholder="Digite a idade"></td>
                    </tr>
                    <tr>
                        <td><button class="salvar" type="submit" name="salvar">Salvar</button></td>
                        <td><button class="cancelar" type="submit" name="cancelar" href="http://localhost/MeuPet7L/MeuPet7L/perfil/perfil.php"><a  href="http://localhost/MeuPet7L/MeuPet7L/perfil/perfil.php">Cancelar</a></button></td>
                    </tr>
                </tbody>
            </table>
        </form>
    </div>
</body>
</html>
<?php
session_start();

// Inicialize as variáveis
$buttonText = "Login";
$buttonLink = "login/login.php";
$showAddButtons = false;

// Verifique se o usuário está logado
if(isset($_SESSION['validUser'])) {
    // Se o usuário estiver logado, exiba o botão "Perfil"
    $buttonText = "Perfil";
    
    // Verifique se o índice 'tipo_usuario' está definido na sessão
    if(isset($_SESSION['tipo_usuario'])) {
        if ($_SESSION['tipo_usuario'] == 'vet') {
            $buttonLink = "http://localhost/MeuPet7L/MeuPet7L/perfil/vet.php"; 
        } else {
            $buttonLink = "http://localhost/MeuPet7L/MeuPet7L/perfil/perfil.php"; 
        }
    }

    // Outros controles de visibilidade de botões adicionais podem ser implementados aqui
    if($_SESSION['tipo_usuario'] == 'vet') {
        $showAddButtons = true;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meu Pet 7L</title>
    <link rel="stylesheet" href="cuidados.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
</head>
<body>

    <!-- Navbar -->

    <nav class="navbar">
        <h1 class="logo"><a  href="http://localhost/MeuPet7L/MeuPet7L/">Meu Pet 7L</a></h1>
        <ul class="navlinks">
            <li class="active"><a href="cuidados.php"><h3>Cuidados <br>e dicas</h3></a></li>
            <li><a href="contato.php">Fale com <br>um vet</a></li>
            <li><a href="agenda.php">Agendamento</a></li>

            <!-- Edita o botão de login caso esteja logado -->
            <li><a href="<?php echo $buttonLink; ?>"><button class="login" id="login"><?php echo $buttonText; ?></button></a></li>
            
            </ul>
    </nav>
    <header>
        <div class="header-content">
            <h2>Cuidados e dicas</h2>
            <img src="images/Pata.jpeg" alt="">
            <br>
            <br>
            <div class="line"></div>
            <h1>Dicas essenciais para garantir o bem-estar e a saúde <br> do seu companheiro peludo.</h1>
        </div>
    </header>

    <div class="fundo">
    <!-- Criar -->
    <?php if ($showAddButtons): ?>
    <button class="criar" id="criar"><p>+</p></button>
    <?php endif; ?>
    
    <!-- Tabela -->
    
    <section class="info">
        
        <h1>Mural de dicas</h1>
        
        <table>
            <thead>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
    </section>

    <!-- Adicionar conteudo -->

    <form class="formT">
        <button class="fechar" id="fechar"><h6><span>&#215;</span></h6></button>
        <h5>Adicionar conteúdo</h5>
        <div class="input-row">
            <label for="url">Url da imagem</label>
            <textarea class="caixa" type="url" name="url" id="url"></textarea>
        </div>
        <div class="input-row">
            <label for="titulo">Título</label>
            <textarea class="caixa" type="text" name="titulo" id="titulo"></textarea>
        </div>
        <div class="input-row"> 
            <label for="conteudo">Conteúdo</label>
            <textarea class="caixa2" type="text" name="conteudo" id="conteudo"></textarea>
        </div>
        <div id="alertMessage" class="alerta"></div>
            <button class="submit">Publicar</button>
    </form>

        <!-- Footer -->

        <section class="footer">
            <h1>Alguma dúvida?</h1>
            <p>Telefone: ((**) *****-****)</p>
            <p>E-mail: *****@***.com</p>
            <h1>Como nos encontrar:</h1>
            <p>(Endereço)</p>
            <p>© Nenhum direito reservado 2024.</p>
        </section>
    <script src="cuidados.js"></script>
</div>
</body>
</html>
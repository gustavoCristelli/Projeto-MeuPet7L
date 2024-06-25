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
    <link rel="stylesheet" href="contato.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
</head>
<body>
    
    <!-- Navbar -->

    <nav class="navbar">
        <h1 class="logo"><a  href="http://localhost/MeuPet7L/MeuPet7L/">Meu Pet 7L</a></h1>
        <ul class="navlinks">
            <li><a href="cuidados.php">Cuidados <br>e dicas</a></li>
            <li><a href="contato.php"><h3>Fale com <br>um vet</h3></a></li>
            <li><a href="agenda.php">Agendamento</a></li>

            <!-- Edita o botão de login caso esteja logado -->
            <li><a href="<?php echo $buttonLink; ?>"><button class="login" id="login"><?php echo $buttonText; ?></button></a></li>
            
            </ul>
    </nav>
    <header>
        <div class="header-content">
            <h2>Fale com um vet</h2>
            <img src="images/Pata.jpeg" alt="">
            <br>
            <br>
            <div class="line"></div>
            <h1>Acesso direto a profissionais especializados <br> em saúde animal via Whatsapp.</h1>
        </div>
    </header>
    
    <div class="fundo">

    <!-- Informações -->

    <section class="info">
    <div class="title">
        <h1>Nossos veterinários</h1>
    </div>
        <section class="info2">
            <div class="row">
                <div class="col">
                <div class="dados1">
                    <div class="foto"><img src="images\dog2.png" alt=""></div>
                </div>
                </div>
                
                <div class="col">
                    <div class="dados2">
                        <h2>Nome do veterinário</h2>
                        <p>Whatsapp: (**) *****-****</p>
                        <p>Email: **********@******.***</p>
                    </div>
                </div> 
                </div>
            </section>

            <section class="info2">
                <div class="row">
                    <div class="col">
                    <div class="dados1">
                    <div class="foto"><img src="images\cat.png" alt=""></div>
                    </div>
                    </div>
                    
                    <div class="col">
                        <div class="dados2">
                            <h2>Nome do veterinário</h2>
                            <p>Whatsapp: (**) *****-****</p>
                            <p>Email: **********@******.***</p>
                        </div>
                    </div> 
                </div>
            </section>
                
        </section>
        
        <!-- Footer -->
        
    </div> 
    <section class="footer">
        <h1>Alguma dúvida?</h1>
        <p>Telefone: ((**) *****-****)</p>
        <p>E-mail: *****@***.com</p>
        <h1>Como nos encontrar:</h1>
        <p>(Endereço)</p>
        <p>© Nenhum direito reservado 2024.</p>
    </section>
    <script src="contato.js"></script>
</div>
</body>
</html>
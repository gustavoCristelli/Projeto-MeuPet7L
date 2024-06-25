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
    <link rel="stylesheet" href="index.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
</head>
<body>
    <div class="custom-scrollbar">
    <!-- Navbar -->
    
    <nav class="navbar">
        <h1 class="logo"><a  href="http://localhost/MeuPet7L/MeuPet7L/">Meu Pet 7L</a></h1>
        <ul class="navlinks">
            <li><a href="cuidados.php">Cuidados <br>e dicas</a></li>
            <li><a href="contato.php">Fale com <br>um vet</a></li>
            <li><a href="agenda.php">Agendamento</a></li>

            <!-- Edita o botão de login caso esteja logado -->
            <li><a href="<?php echo $buttonLink; ?>"><button class="login" id="login"><?php echo $buttonText; ?></button></a></li>
            
            
        </ul>
    </nav>
    <header>
        <div class="header-content">
            <h2> O que seu pet precisa? </h2>
            <div class="line"></div>
            <h1> Nós entendemos que seus animais de estimação <br> são membros especiais e queridos da sua família!</h1>
            <a href="http://localhost/MeuPet7L/MeuPet7L/sobre/sobre.php" class="ctn">Sobre nós</a>
        </div>
    </header>

    <!-- Informações -->
    
    <div class="fundo">
        <section class="info">
            <div class="title">
                <h1>Informações rápidas</h1>
                <div class="line"></div>
            </div>
            <div class="row">
                <div class="col">
                    <a  href="cuidados.php"><img src="images/Cuidados.png" alt=""></a>
                    <h4>Cuidados e dicas</h4>
                    <p>Dicas essenciais para garantir o bem-estar e a saúde <br> do seu companheiro peludo.</p>
                    <a href="cuidados.php" class="ctn">Saiba mais</a>
                </div>
                <div class="col">
                    <a  href="contato.php"><img src="images/Fale.png" alt=""></a>
                    <h4>Fale com um vet</h4>
                    <p>Acesso direto a profissionais especializados <br> em saúde animal via Whatsapp.</p>
                    <a href="contato.php" class="ctn">Saiba mais</a>
                    
                    
                </div>
            </div>
        </section>
    
    <!-- Vacinas -->
    
    <section class="vacinas">
        <div class="title">
            <h1>Vacinação</h1>
            <div class="line"></div>
        </div>
        <div class="row2">
            <h1>Pontos de vacinação</h1>
            <?php if ($showAddButtons): ?>
            <button class="add" id="addPontos"><h6>+</h6></button>
            <?php endif; ?>
            <div class="line2"></div>
            <p>Informação sobre horários, pontos de vacinação, documentos necessários e vacinas disponíveis</p>

            <!-- Pontos -->
        
            <table id="tableP">
                <thead>
                    <tr>
                        <td>Local</td>
                        <td>Horário</td>
                        <td>Documentos</td>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>

            </div>
            <div class="row2">
                <h1>Vacinas <br> disponíveis</h1>
                <?php if ($showAddButtons): ?>
            <button class="add" id="addVacinas"><h6>+</h6></button>
            <?php endif; ?>
                <div class="line2"></div>
                <p>Informação sobre horários, vacinas disponíveis, documentos necessários e valor</p>
                <!-- Vacinas -->
        
            <table id="tableV">
                <thead>
                    <tr>
                        <td>Vacina</td>
                        <td>Local</td>
                        <td>Horário</td>
                        <td>Documentos</td>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>

            </div>
        </section>

    <!-- AddPontos -->

    <form class="formP">
        <button class="fecharP" id="fecharP"><h6><span>&#215;</span></h6></button>
        <h5>Adicionar pontos de vacinação</h5>
        <div class="input-row">
            <label for="localP">Local de vacinação</label>
            <input class="caixa" type="text" name="localP" id="localP">
        </div>
        <div class="input-row">
            <label for="funcionamentoP">Horário de funcionamento</label>
            <input class="caixa" type="text" name="funcionamentoP" id="funcionamentoP">
        </div>
        <div class="input-row">
            <label for="documentosP">Documentos necessários</label>
            <input class="caixa" type="text" name="documentosP" id="documentosP">
        </div>
        <div id="alertMessageP" class="alerta"></div>
        <button class="pubP" name="pubP">Publicar</button>

    </form>

        <!-- AddVacinas -->

        <form class="formV">
            <button class="fecharV" id="fecharV"><h6><span>&#215;</span></h6></button>
            <h5>Adicionar vacinas</h5>
            <div class="input-row">
                <label for="vacinaV">Vacina disponível</label>
                <input class="caixa" type="text" name="vacinaV" id="vacinaV">
            </div>
            <div class="input-row">
            <label for="localV">Local de vacinação</label>
            <input class="caixa" type="text" name="localV" id="localV">
            </div>
            <div class="input-row">
                <label for="funcionamentoV">Horário de funcionamento</label>
                <input class="caixa" type="text" name="funcionamentoV" id="funcionamentoV">
            </div>
            <div class="input-row">
                <label for="documentosV">Documentos necessários</label>
                <input class="caixa" type="text" name="documentosV" id="documentosV">
            </div>
            <div id="alertMessageV" class="alerta"></div>
            <button class="pubV" name="pubV">Publicar</button>

        </form>


    <!-- Agende -->
    
    <section class="agende">
        <div class="row">
            <div class="col content-col">
                <h1>Agende sua consulta!</h1>
                <div class="line"></div>
                <p>Nossos veterinários são profissionais versáteis que oferecem uma ampla gama de serviços de saúde animal, incluindo consultas, vacinações e cuidados de emergência.</p>
                <a href="agenda.php" class="ctn">Quero agendar</a>

            </div>
            <div class="col image-col">
                <div class="image-gallery">
                    <a  href="agenda.php"><img src="images/imagecol1.jpg" alt=""></a>
                    <a  href="agenda.php"><img src="images/imagecol4.jpg" alt=""></a>
                    <a  href="agenda.php"><img src="images/imagecol3.png" alt=""></a>
                <a  href="agenda.php"><img src="images/imagecol2.jpg" alt=""></a>
            </div>
        </div>
    </div>
    </section>


        <!-- Footer -->

    <section class="footer">
        <h1>Alguma dúvida?</h1>
        <p>Telefone: ((**) *****-****)</p>
        <p>E-mail: *****@***.com</p>
        <h1>Como nos encontrar:</h1>
        <p>(Endereço)</p>
        <p>© Nenhum direito reservado 2024.</p>
    </section>
    <script src="index.js"></script>
    
</div>
</div>
</body>
</html>
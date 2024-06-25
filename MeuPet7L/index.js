// Adicionar a classe 'active' ao formulário de pontos de vacinação ao clicar no botão
document.querySelector("#addPontos").addEventListener("click", function() {
    document.querySelector(".formP").classList.add("active");
    document.querySelector(".formV").classList.remove("active");
  })
  
  // Remover a classe 'active' do formulário de pontos de vacinação ao clicar no botão 'fechar'
  document.querySelector("#fecharP").addEventListener("click", function() {
    document.querySelector(".formP").classList.remove("active");
    document.getElementById("alertMessageP").textContent = "";
    document.getElementById("localP").value = "";
    document.getElementById("funcionamentoP").value = "";
    document.getElementById("documentosP").value = "";

  })
  
  // Adicionar a classe 'active' ao formulário de vacinas disponíveis ao clicar no botão
  document.querySelector("#addVacinas").addEventListener("click", function() {
    document.querySelector(".formV").classList.add("active");
    document.querySelector(".formP").classList.remove("active");
  })
  
  // Remover a classe 'active' do formulário de vacinas disponíveis ao clicar no botão 'fechar'
  document.querySelector("#fecharV").addEventListener("click", function() {
    document.querySelector(".formV").classList.remove("active");
    document.getElementById("alertMessageV").textContent = "";
    document.getElementById("vacinaV").value = "";
    document.getElementById("localV").value = "";
    document.getElementById("funcionamentoV").value = "";
    document.getElementById("documentosV").value = "";
  })
  
  // Selecionar a tabela de pontos de vacinação
  const tableElP = document.getElementById("tableP");
  
  // Selecionar a tabela de vacinas disponíveis
  const tableElV = document.getElementById("tableV");
  
  // Selecionar o formulário de pontos de vacinação
  const formElP = document.querySelector(".formP");
  
  // Selecionar o formulário de vacinas disponíveis
  const formElV = document.querySelector(".formV");
  
  // Função para adicionar conteúdo à tabela
  function onAddConteudo(e) {
    e.preventDefault();

    // Verificar se o evento ocorreu no botão "fechar" do formulário de pontos de vacinação
    if (e.submitter && e.submitter.classList.contains('pubP')) {

        const localP = document.getElementById("localP").value.replace(/\n/g, '<br>'); 
        const funcionamentoP = document.getElementById("funcionamentoP").value;
        const documentosP = document.getElementById("documentosP").value;

        // Verificar se todos os campos estão preenchidos
        if (localP && funcionamentoP && documentosP) {
            // Adicionar uma nova linha à tabela de pontos de vacinação
            tableElP.innerHTML += `
                <tr>
                    <td><p>${localP}</p></td>
                    <td><p>${funcionamentoP}</p></td>
                    <td><p>${documentosP}</p></td>
                    <td><button class="deleteBtn">X</button></td>
                </tr>
            `;

            // Limpar os campos de entrada
            document.getElementById("localP").value = "";
            document.getElementById("funcionamentoP").value = "";
            document.getElementById("documentosP").value = "";

            // Limpar mensagem de alerta, se houver
            document.getElementById("alertMessageP").textContent = "";
        } else {
            // Exibir mensagem de alerta
            document.getElementById("alertMessageP").textContent = "Por favor, preencha todos os campos.";
        }
    }

    // Verificar se o evento ocorreu no botão "fechar" do formulário de vacinas disponíveis
    if (e.submitter && e.submitter.classList.contains('pubV')) {
        const localV = document.getElementById("localV").value.replace(/\n/g, '<br>'); 

        const vacinaV = document.getElementById("vacinaV").value;
        const funcionamentoV = document.getElementById("funcionamentoV").value;
        const documentosV = document.getElementById("documentosV").value;

        // Verificar se todos os campos estão preenchidos
        if (vacinaV && localV && funcionamentoV && documentosV) {
            // Adicionar uma nova linha à tabela de vacinas disponíveis
            tableElV.innerHTML += `
                <tr>
                    <td><p>${vacinaV}</p></td>
                    <td><p>${localV}</p></td>
                    <td><p>${funcionamentoV}</p></td>
                    <td><p>${documentosV}</p></td>
                    <td><button class="deleteBtn">X</button></td>
                </tr>
            `;

            // Limpar os campos de entrada
            document.getElementById("vacinaV").value = "";
            document.getElementById("localV").value = "";
            document.getElementById("funcionamentoV").value = "";
            document.getElementById("documentosV").value = "";

            // Limpar mensagem de alerta, se houver
            document.getElementById("alertMessageV").textContent = "";
        } else {
            // Exibir mensagem de alerta
            document.getElementById("alertMessageV").textContent = "Por favor, preencha todos os campos.";
        }
    }
}
  
  // Função para excluir uma linha da tabela
  function onDeleteRow(e) {
      if (!e.target.classList.contains("deleteBtn")) {
          return;
      }
  
      const btn = e.target;
      btn.closest("tr").remove();
  }
  
  // Adicionar o evento 'submit' aos formulários
  formElP.addEventListener("submit", onAddConteudo);
  formElV.addEventListener("submit", onAddConteudo);
  
  // Adicionar o evento de clique às tabelas para excluir linhas
  tableElP.addEventListener("click", onDeleteRow);
  tableElV.addEventListener("click", onDeleteRow);
  
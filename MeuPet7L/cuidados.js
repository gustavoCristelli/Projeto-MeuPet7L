//Aparecer form

document.querySelector("#criar").addEventListener("click", function() {
  document.querySelector(".formT").classList.add("active");
})

document.querySelector("#fechar").addEventListener("click", function() {
  document.querySelector(".formT").classList.remove("active");
})

const urlInput = document.getElementById('url');
const fileInput = document.getElementById('furl');
const previewImg = document.getElementById('preview');

// Atualizar o preview da imagem ao inserir a URL

urlInput.addEventListener('input', function() {
  previewImg.src = urlInput.value;
});


//Adicionar na tabela 

const formEl = document.querySelector(".formT");
const tbodyEl = document.querySelector("tbody");
const tableEl = document.querySelector("table");
function onAddConteudo(e) {
  e.preventDefault();
  
  // Verificar se o evento ocorreu no botão "fechar"
  if (e.submitter && e.submitter.id === 'fechar') {
    document.querySelector(".formT").classList.remove("active");
    document.getElementById("alertMessage").textContent = "";
    document.getElementById("url").value = "";
    document.getElementById("titulo").value = "";
    document.getElementById("conteudo").value = "";
    return;


  }

  // Se não foi no botão "fechar", continuar com a adição de conteúdo na tabela
  if (e.submitter && e.submitter.classList.contains('submit')) {
    const conteudo = document.getElementById("conteudo").value.replace(/\n/g, '<br>'); // Substituir quebras de linha por <br>
    const url = document.getElementById("url").value;
    const titulo = document.getElementById("titulo").value;

    // Verificar se todos os campos estão preenchidos
    if (conteudo && url && titulo) {
      tbodyEl.innerHTML += `
    <tr>
        <td colspan="2"><h2>${titulo}</h2></td>
    </tr>
    <tr>
        <td><img class="teste" src="${url}" alt=""></td>
        <td><p>${conteudo}</p></td>
        <td><button class="deleteBtn">X</button></td>
    </tr>
      `;

      // Limpar os campos de entrada
      document.getElementById("url").value = "";
      document.getElementById("titulo").value = "";
      document.getElementById("conteudo").value = "";

      // Limpar mensagem de alerta, se houver
      document.getElementById("alertMessage").textContent = "";
    } else {
      // Exibir mensagem de alerta
      document.getElementById("alertMessage").textContent = "Por favor, preencha todos os campos.";
    }
  }
}

function onDeleteRow(e) {
  if (e.target.classList.contains("deleteBtn")) {
    const row = e.target.closest("tr"); // Encontra a linha onde o botão foi clicado
    const titleRow = row.previousElementSibling; // Encontra a linha do título correspondente
    titleRow.remove(); // Remove a linha do título
    row.remove(); // Remove a linha onde o botão foi clicado
  }
}


formEl.addEventListener("submit", onAddConteudo);
tableEl.addEventListener("click", onDeleteRow);


formEl.addEventListener("submit", onAddConteudo);
tableEl.addEventListener("click", onDeleteRow);
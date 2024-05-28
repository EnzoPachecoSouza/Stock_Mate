// TOAST DE CONFIRMAÇÃO DE AÇÃO
const parametrosURL = new URLSearchParams(window.location.search)
const acao = parametrosURL.get('act')
const toast = document.querySelector('#toast')

if (acao) {
    showToast()
}

function showToast() {
    toast.classList.add('d-block')

    setTimeout(() => {
        toast.classList.remove('d-block')
    }, 3000)
}

function closeToast() {
    toast.classList.remove('d-block')
}

//PESQUISA DE PRODUTOS
var search = document.getElementById('pesquisar');

search.addEventListener("keydown", function (event) {
    if (event.key === "Enter") {
        pesquisarDados();
    }
})

function pesquisarDados() {
    window.location = 'index.php?search=' + search.value;
}


//ORDENAÇÃO DE DADOS
var filter = document.getElementById('filtro');

function filtrarDados(valor) {
    window.location = 'index.php?filter=' + valor;
}


//FILTRO DE CATEGORIA
function filtrarCategoria() {
    window.location = 'index.php?catFiltro=' + catFiltro.value;
}


function filtrarCores() {
    window.location = 'index.php?filCor=' + filCor.value;
}


//FILTRO DE PAGAMENTO
function filtrarFormaPagamento() {
    window.location = 'index.php?catPag=' + catPag.value;
}
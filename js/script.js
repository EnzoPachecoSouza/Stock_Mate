// TOAST DE CONFIRMAÇÃO DE AÇÃO
const parametrosURL = new URLSearchParams(window.location.search)
const acao = parametrosURL.get('act')
const toast = document.querySelector('#toast')

if (acao === 'inserir') {
    showToast()
} else if (acao === 'editar') {
    showToast()
} else if (acao === 'desativar') {
    showToast()
} else if (acao === 'ativar') {
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

// VISUALIZAR MAIS DETALHES
const tabelaEntradaElement = document.querySelector('#tabelaEntrada')
const tabelaSaidaElement = document.querySelector('#tabelaSaida')

function trocarEntradaSaida() {
    tabelaEntradaElement.classList.contains('d-none')
        ? tabelaEntradaElement.classList.remove('d-none')
        : tabelaEntradaElement.classList.add('d-none')

    tabelaSaidaElement.classList.contains('d-none')
        ? tabelaSaidaElement.classList.remove('d-none')
        : tabelaSaidaElement.classList.add('d-none')
}
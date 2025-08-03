const tabs = document.querySelectorAll('.tab-btn');

// atribuição da função á todos eles
tabs.forEach( tab => tab.addEventListener('click', () => tabClicked(tab)))

// função a caso sejam clicados
const tabClicked = (tab) => {

    tabs.forEach(tab => tab.classList.remove('active'));
    tab.classList.add('active');
    // pego todos os paineis
    const contents = document.querySelectorAll('.content');

    //desativação dos paineis visíveis
    contents.forEach(content => content.classList.remove('show'));

    // pegar atributo do botão clicado
    const contentId = tab.getAttribute('content-id');

    // pegar painel com o mesmo ID do atributo do botão
    const content = document.getElementById(contentId);

    content.classList.add('show');
}

const botao_guia = localStorage.getItem('Botao_guia');

console.log(botao_guia);

if(botao_guia !== null){

    if(botao_guia == 'ong'){
        // pega os botões
        const tabs = document.querySelectorAll('.tab-btn');

        // remover a classe do todos os botões
        tabs.forEach(tab => tab.classList.remove('active'));

        // pegar atributo desses elementos
        const dataInfoValue = Array.from(tabs).map(tab => tab.getAttribute("content-id"));

        // pegar o botão da ong
        const indice = dataInfoValue.findIndex(item => item === 'services');
        const tab = tabs[indice];
        tab.classList.add('active');

        const contents = document.querySelectorAll('.content');

        //desativação dos paineis visíveis
        contents.forEach(content => content.classList.remove('show'));

        // pegar atributo do botão clicado
        const contentId = tab.getAttribute('content-id');

        // pegar painel com o mesmo ID do atributo do botão
        const content = document.getElementById(contentId);

        content.classList.add('show');
    }
}
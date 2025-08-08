let notifications = document.querySelector('.notifications');
let sucess = document.getElementById('success');
let error = document.getElementById('error');
let warning = document.getElementById('warming');
let info = document.getElementById('info');

function createToast(type, icon, title, text){
    let newToast = document.createElement('div')
    newToast.innerHTML = `
        <div class="toast ${type}">
            <i class="${icon}"></i>
            <div class="content">
                <div class="title">${title}</div>
                <span>${text}</span>
            </div>
            <i class="" onclick="(this.parentElement).remove()"></i>
        </div>`;
    notifications.appendChild(newToast);

    newToast.timeOut = setTimeout(
        () =>newToast.remove(), 5000
    )
}
sucess.onclick = function(){

    	let params = {
		particleCount: 300, // Quantidade de confetes
		spread: 130, // O quanto eles se espalham
		startVelocity: 70, // Velocidade inicial
		origin: { x: 0, y: 1 }, // Posição inicial na tela
		angle: 90 // Ângulo em que os confetes serão lançados
	};

	// Joga confetes da esquerda pra direita
	confetti(params);

	// Joga confetes da direita para a esquerda
	params.origin.x = 1;
	params.angle = 135;
	confetti(params);

    let type = 'sucess'
    let icon = "link"
    let title = "Sucess";
    let text = 'This'
    createToast(type,icon,title, text)
}

error.onclick = function(){
    let type = 'error'
    let icon = "link"
    let title = "Error";
    let text = 'errorrr'
    createToast(type,icon,title, text)
}
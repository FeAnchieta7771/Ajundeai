function createToast(type, icon, title, text){
    const notifications = document.querySelector('.notifications'); // aqui dentro!
    const newToast = document.createElement('div');

    // alert(title);
    // alert(text);

    newToast.innerHTML = `
        <div class='toast ${type}'>
            <i class='${icon}'></i>
            <div class='info'>
                <div class='title'>${title}</div>
                <span>${text}</span>
            </div>
        </div>`;

    if (notifications) notifications.appendChild(newToast);

    if (type == "victory" || type == "send") {
        
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
    }

    setTimeout(() => newToast.remove(), 5000);
}

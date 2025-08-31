let items_slider = document.querySelectorAll('.slider .item');
let next = document.getElementById('next');
let prev = document.getElementById('prev');

let active = 0;
function loadShow(){
    let stt = 0;

    items_slider[active].style.transform = `none`;
    items_slider[active].style.zIndex = '1';
    items_slider[active].style.filter = 'none';
    items_slider[active].style.opacity = 1;

    for(var i = active+1; i < items_slider.length; i++){
        stt++;
        items_slider[i].style.transform = `translateX(${120*stt}px) scale(${1 - 0.2*stt}) perspective(16px) rotateY(-1deg)`;
        items_slider[i].style.zIndex = -stt;
        items_slider[i].style.filter = 'blur(5px)';
        items_slider[i].style.opacity = stt > 2? 0:0.6;
    }
    
    stt = 0;
    for(var i = active -1; i >= 0; i--){
        stt++;
        items_slider[i].style.transform = `translateX(${-120*stt}px) scale(${1 - 0.2*stt}) perspective(16px) rotateY(1deg)`;
        items_slider[i].style.zIndex = -stt;
        items_slider[i].style.filter = 'blur(5px)';
        items_slider[i].style.opacity = stt > 2? 0:0.6;
    }
}
loadShow();

next.onclick = function(){
    active = active + 1 < items_slider.length ? active + 1 : active;
    loadShow();
}

prev.onclick = function(){
    active = active - 1 >= 0 ? active - 1 : active;
    loadShow();
}

const observer = new IntersectionObserver((entries) => {
  entries.forEach(entry => {
    if(entry.isIntersecting){
      entry.target.classList.add('show');
    }
  });
});

const items = document.querySelectorAll('.image_div');
items.forEach(item => observer.observe(item));


let volun_button = document.querySelectorAll('#Cadastro_volunt');
let ong_button = document.getElementById('Cadastro_ong');

volun_button.forEach( volun => volun.addEventListener('click', () => {
  localStorage.setItem('Botao_guia', 'voluntario');
}))

ong_button.onclick = function(){
  localStorage.setItem('Botao_guia', 'ong');
}
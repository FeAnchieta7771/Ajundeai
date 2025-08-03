const uphover = (element) => {
    element.classList.remove('btlog_desativado');
    element.classList.add('btlog');
}

const downhover = (element) => {
    element.classList.remove('btlog');
    element.classList.add('btlog_desativado');
}

const bt_ative = (element) => {
        uphover(element);
        element.disabled = false;
        element.style.opacity = 1;
}

const bt_desative = (element) => {
        downhover(element);
        element.disabled = true;
        element.style.opacity = opacity;
}

var checkbox_terms_vol = document.getElementsByClassName('check_vol')[0];
var checkbox_terms_ong = document.getElementsByClassName('check_ong')[0];
const btlog_vol = document.getElementById('btlog_vol');
const btlog_ong = document.getElementById('btlog_ong');
const error = document.getElementById('error');

const opacity = 0.5;

bt_desative(btlog_vol);
bt_desative(btlog_ong);
checkbox_terms_vol.checked = false;
checkbox_terms_ong.checked = false;

checkbox_terms_vol.addEventListener('change', function() {
    if(checkbox_terms_vol.checked){
        bt_ative(btlog_vol);

    } else{
        bt_desative(btlog_vol);
    }
});

checkbox_terms_ong.addEventListener('change', function() {
    if(checkbox_terms_ong.checked){
        bt_ative(btlog_ong);

    } else{
        bt_desative(btlog_ong);
    }
});
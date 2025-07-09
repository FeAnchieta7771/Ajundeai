
function AddSpinner(){

    const buttons = document.querySelectorAll('button');

    buttons.forEach(button => button.addEventListener('click', () => showLoading()));

    const showLoading = () => {
        document.getElementById("spinner").style.display = "block";
    }
}

function HideSpinner(){
    const spinner = document.getElementById("spinner");
    if (spinner) spinner.style.display = "none";
}
const InputCpf = (event) => {

    let value = event.target.value.replace(/\D/g, ''); // Remove non-digits
    let formattedValue = '';

    if (value.length > 9) {
        formattedValue += value.substring(0, 9) + '-' + value.substring(9, 12);
    } else {
        formattedValue += value.substring(0, 9)
    }


    event.target.value = formattedValue;
};

document.querySelectorAll('input[name="cpf"]').forEach(cpf => {
    cpf.addEventListener('input', InputCpf);
});
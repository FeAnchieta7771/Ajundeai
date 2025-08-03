const InputTelefone = (event) => {

    let value = event.target.value.replace(/\D/g, ''); // Remove non-digits
    let formattedValue = '';

    if (value.length > 0) {
        formattedValue += '(' + value.substring(0, 2);
    }
    if (value.length > 2) {
        formattedValue += ') ' + value.substring(2, 6);
    }
    if (value.length > 6) {
        formattedValue += '-' + value.substring(6, 10);
    } 
    if (value.length > 10) {
        formattedValue += value.substring(10, 12);
        formattedValue = formattedValue.replace("-", "");
        formattedValue = formattedValue.slice(0,10) + '-' + formattedValue.slice(10);
    }
    if(value.length > 11){
        formattedValue = formattedValue.substring(0, 15);
    }


    event.target.value = formattedValue;
};

document.querySelectorAll('input[name="telephone"]').forEach(phone => {
    phone.addEventListener('input', InputTelefone);
});
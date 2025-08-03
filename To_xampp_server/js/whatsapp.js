const InputPhoneWhat = (event) =>  {
    let value = event.target.value.replace(/\D/g, ''); // Remove non-digits
    let formattedValue = '';


    let text = "+55 ";

    if (value.startsWith('55')) {
        value = value.slice(2)
    }
    if (value.length > 0) {
        formattedValue += text + '(' + value.substring(0, 2);
    }
    if (value.length > 2) {
        formattedValue += ') ' + value.substring(2, 7);
    }
    if (value.length > 7) {
        formattedValue += '-' + value.substring(7, 11);
    } 
    if(value.length > 11){
        formattedValue = formattedValue.substring(0, 19);
    }

    event.target.value = formattedValue;
};

document.querySelectorAll('input[name="whats"]').forEach(what => {
    what.addEventListener('input', InputPhoneWhat);
});

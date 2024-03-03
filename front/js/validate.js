function validate(form) {
    let inputs = form.querySelectorAll("input");
    let textareas = form.querySelectorAll("textarea");
    let error = false;

    [...inputs, ...textareas].forEach((element) => {
        if (element.required) {
            if (element.value == '' || element.value === null || element.value === undefined) {
                element.classList.add('is-invalid');
                error = true;
            } else {
                element.classList.remove('is-invalid');
            }
        }
    });

    return error;
}

module.exports = validate;
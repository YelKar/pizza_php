function showForm(form, submit) {
    let formNode = showPopup(form);
    formNode.querySelector("form").addEventListener("submit", submit);
    return formNode;
}


function createError(text) {
    let errNode = document.createElement("span");
    errNode.classList.add("popup-form__error");
    errNode.textContent = text;
    return errNode;
}
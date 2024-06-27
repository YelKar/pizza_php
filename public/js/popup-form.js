function showForm(form, submit) {
    for (let form of document.getElementsByClassName("popup-form__container")) {
        form.remove();
    }

    let formNode = document.createElement("div");
    let body = document.querySelector("body");
    formNode.classList.add("popup-form__container");
    formNode.innerHTML = form;
    formNode.querySelector("form").addEventListener("submit", submit);
    body.appendChild(formNode);
    return formNode;
}


function createError(text) {
    let errNode = document.createElement("span");
    errNode.classList.add("popup-form__error");
    errNode.textContent = text;
    return errNode;
}
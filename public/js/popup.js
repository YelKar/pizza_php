function showPopup(html) {
    for (let popup of document.getElementsByClassName("popup__container")) {
        popup.remove();
    }

    let popupNode = document.createElement("div");
    let body = document.querySelector("body");
    popupNode.onclick = e => {
        if (e.target === popupNode) {
            popupNode.remove();
        }
    }
    popupNode.classList.add("popup__container");
    popupNode.innerHTML = html;
    body.appendChild(popupNode);
    return popupNode;
}
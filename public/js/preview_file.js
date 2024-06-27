let file_input = document.querySelector("input.user_avatar[type=\"file\"]");
let preview_block = document.querySelector("label[for=\"user_avatar\"]");

file_input.addEventListener("change", showImage);

function showImage() {
    let url = URL.createObjectURL(file_input.files[0]);
    preview_block.style.backgroundImage = `url(${url})`;
}

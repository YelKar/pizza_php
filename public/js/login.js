let loginFormHTML = `
<form class="login-form popup-form">
  <h2 class="popup-form__title">Вход</h2>
  <label for="email" class="popup-form__label">Почта</label>
  <input type="email" id="email" name="email" required placeholder="ivanov@mail.ru" class="popup-form__field">
  <label for="password" class="popup-form__label">Пароль</label>
  <input type="password" id="password" name="password" required placeholder="******" class="popup-form__field">
  <input type="submit" value="Войти" class="login-form__submit popup-form__submit popup-form__field">
</form>
`;
async function submitLogin(e) {
    e.preventDefault();

    const data = new URLSearchParams();
    for (const pair of new FormData(this)) {
        data.append(pair[0], pair[1]);
    }

    let response = await fetch('/api/login', {
        method: 'POST',
        body: data
    });

    if (response.status === 401) {
        let err = createError("Неверный почтовый адрес или пароль");
        let submitBtn = this.querySelector(".popup-form__submit");
        this.insertBefore(err, submitBtn);
    } else if (response.ok) {
        window.location.reload();
    }
}


// let form = showForm(loginFormHTML, submitLogin);
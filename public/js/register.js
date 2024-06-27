let registerFormHTML = `
<form class="register-form popup-form">
  <h2 class="popup-form__title">Регистрация</h2>
  <label for="firstname" class="popup-form__label">Имя</label>
  <input type="text" id="firstname" name="first_name" required placeholder="Иван" autocomplete="off" class="popup-form__field">
  <label for="lastname" class="popup-form__label">Фамилия</label>
  <input type="text" id="lastname" name="last_name" required placeholder="Иванов" autocomplete="off" class="popup-form__field">
  <label for="email" class="popup-form__label">Почта</label>
  <input type="email" id="email" name="email" required placeholder="ivanov@mail.ru" class="popup-form__field">
  <label for="password" class="popup-form__label">Пароль</label>
  <input type="password" id="password" name="password" required placeholder="******" class="popup-form__field">
  <label for="phone" class="popup-form__label">Телефон</label>
  <input type="tel" id="phone" name="phone" required placeholder="ivanov@mail.ru" class="popup-form__field">
  <input type="submit" value="Зарегистрироваться" class="register-form__submit popup-form__submit popup-form__field">
</form>
`;

async function submitRegister(e) {
    e.preventDefault();

    const data = new URLSearchParams();
    for (const pair of new FormData(this)) {
        data.append(pair[0], pair[1]);
    }

    let response = await fetch('/api/register', {
        method: 'POST',
        body: data
    });
    if (response.status === 409) {
        let err = createError("Пользователь с таким почтовым адресом уже есть");
        let submitBtn = this.querySelector(".popup-form__submit");
        this.insertBefore(err, submitBtn);
    } else if (response.ok) {
        this.parentNode.remove();
        showForm(loginFormHTML, submitLogin);
    }
}
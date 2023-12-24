const menuBtn = document.querySelector('.menu__btn')
const menuList = document.querySelector('.menu__list')

menuBtn.addEventListener('click', () => {
  menuList.classList.toggle('menu--open')
  menuBtn.classList.toggle('menu--open')
})

// --------------Scroll To Top-----------

const button = document.querySelector('#scrollToTopButton')

function scrollToTop() {
  const currentPosition = window.scrollY || document.documentElement.scrollTop

  if (currentPosition > 0) {
    window.requestAnimationFrame(scrollToTop)
    window.scrollTo(0, currentPosition - currentPosition / 8)
  }
}

button.addEventListener('click', scrollToTop)

// 

document.getElementById('submitFormButton').addEventListener('click', function(event) {
  event.preventDefault(); // Переместили сюда
  var xhr = new XMLHttpRequest();
  var formData = new FormData(document.getElementById('contactForm'));

  if (validateForm()) {
  xhr.open('POST', 'https://legalgroup.by/sendmail.php', true);
  xhr.onreadystatechange = function() {
      if (xhr.readyState == 4 && xhr.status == 200) {
          onFormSuccess()
          clearForm()
      } else if (xhr.readyState == 4) {
          alert('Ошибка при отправке сообщения.');
          console.log(xhr)
      }
  };
  xhr.send(formData);
}
});

function onFormSuccess () {
  const button = document.getElementById('submitFormButton')
  button.classList.add('success')
  button.innerText = 'Данные отправлены'

}

function clearForm() {
  // Получаем форму по её идентификатору
  var form = document.getElementById('contactForm');

  // Находим все элементы input в форме
  var inputs = form.querySelectorAll('input');
  // Проходим по каждому элементу input и очищаем его
  inputs.forEach(function(input) {
      // Очищаем только текстовые поля, поля электронной почты и телефона
      if(input.type == 'text' || input.type == 'email' || input.type == 'tel') {
          input.value = '';
      }
  });

  // Находим все элементы textarea в форме
  var textareas = form.querySelectorAll('textarea');
  // Проходим по каждому элементу textarea и очищаем его
  textareas.forEach(function(textarea) {
      textarea.value = '';
  });
}

// Функция для установки визуального отображения ошибки
function setError(input) {
  input.style.borderBottom = '1px solid red'; // установить красное подчеркивание
}

// Функция для сброса визуального отображения ошибки
function clearError(input) {
  input.style.border = ''; // Убрать красное подчеркивание
}

// Функция валидации полей
function validateForm() {
  var name = document.querySelector('input[name="name"]');
  var email = document.querySelector('input[name="email"]');
  var phone = document.querySelector('input[name="phone"]');
  var isValid = true;

  // Сбросить предыдущие ошибки
  [name, email].forEach(clearError);

  // Проверка имени
  if (!name.value.trim()) {
      setError(name);
      isValid = false;
  }

  // Проверка email
  if (!email.value.trim()) {
      setError(email);
      isValid = false;
  }

  if (!name.value.trim()) {
    setError(phone);
    isValid = false;
}

  // Если форма невалидна, показываем сообщение
  if (!isValid) {
  }
  return isValid;
}

// Обработчик события клика для кнопки отправки
document.getElementById('submitFormButton').addEventListener('click', function(event) {
  event.preventDefault(); // Предотвратите стандартное поведение формы

  // Вызов функции валидации
  if (validateForm()) {
      // Если валидация прошла успешно, продолжаем отправку формы
      // document.getElementById('contactForm').submit();
  }
});


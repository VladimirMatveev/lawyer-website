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

document.getElementById('submitFormButton').addEventListener('click', function() {
  event.preventDefault(); // Переместили сюда
  var xhr = new XMLHttpRequest();
  var formData = new FormData(document.getElementById('contactForm'));


  xhr.open('POST', 'https://legalgroup.by/sendmail.php', true);
  xhr.onreadystatechange = function() {
      if (xhr.readyState == 4 && xhr.status == 200) {
          onFormSuccess()
      } else if (xhr.readyState == 4) {
          alert('Ошибка при отправке сообщения.');
      }
  };
  xhr.send(formData);
});

function onFormSuccess () {
  const button = document.getElementById('submitFormButton')
  button.classList.add('success')
  button.innerText = 'Данные отправлены'
}
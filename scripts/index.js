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
  var xhr = new XMLHttpRequest();
  var formData = new FormData(document.getElementById('contactForm'));

  xhr.open('POST', '/sendmail.php', true);
  xhr.onreadystatechange = function() {
      if (xhr.readyState == 4 && xhr.status == 200) {
          alert('Сообщение отправлено: ' + xhr.responseText);
      } else if (xhr.readyState == 4) {
          alert('Ошибка при отправке сообщения.');
      }
  };
  xhr.send(formData);
});

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

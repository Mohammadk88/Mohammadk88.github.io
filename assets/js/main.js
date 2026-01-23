const yearEl = document.getElementById('year');
if (yearEl) yearEl.textContent = new Date().getFullYear();

const burger = document.getElementById('burger');
const menu = document.querySelector('.menu');

if (burger && menu) {
  burger.addEventListener('click', () => menu.classList.toggle('open'));
}

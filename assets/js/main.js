(() => {
  const year = document.getElementById("year");
  if (year) year.textContent = new Date().getFullYear();

  const burger = document.getElementById("burger");
  const nav = document.getElementById("nav");

  if (burger && nav) {
    burger.addEventListener("click", () => {
      const isOpen = nav.classList.toggle("is-open");
      burger.setAttribute("aria-expanded", isOpen ? "true" : "false");
    });

    // close menu after clicking a link (mobile)
    nav.querySelectorAll("a").forEach(a => {
      a.addEventListener("click", () => {
        nav.classList.remove("is-open");
        burger.setAttribute("aria-expanded", "false");
      });
    });
  }
})();

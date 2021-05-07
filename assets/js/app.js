window.addEventListener("scroll", (e) => {
  const scrollY = window.scrollY;
  document.querySelector("#logo").hidden = window.scrollY > 100 ? true : false;
});

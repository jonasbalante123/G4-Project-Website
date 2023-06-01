const observer = new MutationObserver((mutations) => {
  mutations.forEach((mutation) => {
    if (mutation.attributeName === "data-theme-switcher") {
      const theme = document.querySelector(".header-image").dataset.themeSwitcher;
      if (theme === "light") {
        document.querySelector(".header-image").style.backgroundColor = "#E0E0E0";
      } else {
        document.querySelector(".header-image").style.backgroundColor = "#000000";
      }
    }
  });
});

observer.observe(document.querySelector(".header-image"), { attributes: true });

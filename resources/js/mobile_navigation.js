function showMenu(isVisible){
  const mobileNavElement = document.getElementById("mobile-nav-layout");
  if (isVisible){
    mobileNavElement.classList.remove("hidden");
  } else {
    mobileNavElement.classList.add("hidden");
  }
}

window.showMenu = showMenu;
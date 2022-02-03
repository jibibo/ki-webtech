function removeCartItems() {
  document.cookie = "cart=";
  console.debug("updated", getCookie());
}

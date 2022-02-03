function removeCartItems() {
  // clear cookie
  document.cookie = "cart=";
  // refresh the page
  location.reload();
}

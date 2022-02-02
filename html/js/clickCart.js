function clickCart(id) {
  let oldCookie = getCookie();
  console.debug(oldCookie);
  if (oldCookie) {
    document.cookie = "cart=" + oldCookie + "|" + id;
  } else {
    document.cookie = "cart=" + id;
  }
  console.debug("updated", getCookie())
}

// from: https://www.w3schools.com/js/js_cookies.asp
function getCookie() {
  let name = "cart=";
  let decodedCookie = decodeURIComponent(document.cookie);
  let splitCookie = decodedCookie.split(";");
  for (let i = 0; i < splitCookie.length; i++) {
    let singleCookie = splitCookie[i];
    while (singleCookie.charAt(0) == " ") {
      singleCookie = singleCookie.substring(1);
    }
    if (singleCookie.indexOf(name) == 0) {
      return singleCookie.substring(name.length);
    }
  }

  return "";
}

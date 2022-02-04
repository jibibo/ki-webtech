function clickCart(id) {
  let oldCookie = getCookie();

  // if previous cookie is set, append
  if (oldCookie) {
    document.cookie = "cart=" + oldCookie + "|" + id;
  } else {
    // set new cookie as it didn t exist yet
    document.cookie = "cart=" + id;
  }

  updateNavbar();
}

// from: https://www.w3schools.com/js/js_cookies.asp
function getCookie() {
  let name = "cart=";
  let decodedCookie = decodeURIComponent(document.cookie);
  let splitCookie = decodedCookie.split(";");

  // iterate over cookie string to find our desired cookie
  for (let i = 0; i < splitCookie.length; i++) {
    let singleCookie = splitCookie[i];

    // remove whitespaces
    while (singleCookie.charAt(0) == " ") {
      singleCookie = singleCookie.substring(1);
    }

    // check if the current cookie's name is the one we want
    if (singleCookie.indexOf(name) == 0) {
      return singleCookie.substring(name.length);
    }
  }

  // cookie not found
  return "";
}

function updateNavbar() {
  // get the target element
  let aTag = document.getElementById("navbar-checkout");
  let splitCookie = getCookie().split("|");
  let count = splitCookie.length;

  // update the inner content of the element, the part the user sees
  if (count === 1 && splitCookie[0] === "") {
    aTag.innerHTML = "Checkout (0)";
  } else {
    aTag.innerHTML = "Checkout (" + count + ")";
  }
}

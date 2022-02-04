import updateNavbar from "./updateNavbar";

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
    while (singleCookie.charAt(0) == " ") {
      singleCookie = singleCookie.substring(1);
    }
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

  if (count === 1 && splitCookie[0] === "") {
    aTag.innerHTML = "Checkout (0)";
  } else {
    aTag.innerHTML = "Checkout (" + count + ")";
  }
}

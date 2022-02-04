// apply class to the selected nav link for proper color
// src: https://stackoverflow.com/a/20060541/13216113

$(document).ready(() => {
  let pathname = location.pathname;

  // iterate over each a element in the navigation menu
  $("#nav-ul li a").each((_i, el) => {
    // if the url contains parameters, dont make it active
    if (el.href.indexOf("?") !== -1) return;

    // if the current path is like this link, make it active
    if (
      (pathname !== "/" && el.href.indexOf(pathname) !== -1) ||
      (pathname === "/index.php" && el.href.endsWith("/")) ||
      (pathname === "/" && el.href.endsWith("/"))
    ) {
      // add the "active" class
      $(el).addClass("active");
    }
  });
});

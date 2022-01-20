// apply class to the selected nav link for proper color
// src: https://stackoverflow.com/a/20060541/13216113

$(document).ready(() => {
  let pathname = location.pathname;
  console.debug(pathname);
  $("#nav-ul li a").each((_i, el) => {
    if (el.href.indexOf("?") !== -1) return;

    console.debug("iterating navbar", el);
    // if the current path is like this link, make it active
    if (
      (pathname !== "/" && el.href.indexOf(pathname) !== -1) ||
      (pathname === "/" && el.href.indexOf("index.php") !== -1)
    ) {
      $(el).addClass("active");
      console.debug("added .active", el);
    }
  });
});

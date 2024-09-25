window.onscroll = function () {
  var currentScrollPos = window.pageYOffset;
  if (35 < currentScrollPos) {
    document.getElementById("navbar").style.visibility = "hidden";
  } else {
    document.getElementById("navbar").style.top = "35";
    document.getElementById("navbar").style.visibility = "visible";
  }
};

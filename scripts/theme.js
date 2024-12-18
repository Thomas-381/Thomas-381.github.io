$(document).ready(function () {
  $("html").show();

  $("*[id='mode-dark']").show();
  $("*[id='mode-light']").hide();

  $("#switch-mode").click(function () {
      $("*[id='mode-dark']").toggle();
      $("*[id='mode-light']").toggle();

      if (document.documentElement.getAttribute('data-theme') == 'dark') {
          document.documentElement.setAttribute('data-theme', 'light');
          $("#mode").removeAttr("src").attr("src", "light.png");
      } else {
          document.documentElement.setAttribute('data-theme', 'dark');
          $("#mode").removeAttr("src").attr("src", "dark.png");
      }
  });
});
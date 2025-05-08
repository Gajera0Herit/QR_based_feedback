$(function () {
  if (screen.width <= 768) {
    document.querySelector("body").style.display = "none";
    document.querySelector("body").innerHTML = "Cannot open in mobile devices";
  }

  $(".kt-logo").click(() => {
    location.href = "index.php";
  });

  $('input[name="branch"]').click(function () {
    if (this.id == "mca") {
      $("#third").parent().hide("slow");
      $("#fourth").parent().hide("slow");
    } else {
      $("#third").parent().show("slow");
      $("#fourth").parent().show("slow");
    }
  });
});


document.querySelector(".full_year").addEventListener("click", function() {
  var div = document.querySelector(".view_full_year");
  div.style.display = div.style.display == "none" ? "block" : "none";

  var button = document.querySelector(".full_year");
  button.innerHTML =
    div.style.display == "none" ? "Ver agenda anual &dArr;" : "diminuir 	&uArr;";
});

$(document).ready(function() {
  $(".check-all").click(function(event) {
    if (this.checked) {
      $(".check-target").each(function() {
        this.checked = true;
      });
    } else {
      $(".check-target").each(function() {
        this.checked = false;
      });
    }
  });
});
ClassicEditor
.create(document.querySelector('#edit_not_description'))
.catch(error => {
    console.error(error);
});
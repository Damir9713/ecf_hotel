$(document).ready(function () {
  $("#establishment").on("change", function () {
    let id = $(this).val();
    if (id) {
      $.ajax({
        type: "POST",
        url: "ajax.php",
        data: "id=" + id,
        success: function (html) {
          $("#suite").html(html);
        },
      });
    }
  });

  $("#disponibility").click(function () {
    let debut = $("#debut").val();
    let fin = $("#fin").val();
    let suite_id = $("#suite").val();
    if (debut != "" && fin != "") {
      $.ajax({
        url: "ajax.php",
        method: "POST",
        data: { debut: debut, fin: fin, suite_id: suite_id },
        success: function (data) {
          $(".modal-body").html(data);
          $("#exampleModal").modal("show");
        },
      });
    } else {
      alert("Choisissez une date et une suite d'abord");
    }
  });
});

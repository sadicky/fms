function refreshPage() {
  location.reload();
}

$(document).ready(function () {

  $("#formulaire_bank").submit(function (event) {
    event.preventDefault();
    $.ajax({
      url: "Public/script/addbank.php",
      method: "POST",
      type: "post",
      data: $("#formulaire_bank").serialize(),
      success: function (data) {
        $('#message').html(data).slideDown();
        $("#formulaire_bank")[0].reset();
        setInterval(refreshPage, 1000);
      }
    });
  });

  $("#formulaire-dep").submit(function (event) {
    event.preventDefault();
    $.ajax({
      url: "Public/script/adddep.php",
      method: "POST",
      type: "post",
      data: $("#formulaire-dep").serialize(),
      success: function (data) {
        $('#messages').html(data).slideDown();
        $("#formulaire-dep")[0].reset();
        $('#add-dep').modal("hide");
        setInterval(refreshPage, 2000);
      }
    });
  });

  $("#formulaire-payer").submit(function (event) {
    event.preventDefault();
    $.ajax({
      url: "Public/script/payer.php",
      method: "POST",
      type: "post",
      data: $("#formulaire-payer").serialize(),
      success: function (data) {
        $('#messages').html(data).slideDown();
        $("#formulaire-payer")[0].reset();
        $('#payer').modal("hide");
        setInterval(refreshPage, 1000);
      }
    });
  });

  $(document).on("click", ".delete-bank", function (event) {
    event.preventDefault();
    var id = $(this).attr("id");
    if (confirm("Voulez-vous supprimer? ")) {
      $.ajax({
        url: "Public/script/deletedevise.php",
        method: "POST",
        data: {
          id: id
        },
        success: function (data) {
          $('#message').html(data).slideDown();
          setInterval(refreshPage, 1000);
        }
      });
    } else {
      return false;
    }
  });


  $('.view_bank').click(function () {
    var id = $(this).attr("id");
    $.ajax({
      url: "Public/script/viewbankbeforedit.php",
      method: "post",
      data: {
        id: id
      },
      success: function (data) {
        $('#bank_detail').html(data);
        $('#Artbank').modal("show");
      }
    });
  });
  //
  $(document).on('click', '.edit-bank', function () {
    $.ajax({
      url: "Public/script/editbank.php",
      type: "post",
      data: $("#formeditbank").serialize(),
      success: function (data) {
        $("#Artbank").modal('hide');
        $("#message").html(data).slideDown();
        setInterval(refreshPage, 1000);
      }

    });
    return false;
  });


  //   $("#checkAll").click(function() {
  //    $("input[type=checkbox]").prop('checked', $(this).prop('checked'));
  // });

  $("#selectAll").click(function () {
    $("input[type=checkbox]").prop("checked", $(this).prop("checked"));
    if ("checked" in $(this).prop("checked")) {

    }
  });

  $("input[type=checkbox]").click(function () {
    if (!$(this).prop("checked")) {
      $("#selectAll").prop("checked", false);
    }
  });

  //recharger cette fonction toute les secondes
  // setInterval(1000);

});
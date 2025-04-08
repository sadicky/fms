function refreshPage() {
  location.reload();
}

$(document).ready(function () {

  $("#formulaire_devise").submit(function (event) {
    event.preventDefault();
    $.ajax({
      url: "Public/script/adddevise.php",
      method: "POST",
      type: "post",
      data: $("#formulaire_devise").serialize(),
      success: function (data) {
        $('#message').html(data).slideDown();
        $("#formulaire_devise")[0].reset();
        setInterval(refreshPage, 1000);
      }
    });
  });

  $(document).on("click", ".delete-devise", function (event) {
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
          // setInterval(refreshPage, 1000);
        }
      });
    } else {
      return false;
    }
  });


  $('.view_devise').click(function () {
    var id = $(this).attr("id");
    $.ajax({
      url: "Public/script/viewdevisebeforedit.php",
      method: "post",
      data: {
        id: id
      },
      success: function (data) {
        $('#devise_detail').html(data);
        $('#Artdevise').modal("show");
      }
    });
  });
  //
  $(document).on('click', '.submitarticle', function () {
    $.ajax({
      url: "Public/script/editdevise.php",
      type: "post",
      data: $("#formeditart").serialize(),
      success: function (data) {
        $("#artModal").modal('hide');
        $("#message").html(data).slideDown();
        setInterval(refreshPage, 1000);
      }

    });
    return false;
  });

  $("#resultatdev").hide();
  $(".devises-change").change(function () {
    var devise = $(this).val();
    if (devise) {
      $.ajax({
        type: 'POST',
        url: 'Public/script/sommedev.php',
        data: {
          devise: devise
        },
        success: function (d) {
          $('#resultatdev').html(d).slideDown();
        }

      });
    }
  });


  //recharger cette fonction toute les secondes
  // setInterval(1000);

});
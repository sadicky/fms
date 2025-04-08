function refreshPage() {
  location.reload();
}


$(document).ready(function () {
    // getclientegories();
    $("#formulaire").submit(function (event) {
        event.preventDefault();
        $.ajax({
            url: "Public/script/adduser.php",
            method: "POST",
            type:"post",
            data:$("#formulaire").serialize(),
            success: function (data) {
                $('#message').html(data).slideDown();
                setInterval(refreshPage, 1000);
                $("#formulaire")[0].reset();
                $("#add-user").modal("hide");
            }
        });
    });

    
       
    $(document).on("click", ".delete-user", function (event) {
        event.preventDefault();
          var id = $(this).attr("id");
          if (confirm("Voulez-vous supprimer? ")) {
            $.ajax({
              url: "Public/script/deleteuser.php",
              method: "POST",
              data: {
                id: id
              },
              success: function (data) {}
            });
          } else {
            return false;
          }
        });

        $('.view_dette').click(function() {
          var id = $(this).attr("id");
          $.ajax({
            url: "Public/script/viewdettebeforedit.php",
            method: "post",
            data: {
              id: id
            },
            success: function(data) {
              $('#paiement_detail').html(data);
              $('#edit-paiement').modal("show");
            }
          });
        });
        //
        $(document).on('click', '.submit', function() {
          $.ajax({ 
            url: "Public/script/dette.php",
            type: "post",
            data: $("#formeditdette").serialize(),
            success: function(data) {
              $("#messages").html(data).slideDown();
              $("#edit-paiement").modal('hide');
              setInterval(refreshPage, 1000);
              
            }
    
          });
          return false;
        });

        $("#formulaire_profile").submit(function (event) {
          event.preventDefault();
          $.ajax({
              url: "Public/script/editprofile.php",
              method: "POST",
              type: "post",
              data: $("#formulaire_profile").serialize(),
              success: function (data) {
                  $('#message').html(data).slideDown();
                  $("#formulaire_profile")[0].reset();
                  // setInterval(refreshPage, 1000);
              }
          });
      });
  

});
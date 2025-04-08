function refreshPage() {
    location.reload();
  }
  
$(document).ready(function () {

    $("#formulaire_tiers").submit(function (event) {
        event.preventDefault();
        $.ajax({
            url: "Public/script/addtiers.php",
            method: "POST",
            type: "post",
            data: $("#formulaire_tiers").serialize(),
            success: function (data) {
                $('#message').html(data).slideDown();
                $("#formulaire_tiers")[0].reset();
                setInterval(refreshPage, 1000);
            }
        });
    });

    $(document).on("click", ".delete-tiers", function(event) {
        event.preventDefault();
        var id = $(this).attr("id");
        if (confirm("Voulez-vous supprimer? ")) {
          $.ajax({
            url: "Public/script/deletetiers.php",
            method: "POST",
            data: {
              id: id
            },
            success: function(data) {            
              $('#message').html(data).slideDown();
              setInterval(refreshPage, 1000);
            }
          });
        } else {
          return false;
        }
      });

      
      $('.view_data').click(function() {
        var Id = $(this).attr("id");
        $.ajax({
            url: "Public/script/viewtiersbeforedit.php",
            method: "post",
            data: {
                Id: Id
            },
            success: function(data) {
                $('#art_detail').html(data);
                $('#artModal').modal("show");
            }
        });
    });
    //
    $(document).on('click', '.submitarticle', function() {
        $.ajax({
            url: "Public/script/edittiers.php",
            type: "post",
            data: $("#formeditart").serialize(),
            success: function(data) {
                $("#artModal").modal('hide');
                $("#messages").html(data).slideDown();
                 setInterval(refreshPage, 1000);
            }

        });
        return false;
    });


    //recharger cette fonction toute les secondes
    // setInterval(1000);

});
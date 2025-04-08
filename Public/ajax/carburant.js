function refreshPage() {
  location.reload();
}

$(document).ready(function () {
    // getclientegories();
    $("#formulaire").submit(function (event) {
        event.preventDefault();
        $.ajax({
            url: "Public/script/addorder.php",
            method: "POST",
            type:"post",
            data:$("#formulaire").serialize(),
            success: function (data) {
                $('#message').html(data).slideDown();
                $("#formulaire")[0].reset();
                setInterval(refreshPage, 1000);
            }
        });
    });


    $("#formulaire-livraison").submit(function (event) {
      event.preventDefault();
      $.ajax({
          url: "Public/script/addorder.php",
          method: "POST",
          type:"post",
          data:$("#formulaire-livraison").serialize(),
          success: function (data) {
              $('#message').html(data).slideDown();
              $("#formulaire-livraison")[0].reset();
              $("#add-order").modal('hide');
              setInterval(refreshPage, 1000);
          }
      });
  });

  

  $("#formulaire-pompe").submit(function (event) {
    event.preventDefault();
    $.ajax({
        url: "Public/script/addpompe.php",
        method: "POST",
        type:"post",
        data:$("#formulaire-pompe").serialize(),
        success: function (data) {
            $('#message').html(data).slideDown();
            $("#formulaire-pompe")[0].reset();
            $("#add-pompe").modal('hide');
            setInterval(refreshPage, 1000);
        }
    });
});
  
  $(".carburant-change").change(function(){	 
    var carburant = $(this).val();
     if(carburant){
         $.ajax({
             type:'POST',
             url:'Public/script/qtedispo.php',
             data:{
              carburant:carburant
             },
             success:function(d){
                 $('#resultat').html(d).slideDown();
             }

         });
     }
 });

 
 $(".pompe-change").change(function(){	 
  var pompe = $(this).val();
   if(pompe){
       $.ajax({
           type:'POST',
           url:'Public/script/pompeindex.php',
           data:{
            pompe:pompe
           },
           success:function(d){
               $('#resultat').html(d).slideDown();
           }

       });
   }
});

$('.carburant').on('change',function(){
  let carburant = $(this).val();
  if(carburant){
      $.ajax({
          type:'POST',
          url:'Public/script/join2.php',
          data:'carburant='+carburant,
          success:function(d){
              $('#pompe').html(d);
          }

      });
  }
});
 
    $(document).on("click", ".delete-carburant", function (event) {
        event.preventDefault();
          var id = $(this).attr("id");
          if (confirm("Voulez-vous supprimer? ")) {
            $.ajax({
              url: "Public/script/deletetech.php",
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
        
       
        $("#formulaire-prix").submit(function () {
          $.ajax({
            url: "Public/script/prix.php",
            method: "POST",
            type: "POST",
            data:$("#formulaire-prix").serialize(),
            success: function (data) {
              $("#edit-prix").modal('hide');
              setInterval(refreshPage, 500);
            }
          });
          return false;
      });


    function redirect(){
        window.location.href='index.php?p=orders'
    }

});
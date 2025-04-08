$(document).ready(function () {

    $('#carburant').on('change',function(){
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



});
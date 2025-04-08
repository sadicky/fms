function refreshPage() {
    location.reload();
}


$(document).ready(function () {

    $("#formulaire-staff").submit(function (event) {
        event.preventDefault();
        $.ajax({
            url: "Public/script/addstaff.php",
            method: "POST",
            type: "post",
            data: $("#formulaire-staff").serialize(),
            success: function (data) {
                $('#message').html(data).slideDown();
                $("#formulaire-staff")[0].reset();
                $("#add-staff").modal("hide");
                setInterval(refreshPage, 1000);
            }
        });
    });

    $("#formulaire-salaire-add").submit(function (event) {
        event.preventDefault();
        $.ajax({
            url: "Public/script/addsalstaff.php",
            method: "POST",
            type: "post",
            data: $("#formulaire-salaire-add").serialize(),
            success: function (data) {
                $('#message').html(data).slideDown();
                $("#formulaire-salaire-add")[0].reset();
                $("#add-salaire").modal("hide");
                setInterval(refreshPage, 1000);
            }
        });
    });

    $(document).on("click", ".delete-staff", function (event) {
        event.preventDefault();
        var id = $(this).attr("id");
        if (confirm("Voulez-vous supprimer? ")) {
            $.ajax({
                url: "Public/script/deletestaff.php",
                method: "POST",
                data: {
                    id: id
                },
                success: function (data) {
                    $('#messages').html(data).slideDown();
                    setInterval(refreshPage, 1000);
                }
            });
        } else {
            return false;
        }
    });

  
});

  $(document).ready(function() {

      // create order form function
      $("#createOrderForm").unbind('submit').bind('submit', function() {
        var form = $(this);
        $('.form-group').removeClass('has-error').removeClass('has-success');
        $('.text-danger').remove();

        var orderDate = $("#datev").val();
        var client = $("#client").val();
        var paid = $("#paid").val();
        var devise = $("#devise").val();
        var typev = $("#typev").val();

        // form validation 
        if (orderDate == "") {
          alert(' Date de vente innexistante');
        } else {
          $('#orderDate').closest('.form-group').addClass('has-success');
        } // /else

        if (client == "") {
          alert(' Le nom du client est obligatoire');
        } else {
          $('#client').closest('.form-group').addClass('has-success');
        } // /else

        if (devise == "") {
          alert(' La Devise est obligatoire');
        } else {
          $('#devise').closest('.form-group').addClass('has-success');
        } // /else

        if (paid == "") {
          alert('Ce Champ est obligatoire');
        } else {
          $('#paid').closest('.form-group').addClass('has-success');
        } // /else
        


        // array validation
        var carburant = document.getElementsByName('carburant[]');
        var validateProduct;
        for (var x = 0; x < carburant.length; x++) {
          var carburantId = carburant[x].id;
          if (carburant[x].value == '') {
            $("#" + carburantId + "").after('<p class="text-danger"> Le produit est obligatoire!! </p>');
            $("#" + carburantId + "").closest('.form-group').addClass('has-error');
          } else {
            $("#" + carburantId + "").closest('.form-group').addClass('has-success');
          }
        } // for

        for (var x = 0; x < carburant.length; x++) {
          if (carburant[x].value) {
            validateProduct = true;
          } else {
            validateProduct = false;
          }
        } // for       		   	

        var qte = document.getElementsByName('qte[]');
        var validateqte;
        for (var x = 0; x < qte.length; x++) {
          var qteId = qte[x].id;
          if (qte[x].value == '') {
            $("#" + qteId + "").after('<p class="text-danger">La quantité est obligatoire!! </p>');
            $("#" + qteId + "").closest('.form-group').addClass('has-error');
          } else {
            $("#" + qteId + "").closest('.form-group').addClass('has-success');
          }
        } // for

        for (var x = 0; x < qte.length; x++) {
          if (qte[x].value) {
            validateqte = true;
          } else {
            validateqte = false;
          }
        } // for       	


        if (orderDate && client && paid && paymentType && paymentStatus) {
          if (validateProduct == true && validateqte == true) {
            // create order button
            $("#createOrderBtn").button('loading');

            $.ajax({
              url: form.attr('action'),
              type: form.attr('method'),
              data: form.serialize(),
              dataType: 'json',
              success: function(response) {
                $("#createOrderBtn").button('reset');

                $(".text-danger").remove();
                $('.form-group').removeClass('has-error').removeClass('has-success');

                if (response.success == true) {

                  // create order button
                  $(".success-messages").html('<div class="alert alert-success">' +
                    '<button type="button" class="close" data-dismiss="alert">&times;</button>' +
                    '<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> ' + response.messages +
                    ' <br /> <br /> <a type="button" onclick="printOrder(' + response.order_id + ')" class="btn btn-primary"> <i class="glyphicon glyphicon-print"></i> Print </a>' +
                    '<a href="index.php?page=order&o=add" class="btn btn-default" style="margin-left:10px;"> <i class="glyphicon glyphicon-plus-sign"></i> Add New Order </a>' +
                    '</div>');

                  $("html, body, div.panel, div.pane-body").animate({
                    scrollTop: '0px'
                  }, 100);

                  // disabled te modal footer button
                  $(".submitButtonFooter").addClass('div-hide');
                  // remove the product row
                  $(".removeProductRowBtn").addClass('div-hide');

                } else {
                  alert(response.messages);
                }
              } // /response
            }); // /ajax
          } // if array validate is true
        } // /if field validate is true


        return false;
      }); // /create order form function	


  });


  // print order function
  function printOrder(orderId = null) {
    if (orderId) {

      $.ajax({
        url: 'Public/script/print.php',
        type: 'post',
        data: {
          orderId: orderId
        },
        dataType: 'text',
        success: function(response) {

          var mywindow = window.open('', 'Facture', 'height=400,width=600');
          mywindow.document.write('<html><head><title>Facture</title>');
          mywindow.document.write('</head><body>');
          mywindow.document.write(response);
          mywindow.document.write('</body></html>');

          mywindow.document.close(); // necessary for IE >= 10
          mywindow.focus(); // necessary for IE >= 10
          mywindow.resizeTo(screen.width, screen.height);
          setTimeout(function() {
            mywindow.print();
            mywindow.close();
          }, 1250);

          //mywindow.print();
          //mywindow.close();

        } // /success function
      }); // /ajax function to fetch the printable order
    } // /if orderId
  } // /print order function

  // select on product data
  function getProductData(row = null) {

    if (row) {
      var productId = $("#carburant" + row).val();

      if (productId == "") {
        $("#rate" + row).val("");

        $("#qte" + row).val("");
        $("#total" + row).val("");

      } else {
        $.ajax({
          url: 'Public/script/fetchSelectedProduct.php',
          type: 'post',
          data: {
            productId: productId
          },
          dataType: 'json',
          success: function(data) {

            $("#rate" + row).val(data['prix']);
            $("#rateValue" + row).val(data['prix']);

            $("#qte" + row).val(1);
            $("#stockD" + row).text(data['qty']);

            var total = Number(data['prix']) * 1;
            total = total.toFixed(2);
            $("#total" + row).val(total);
            $("#totalValue" + row).val(total);
            // console.log(total);
            subAmount();
          } // /success
        }); // /ajax function to fetch the product data	
      }

    } else {
      alert('no row! please refresh the page');
    }
  } // /select on product data

  // table total
  function getTotal(row = null) {
    if (row) {
      var total = Number($("#rate" + row).val()) * Number($("#qte" + row).val());
      total = total.toFixed(2);
      $("#total" + row).val(total);
      $("#totalValue" + row).val(total);

      subAmount();

    } else {
      alert('no row !! please refresh the page');
    }
  }

  function subAmount() {
    var tableProductLength = $("#productTable tbody tr").length;
    var totalAmount = 0;
    for (x = 0; x < tableProductLength; x++) {
      var tr = $("#productTable tbody tr")[x];
      var count = $(tr).attr('id');
      count = count.substring(3);
      // console.log(count);
      totalAmount = Number(totalAmount) + Number($("#total" + count).val());
    } // /for

    totalAmount = totalAmount.toFixed(2);
    $("#totalAmount").val(totalAmount);
    $("#totalAmountValue").val(totalAmount);

    // console.log(totalAmount);

    var paidAmount = $("#paid").val();
    if (paidAmount) {
      paidAmount = Number($("#totalAmount").val()) - Number(paidAmount);
      paidAmount = paidAmount.toFixed(2);

      console.log(paidAmount);
      $("#due").val(paidAmount);
      $("#dueValue").val(paidAmount);
    } else {
      $("#due").val($("#totalAmount").val());
      $("#dueValue").val($("#totalAmount").val());
    } // else

  } // /sub total amount


  var paid = $("#paid").val();

  var dueAmount;
  if (paid) {
    dueAmount = Number($("#totalAmount").val()) - Number($("#paid").val());
    dueAmount = dueAmount.toFixed(2);

    $("#due").val(dueAmount);
    $("#dueValue").val(dueAmount);
  } else {
    $("#due").val($("#totalAmount").val());
    $("#dueValue").val($("#totalAmount").val());
  }

  // } // /discount function

  function paidAmount() {
    var grandTotal = $("#totalAmount").val();

    if (grandTotal) {
      var dueAmount = Number($("#totalAmount").val()) - Number($("#paid").val());
      dueAmount = dueAmount.toFixed(2);
      $("#due").val(dueAmount);
      $("#dueValue").val(dueAmount);
    } // /if
  } // /paid amoutn function

  // remove order from server
  function removeOrder(orderId = null) {
    if (orderId) {
      $("#removeOrderBtn").unbind('click').bind('click', function() {
        $("#removeOrderBtn").button('loading');

        $.ajax({
          url: 'Public/script/removeOrder.php',
          type: 'post',
          data: {
            orderId: orderId
          },
          dataType: 'json',
          success: function(response) {
            $("#removeOrderBtn").button('reset');

            if (response.success == true) {

              manageOrderTable.ajax.reload(null, false);
              // hide modal
              $("#removeOrderModal").modal('hide');
              // success messages
              $("#success-messages").html('<div class="alert alert-success">' +
                '<button type="button" class="close" data-dismiss="alert">&times;</button>' +
                '<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> ' + response.messages +
                '</div>');

              // remove the mesages
              $(".alert-success").delay(500).show(10, function() {
                $(this).delay(3000).hide(10, function() {
                  $(this).remove();
                });
              }); // /.alert	          

            } else {
              // error messages
              $(".removeOrderMessages").html('<div class="alert alert-warning">' +
                '<button type="button" class="close" data-dismiss="alert">&times;</button>' +
                '<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> ' + response.messages +
                '</div>');

              // remove the mesages
              $(".alert-success").delay(500).show(10, function() {
                $(this).delay(3000).hide(10, function() {
                  $(this).remove();
                });
              }); // /.alert	          
            } // /else

          } // /success
        }); // /ajax function to remove the order

      }); // /remove order button clicked


    } else {
      alert('error! refresh the page again');
    }
  }
  // /remove order from server

 

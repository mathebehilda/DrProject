$(function() {

    $("#brooklynForm input, #brooklynForm textarea").jqBootstrapValidation({
      preventSubmit: true,
      submitError: function($form, event, errors) {
        // additional error messages or events
      },
      submitSuccess: function($form, event) {
        event.preventDefault(); // prevent default submit behaviour
        // get values from FORM
        var numOfShops = $("input#numOfShops").val();
        var shop1 = $("input#shop1").val();
        var items1 = $("textarea#items1").val();
        var shop2 = $("input#shop2").val();
        var items2 = $("textarea#items2").val();
        var shop3 = $("input#shop3").val();
        var items3 = $("textarea#items3").val();
        var shop4 = $("input#shop4").val();
        var items4 = $("textarea#items4").val();
        var shop5 = $("input#shop5").val();
        var items5 = $("textarea#items5").val();
        var shop6 = $("input#shop6").val();
        var items6 = $("textarea#items6").val();
        var shop7 = $("input#shop7").val();
        var items7 = $("textarea#items7").val();
        var shop8 = $("input#shop8").val();
        var items8 = $("textarea#items8").val();
        var shop9 = $("input#shop9").val();
        var items9 = $("textarea#items9").val();
        var cnumber = $("input#cnumber").val();
  
        $('.loading').show();
        $this = $("#orderButton");
        $this.prop("disabled", true); // Disable submit button until AJAX call is complete to prevent duplicate messages
        $.ajax({
          url: "../services/malls/brooklyn.php",
          type: "POST",
          data: {
            numOfShops: numOfShops,
            shop1: shop1,
            items1: items1,
            shop2: shop2,
            items2: items2,
            shop3: shop3,
            items3: items3,
            shop4: shop4,
            items4: items4,
            shop5: shop5,
            items5: items5,
            shop6: shop6,
            items6: items6,
            shop7: shop7,
            items7: items7,
            shop8: shop8,
            items8: items8,
            shop9: shop9,
            items9: items9,
            cnumber: cnumber
          },
          cache: false,
          success: function() {
            // Success message
            $('#success2').html("<div class='alert alert-success'>");
            $('#success2 > .alert-success').html("<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;")
              .append("</button>");
            $('#success2 > .alert-success')
              .append("<strong>Order made successfully. Please wait for an SMS with the full details for your order. This may take over an hour depending on the amount of orders we are handling at the moment. </strong>");
            $('#success2 > .alert-success')
              .append('</div>');
            //clear all fields
            $('#brooklynForm').trigger("reset");
            $('#orderButton').html('Thank You');
            $('.loading').fadeOut('slow');
          },
          error: function() {
            // Fail message
            $('#success2').html("<div class='alert alert-danger'>");
            $('#success2 > .alert-danger').html("<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;")
              .append("</button>");
            $('#success2 > .alert-danger').append($("<strong>").text("Sorry vv, it seems that our server is not responding. Please try again later!"));
            $('#success2 > .alert-danger').append('</div>');
            //clear all fields
            $('#brooklynForm').trigger("reset");
            $('.loading').fadeOut('slow');
          },
          complete: function() {
            setTimeout(function() {
              $this.prop("disabled", false); // Re-enable submit button when AJAX call is complete
            }, 1000);
          }
        });
      },
      filter: function() {
        return $(this).is(":visible");
      },
    });
  
  
    $("a[data-toggle=\"tab\"]").click(function(e) {
      e.preventDefault();
      $(this).tab("show");
    });
  });
  
  /*When clicking on Full hide fail/success boxes */
  $('#name').focus(function() {
    $('#success').html('');
  });
  
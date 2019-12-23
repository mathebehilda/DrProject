$(function() {

    //Confirm Order
    $("#conForm input").jqBootstrapValidation({
      preventSubmit: true,
      submitError: function($form, event, errors) {
        // additional error messages or events
      },
      submitSuccess: function($form, event) {
        event.preventDefault(); // prevent default submit behaviour
        // get values from FORM
        var onumber = $("input#onumber").val();
        var pmeth = $("input#pmethv").val();
        //var myurl = window.location.href;
  
        $this = $("#conButton");
        $this.prop("disabled", true); // Disable submit button until AJAX call is complete to prevent duplicate messages
        $.ajax({
          url: "../services/conorder.php",
          type: "POST",
          data: {
            onumber: onumber,
            pmeth: pmeth
          },
          cache: false,
          success: function() {
            // Success message
            $('#success3').html("<div class='alert alert-success'>");
            $('#success3 > .alert-success').html("<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;")
              .append("</button>");
            $('#success3 > .alert-success')
              .append("<strong>Order confirmed. We will get back to you soon</strong>");
            $('#success3 > .alert-success')
              .append('</div>');
            //clear all fields
            $('#conForm').trigger("reset");
            $('#conButtom').html('Thank You');
          },
          error: function() {
            // Fail message
            $('#success3').html("<div class='alert alert-danger'>");
            $('#success3 > .alert-danger').html("<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;")
              .append("</button>");
            $('#success3 > .alert-danger').append($("<strong>").text("Sorry, it seems that our server is not responding. Please try again later!"));
            $('#success3 > .alert-danger').append('</div>');
            //clear all fields
            $('#conForm').trigger("reset");
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
  
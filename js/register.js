$(function() {

  $("#registerForm input").jqBootstrapValidation({
    preventSubmit: true,
    submitError: function($form, event, errors) {
      // additional error messages or events
    },
    submitSuccess: function($form, event) {
      event.preventDefault(); // prevent default submit behaviour
      // get values from FORM
      var fname = $("input#fname").val();
      var sname = $("input#sname").val();
      var email = $("input#email").val();
      var pnumber = $("input#pnumber").val();
      var line1 = $("input#line1").val();
      var line2 = $("input#line2").val();
      var firstName = fname; // For Success/Failure Message
      // Check for white space in name for Success/Fail message
      if (firstName.indexOf(' ') >= 0) {
        firstName = name.split(' ').slice(0, -1).join(' ');
      }
      $this = $("#regButton");
      $this.prop("disabled", true); // Disable submit button until AJAX call is complete to prevent duplicate messages
      $.ajax({
        url: "../services/register.php",
        type: "POST",
        data: {
          fname: fname,
          sname: sname,
          email: email,
          pnumber: pnumber,
          line1: line1,
          line2: line2
        },
        cache: false,
        success: function() {
          // Success message
          $('#success1').html("<div class='alert alert-success'>");
          $('#success1 > .alert-success').html("<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;")
            .append("</button>");
          $('#success1 > .alert-success')
            .append("<strong>You were registered successfully. Check your email </strong>");
          $('#success1 > .alert-success')
            .append('</div>');
          //clear all fields
          $('#registerForm').trigger("reset");
          $('#regButton').html('Thank You');
        },
        error: function() {
          // Fail message
          $('#success1').html("<div class='alert alert-danger'>");
          $('#success1 > .alert-danger').html("<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;")
            .append("</button>");
          $('#success1 > .alert-danger').append($("<strong>").text("Sorry " + firstName + ", it seems that our server is not responding. Please try again later!"));
          $('#success1 > .alert-danger').append('</div>');
          //clear all fields
          $('#registerForm').trigger("reset");
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

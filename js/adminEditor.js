$(function() {

  $(".editFormMail input").jqBootstrapValidation({
    preventSubmit: true,
    submitError: function($form, event, errors) {
      // additional error messages or events
    },
    submitSuccess: function($form, event) {
      event.preventDefault(); // prevent default submit behaviour
      // get values from FORM
      var cnumber = $("input#cnumber").val();
      var email = $("input#email").val();
      var myurl = window.location.href;

      $this = $("editButtonMail");
      $this.prop("disabled", true); // Disable submit button until AJAX call is complete to prevent duplicate messages
      $.ajax({
        url: "../services/cmail.php",
        type: "POST",
        data: {
          cnumber: cnumber,
          email: email
        },
        cache: false,
        success: function() {
          // Success message
          $('.success2').html("<div class='alert alert-success'>");
          $('.success2 > .alert-success').html("<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;")
            .append("</button>");
          $('.success2 > .alert-success')
            .append("<strong>Email was successfully updated. <a href='" + myurl + "'>Refresh</a> </strong>");
          $('.success2 > .alert-success')
            .append('</div>');
          //clear all fields
          $('.editFormMail').trigger("reset");
          $('#editButtomMail').html('Thank You');
        },
        error: function() {
          // Fail message
          $('.success2').show("slow");
          $('.success2').html("<div class='alert alert-danger'>");
          $('.success2 > .alert-danger').html("<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;")
            .append("</button>");
          $('.success2 > .alert-danger').append($("<strong>").text("Sorry, it seems that our server is not responding. Please try again later!"));
          $('.success2 > .alert-danger').append('</div>');

          setTimeout(function(){
            $('.success2').hide("slow");
          }, 4000);
          //clear all fields
          $('.editFormMail').trigger("reset");
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

$(function() {

  $(".editFormMobile input").jqBootstrapValidation({
    preventSubmit: true,
    submitError: function($form, event, errors) {
      // additional error messages or events
    },
    submitSuccess: function($form, event) {
      event.preventDefault(); // prevent default submit behaviour
      // get values from FORM
      var cnumber = $("input#cnumber").val();
      var mnumber = $("input#mnumber").val();
      var myurl = window.location.href;

      $this = $("#editButtonMobile");
      $this.prop("disabled", true); // Disable submit button until AJAX call is complete to prevent duplicate messages
      $.ajax({
        url: "../services/cmobile.php",
        type: "POST",
        data: {
          cnumber: cnumber,
          mnumber: mnumber
        },
        cache: false,
        success: function() {
          // Success message
          $('.success3').html("<div class='alert alert-success'>");
          $('.success3 > .alert-success').html("<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;")
            .append("</button>");
          $('.success3 > .alert-success')
            .append("<strong>Mobile number was successfully updated. <a href='" + myurl + "'>Refresh</a> </strong>");
          $('.success3 > .alert-success')
            .append('</div>');
          //clear all fields
          $('.editFormMobile').trigger("reset");
          $('#editButtomMobile').html('Thank You');
        },
        error: function() {
          // Fail message
          $('.success3').show("slow");
          $('.success3').html("<div class='alert alert-danger'>");
          $('.success3 > .alert-danger').html("<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;")
            .append("</button>");
          $('.success3 > .alert-danger').append($("<strong>").text("Sorry, it seems that our server is not responding. Please try again later!"));
          $('.success3 > .alert-danger').append('</div>');

          setTimeout(function(){
            $('.success3').hide("slow");
          }, 4000);
          //clear all fields
          $('.editFormMobile').trigger("reset");
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

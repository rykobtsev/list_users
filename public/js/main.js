$(document).ready(function () {
  $("#authForm").submit(function (e) {
    e.preventDefault();
    var formData = $(this).serialize();

    $.ajax({
      type: "POST",
      url: "/main/add",
      data: formData,
      dataType: "json",
      success: function (response) {
        if (response.error) {
          if (response.error.email) {
            $(".error_email").text(response.error.email);
            $(".error_email").css("display", "block");
          } else {
            $(".error_email").text("");
            $(".error_email").css("display", "none");
          }

          if (response.error.password) {
            $(".error_confirm_password").text(response.error.password);
            $(".error_confirm_password").css("display", "block");
          } else {
            $(".error_confirm_password").text("");
            $(".error_confirm_password").css("display", "none");
          }
          $('[name="firstName"]').val(response.dataForm.firstName);
          $('[name="lastName"]').val(response.dataForm.lastName);
          $('[name="email"]').val(response.dataForm.email);
          $('[name="password"]').val("");
          $('[name="confirmPassword"]').val("");
          // $("#firstName").val(response.dataForm.firstName);
          // $("#lastName").val(response.dataForm.lastName);
          // $("#email").val(response.dataForm.email);
          // $("#password").val(response.dataForm.password);
          // $("#confirmPassword").val(response.dataForm.confirmPassword);
        } else {
          $.ajax({
            type: "GET",
            url: "/",
            dataType: "html",
            success: function (response) {
              $("#wrapper").html(response);
            },
            error: function () {
              console.log("Server error.");
            },
          });
        }
      },
      error: function () {
        console.log("Server error.");
      },
    });
  });
});

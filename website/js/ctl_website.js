// alert("yooooooooooooooooooooooooooooooooooo!");
$(document).ready( function() {

	// making it so that the user doesn't see this field (because we'll be filling this out.)
	// $("#mergeRow-3").css("display", "none");

	// this variable is used to help let the user know they need to fill out the form.

	// $("#signup_submit").
	$("input[type=submit]").attr("disabled", "disabled");

	//Append a change event listener to you inputs
    $('input').keyup(function(){
          //Validate your form here, example:
          // alert("lol");
          var validated = true;
          if($('#MERGE0').val().length === 0) validated = false;
          if($('#MERGE1').val().length === 0) validated = false;
          if($('#MERGE2').val().length === 0) validated = false;
          // if($('#MERGE3').val().length === 0) validated = false;

          //If form is validated enable form
          if(validated) {
          	$("input[type=submit]").removeAttr("disabled");
          	$("input[type=submit]").css("background-color", "#444444");
          }
          else {
          	$("input[type=submit]").attr("disabled", "disabled");
          	$("input[type=submit]").css("background-color", "#5d5d5d");

          	
          }                             
      });

	// this handles the switching of pages.
	$(document).on("click", "#signup_submit", function(e) {

		
		// alert("come on over baby");
		var valid = true;

		// incorporate this with an ajax call.
		// $("#MERGE3").attr("value", download_id);

		$.ajax({
		    async: false,
			url: "/ajax_download.php",
			data: { first_name: $("#MERGE1").val(),
					last_name: $("#MERGE2").val(),
					email: $("#MERGE0").val() },
			success: function(data) {

				// changing the id code 
				// alert(data.already_used);

				// if the person already tried to register, tell them that.
				if (data.already_used > 0) {
					// alert("oh no you dont!");
					$("#MERGE0").val("");
					$("#MERGE0").attr("placeholder", "This email is already registered.");
					valid = false;
				}

				// toherwise, give them a download id & submit the form.
				$("#MERGE3").attr("value", data.download_id);
			}
		});

		if (!valid) {
			return false;
		}


	});

// $("#signup_submit").submit(function() {
// 	alert("it happened");
// 	return false;
// });

// var anything = $("#signup_form").contents().find("#MERGE3").value; //.text("potato");
// alert(anything);
	// this fixes the iframe issue with mobile devices.
	if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
	   $("#preview").width(300);
	   $("#preview").width(475);
	}

});
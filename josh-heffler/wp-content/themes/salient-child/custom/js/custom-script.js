(function($){


	$("#user_register_form").submit(function(event) {
		event.preventDefault();
		$("#user_register_form").validate({

			rules: {
				username: {required: true},
				email: {required: true},
				pass: {required: true},
				c_pass: {equalTo:'#pass'},
				registering: {required: true}
			}
		});

		var valid = $(this).valid();
		if (valid) {
			$("#register_submit").append('<i class="fa fa-circle-o-notch fa-spin" style="font-size:20px"></i>');
			$("#register_submit").prop("disabled",true);
			var serialize_form = $(this).serialize();

			$.ajax({
				type:"POST",
				url: the_ajax_script.ajaxurl,
				data: serialize_form,
				dataType : 'json',
				success: function (response) {
					$("#register_submit").children().remove();
					$("#register_submit").prop("disabled",false);
					var status = response.status;
                        //console.log(response);
                        if (status) { 
                        	Swal.fire({
                    		icon: 'success',
                    		text: response.message,
                    	        }).then((result) => {
                    		if (result.value) {
                    			window.location.href = response.redirect_url;
                    		}
                    	});
                        
                        } else {
                            	Swal.fire({
                        		icon: 'error',
                        		text: response.message,
                        	});
                        
                        }
                    },
                    error: function (errorThrown) {
                    	alert('error');
                    	console.log(errorThrown);
                    },
                });
		}

	});

     $("#follow-btn").click(function(event) {

        var serialize_form = $("#follow-unfollow").serialize();

           $.ajax({
                type:"POST",
                url: the_ajax_script.ajaxurl,
                data: serialize_form,
                dataType : 'json',
                success: function (response) {
        
                    var status = response.status;
                        //console.log(response);
                        if (status) { 

                            $("#follow-btn").html('UnFollow');
                           
                        } else {
                            $("#follow-btn").html('Follow');
                        }
                    },
                    error: function (errorThrown) {
                        alert('error');
                        console.log(errorThrown);
                    },
                });
        

    });

    $("#like-btn").click(function(event) {

        var serialize_form = $("#like-unlike").serialize();

           $.ajax({
                type:"POST",
                url: the_ajax_script.ajaxurl,
                data: serialize_form,
                dataType : 'json',
                success: function (response) {
        
                    var status = response.status;
                        //console.log(response);
                        if (status) { 

                            $("#like-btn").html('Unlike');
                           
                        } else {
                            $("#like-btn").html('Like');
                        }
                    },
                    error: function (errorThrown) {
                        alert('error');
                        console.log(errorThrown);
                    },
                });
        

    });


	$("#user-login-form").submit(function(event) {
    event.preventDefault();
    $("#user-login-form").validate({

      rules: {
        user_name: {required: true},
        pass: {required: true},
      },
      messages: {
                  user_name: { required: 'Please Enter Your Username or Email' },
                  pass:{ required:'Please Enter your password'},
                },
       
    });

    var valid = $(this).valid();
    if (valid) {
      	$("#login-user").append('<i class="fa fa-circle-o-notch fa-spin" style="font-size:20px"></i>');
    	$("#login-user").prop("disabled",true);
            var serialize_form = $(this).serialize();
            $.ajax({
                type:"POST",
                url: the_ajax_script.ajaxurl,
                data: serialize_form,
                dataType : 'json',
              success: function (response) {
          	    	$("#login-user").children().remove();
					       $("#login-user").prop("disabled",false);
                    console.log(response);
                    var error = response.status;
                    if (error) { 
                        window.location.href = response.redirect_url;
                    } else {
                        Swal.fire({
                            icon: 'error',
                            text: response.error,
                            });
                       // console.log(response);
                    }
                },
            	error: function (errorThrown) {
                        console.log(errorThrown);
                    },
            });
    }
      
  });
    $("#forget_pass_form").submit(function(event) {
    event.preventDefault();
    $("#forget_pass_form").validate();

    var valid = $(this).valid();
    if (valid) {
        $("#forgot_mail").append('<i class="fa fa-circle-o-notch fa-spin" style="font-size:20px"></i>');
        $("#forgot_mail").prop("disabled",true);
            var serialize_form = $(this).serialize();
            $.ajax({
                type:"POST",
                url: the_ajax_script.ajaxurl,
                data: serialize_form,
                dataType : 'json',
              success: function (response) {
                    $("#forgot_mail").children().remove();
                    $("#forgot_mail").prop("disabled",false);
                    var status = response.status;
                    if (status) { 
                        window.location.href = response.redirect_url;
                    } else {
                        Swal.fire({
                            icon: 'error',
                            text: response.message,
                            });
                       // console.log(response);
                    }
                },
                error: function (errorThrown) {
                        console.log(errorThrown);
                    },
            });
    }
      
  });
    $("#reset_password_form").submit(function(event) {
    event.preventDefault();
    $("#reset_password_form").validate({
        rules: {
                pass: {required: true},
                c_pass: {equalTo:'#pass2'},
            }
    });

    var valid = $(this).valid();
    if (valid) {
        $("#reset-pswd-btn").append('<i class="fa fa-circle-o-notch fa-spin" style="font-size:20px"></i>');
        $("#reset-pswd-btn").prop("disabled",true);
            var serialize_form = $(this).serialize();
            $.ajax({
                type:"POST",
                url: the_ajax_script.ajaxurl,
                data: serialize_form,
                dataType : 'json',
              success: function (response) {
                    $("#reset-pswd-btn").children().remove();
                    $("#reset-pswd-btn").prop("disabled",false);
                    console.log(response);
                    var status = response.status;
                    if (status) { 
                        Swal.fire({
                            icon: 'success',
                            text: response.message,
                            }).then((result)=>{
                                    window.location.href = response.redirect_url;
                                });

                    } else {
                        Swal.fire({
                            icon: 'error',
                            text: response.message,
                            });
                    }
                },
                error: function (errorThrown) {
                        console.log(errorThrown);
                    },
            });
    }
      
  });
    $("#update-profile-form").submit(function(event) {
    event.preventDefault();
    $("#update-profile-form").validate();
    var valid = $(this).valid();
    if (valid) {
        $("#update-profile").append('<i class="fa fa-circle-o-notch fa-spin" style="font-size:20px"></i>');
        $("#update-profile").prop("disabled",true);
            var serialize_form = $(this).serialize();
            $.ajax({
                type:"POST",
                url: the_ajax_script.ajaxurl,
                 data: new FormData(this),
                  cache: false,
                  contentType: false,
                  processData: false,
                  dataType: 'json',
              success: function (response) {
                    $("#update-profile").children().remove();
                    $("#update-profile").prop("disabled",false);
                    console.log(response);
                    var status = response.status;
                    if (status) { 
                        Swal.fire({
                            icon: 'success',
                            text: response.message,
                            });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            text: response.message,
                            });
                    }
                },
                error: function (errorThrown) {
                        console.log(errorThrown);
                    },
            });
    }
      
  });
   $("#change_password").submit(function(event) {
    event.preventDefault();
    $(this).validate({
			rules: {
				current_pass: {required: true},
				new_pass: {required: true},
				confirm_new_pass: {equalTo:'#pass_update'}
			}
		});
    var valid = $(this).valid();
    if (valid) {
        $("#update-pswd").append('<i class="fa fa-circle-o-notch fa-spin" style="font-size:20px"></i>');
        $("#update-pswd").prop("disabled",true);
            var serialize_form = $(this).serialize();
            $.ajax({
                type:"POST",
                url: the_ajax_script.ajaxurl,
                data: serialize_form,
                dataType : 'json',
              success: function (response) {
                    $("#update-pswd").children().remove();
                    $("#update-pswd").prop("disabled",false);
                    console.log(response);
                    var status = response.status;
                    if (status) { 
                        Swal.fire({
                            icon: 'success',
                            text: response.message,
                            });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            text: response.message,
                            });
                    }
                },
                error: function (errorThrown) {
                        console.log(errorThrown);
                    },
            });
    }
      
  });
  $("#create-challenge").submit(function(event) {
    event.preventDefault();
    $(this).validate();
    var valid = $(this).valid();
    if (valid) {
        $("button[name=challenge_create]").append('<i class="fa fa-circle-o-notch fa-spin" style="font-size:20px"></i>');
        $("button[name=challenge_create]").prop("disabled",true);
            $.ajax({
                type:"POST",
                url: the_ajax_script.ajaxurl,
                 data: new FormData(this),
                  cache: false,
                  contentType: false,
                  processData: false,
                  dataType: 'json',
              success: function (response) {
                    $("button[name=challenge_create]").children().remove();
                    $("button[name=challenge_create]").prop("disabled",false);
                    console.log(response);
                    var status = response.status;
                    if (status) { 
                        Swal.fire({
                            icon: 'success',
                            text: response.message,
                            html: '<br><input type=text value='+response.share_link+' id=copiedlink>'+
                            '<button type=button id=link-copy>Copy</button><br>'+response.share_buttons,
                            }).then((result) => {
                                if (result.value) {
                                    window.location.href = response.redirect_url;
                                }
                            });

                    } else {
                        Swal.fire({
                            icon: 'error',
                            text: response.message,
                            });
                    }
                },
                error: function (errorThrown) {
                        console.log(errorThrown);
                    },
            });
    }
      
  });
  $("#edit-challenge").submit(function(event) {
    event.preventDefault();
        $(this).validate();
            var valid = $(this).valid();
            if (valid) {
        $("button[name=history_save]").append('<i class="fa fa-circle-o-notch fa-spin" style="font-size:20px"></i>');
        $("button[name=history_save]").prop("disabled",true);
            $.ajax({
                type:"POST",
                url: the_ajax_script.ajaxurl,
                data: new FormData(this),
                cache: false,
                contentType: false,
                processData: false,
                dataType: 'json',
              success: function (response) {
                    $("button[name=history_save]").children().remove();
                    $("button[name=history_save]").prop("disabled",false);
                    console.log(response);
                    var status = response.status;
                    if (status) { 
                        Swal.fire({
                            icon: 'success',
                            text: response.message,
                            }).then((result) => {
                                if (result.value) {
                                    location.reload();
                                }
                            });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            text: response.message,
                            });
                    }
                },
                error: function (errorThrown) {
                        console.log(errorThrown);
                    },
            });
      }
  });

  $('#edit-challenge').on('input change', function() {
    $('button[name=history_save]').attr('disabled', false);
  });

  
  $(".delete-btn").click(function(event) {
 
        var challenge_id = $(this).attr("data-id");
            $.ajax({
                type:"POST",
                url: the_ajax_script.ajaxurl,
                data: {"action":"delete_challenge", "post_id":challenge_id},
               /* cache: false,
                contentType: false,
                processData: false,*/
                dataType: 'json',
              success: function (response) {
                    console.log(response);
                    var status = response.status;
                    if (status) { 
                        $("#"+challenge_id).remove();
                    } else {
                       alert(response.message);
                    }
                },
                error: function (errorThrown) {
                        console.log(errorThrown);
                    },
            });
  });
  /*Mark as completed*/
    $(".mark_btn").click(function(event) {
 
        var challenge_id = $(this).attr("data-id");
            $.ajax({
                type:"POST",
                url: the_ajax_script.ajaxurl,
                data: {"action":"mark_completed", "post_id":challenge_id},
                dataType: 'json',
              success: function (response) {
                    console.log(response);
                    var status = response.status;
                    if (status) { 
                        Swal.fire({
                            icon: 'success',
                            text: response.message,
                            });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            text: response.message,
                            });
                    }
                },
                error: function (errorThrown) {
                        console.log(errorThrown);
                    },
            });
  });
 


  /*        Review  rating  */
$("#rating-form-show").click(function(){
  $("#Review").slideDown();
  $(this).hide();
});

$("#cancel-rate-form").click(function(){
  $("#Review").slideUp();
  $("#rating-form-show").show();
});


$("#Review").submit(function (event) {
    event.preventDefault();

$("#Review").validate({
errorPlacement: function(error, element) {
  if (element.attr("name") == "rating") {
     error.insertAfter(".rating");
  } else {
     error.insertAfter(element);
  }
},
rules: {
fname: {required: true},
review: {required: true},
rating: {required:true},
image_new:{required:true ,extension: "jpg|jpeg|png|ico|bmp"},


},
messages: {
          fname: { required: 'Please Enter Your First Name' },
          review:{ required:'Please Enter Review'},
          rating:{ required:'Please rate Review'},
          image_new:{ extension:'Please upload file in these format only jpg, jpeg, png, ico, bmp'},

        },
    

});
          var valid = $(this).valid();
          if (valid) { 

         

              for (i = 0; i < $('input[name="rating"]').length; i++) {
                      if($('input[name="rating"]')[i].checked == true) {
                          var ratingValue = $('input[name="rating"]')[i].value;
                          break;
                      }
              }
              if ($('input[name=rating]:checked').length == 0) {
                alert('please rate');
                return false;
              }
                 $("#submit-btn").append("<i class = 'fa fa-refresh fa-spin'></i>");
            $("#submit-btn").prop("disabled",true);
            var fname = $('input[name=fname]').val();
            var review_title = $('input[name=review_title]').val();
            var post_name = $('input[name=post_name]').val();
            var post_id = $('input[name=post_id]').val();
            var review = $('textarea[name=review]').val();
            var fd = new FormData();
            fd.append('fname', fname);
            fd.append('review', review);
            fd.append('post_name', post_name);
            fd.append('post_id', post_id);
            fd.append('ratingValue', ratingValue);
            fd.append('action', 'reviews');            
            //fd.append('image_new', $('input[type=file]')[0].files[0]); 
            
            $.ajax({

                type:"POST",
                data: fd,
                url: the_ajax_script.ajaxurl,
                cache: false,
                contentType: false,
                processData: false,
                dataType : 'json',
                    success: function (response) {
                    $("#submit-btn").remove("#submit-btn i");
                    $("#submit-btn").prop("disabled",false);
                        var error = response.error;
                        if (error) { 
                            Swal.fire(response.message);
                        } else {
                                Swal.fire({
                                icon: 'success',
                                text: response.message,
                                }).then((result) => {
                                      if (result.value) {
                                         location.reload();
                                      }
                        });
                        }
                    },
                    error: function (errorThrown) {
                      console.log("error");
                        console.log(errorThrown);
                    },
            });
         
         }
});

    
        /*preview image before upload*/

        function readURL(input) {
          if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
              $('.img-class').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]); // convert to base64 string
          }
        }

$(document).on("click","#link-copy",function() {
  /* Get the text field */
  var copyText = document.getElementById("copiedlink");
  /* Select the text field */
  copyText.select(); 
  copyText.setSelectionRange(0, 99999); /*For mobile devices*/
  /* Copy the text inside the text field */
  document.execCommand("copy");
  /* Alert the copied text */
  alert("Link Copied");

});
        $(".upload").change(function() {
          readURL(this);
        });
          $(".view-btnnn").click(function(event) {
                var challenge_id = $(this).attr("data-id");
                     Swal.fire({
                      title: 'Are you sure?',
                      text: "You won't be able to revert this!",
                      icon: 'warning',
                      showCancelButton: true,
                      confirmButtonColor: '#3085d6',
                      cancelButtonColor: '#d33',
                      confirmButtonText: 'Yes, Send!'
                    }).then((result) => {
                      if (result.value) {
                           $.ajax({
                                type:"POST",
                                url: the_ajax_script.ajaxurl,
                                data: {"action":"request_admin", "post_id":challenge_id},
                                dataType: 'json',
                              success: function (response) {
                                    console.log(response);
                                    var status = response.status;
                                    if (status) { 
                                            Swal.fire(
                                              'Success!',
                                              'Your request has been sent to admin.',
                                              'success'
                                            )
                                    } else {
                                      Swal.fire(
                                              'Success!',
                                              'Your request has been sent to admin.',
                                              'success'
                                            )
                                    }
                                },
                                error: function (errorThrown) {
                                        console.log(errorThrown);
                                    },
                            });
                         }
                    })


         
  });
    // var owl = jQuery('.owl-carousel');

    $('.owl-carousel').owlCarousel({
        items:4,
        loop:true,
        margin:10,
        autoplay:true,
        autoplayTimeout:5000,
        autoplayHoverPause:true
    });
    $('.play').on('click',function(){
        owl.trigger('play.owl.autoplay',[1000])
    })
    $('.stop').on('click',function(){
        owl.trigger('stop.owl.autoplay')
    })

})(jQuery);
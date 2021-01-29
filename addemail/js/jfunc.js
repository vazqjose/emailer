// JavaScript Document


$('#addemail').click(function()		{
					
					var email = $('#email').val();
			
					$.post('addemail/php/Newsletter-signup.php', { email: email }, function(msg)		{
																		   
						$('#mensajediv').html(msg).fadeIn(800).delay(3000).fadeOut(1000);
																	
					});							  

});
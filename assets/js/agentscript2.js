// JavaScript Document
$(document).ready(function() {
	var link = "/learnhub/";
	var link2; //this link will be populated with value in a switch depending on the type of form [request or email]
	var dataArray; //array that will contain all the post data to be submitted
	
	$("form#contactForm").submit(function() {
		var errorMsg = "";
		
		//display the loading icon div
		var contactFormErrorMessage = $("div#contactFormErrorMessage");
		contactFormErrorMessage.fadeIn();
		
		var firstName = $(this).find('input[name=firstName]').val();
		var userEmail = $(this).find('input[name=userEmail]').val();
		var userPhone = $(this).find('input[name=userPhone]').val();
		var userMessage = $(this).find('textarea[name=userMessage]').val();
		
		/**VALIDATE FIRSTNAME**/
		if (inputEmpty(firstName)) {
			if (!inputAlphabet(firstName)) {
				errorMsg += '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Name Field Can Only Contain Alphabetic Characters.</div>';
			}
		}else {
			errorMsg += '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Name Field Cannot Be Empty.</div>';
		}
		
		/**VALIDATE Useremail**/
		if (inputEmpty(userEmail)) {
			if (!ValidateEmail(userEmail)) {
				errorMsg += '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Invalid Email Format.</div>';
			}
		}else {
			errorMsg += '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Email Field Cannot Be Empty.</div>';
		}
		
		/**VALIDATE USERPHHONE**/
		if (inputEmpty(userPhone)) {
			if (!inputNumeric(userPhone)) {
				errorMsg += '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Invalid Phone Format.</div>';
			}
		}else {
			errorMsg += '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Phone Field Cannot Be Empty.</div>';
		}
		
		/**VALIDATE MESSAGE**/
		if (!inputEmpty(userMessage)) {
			errorMsg += '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Message Field Cannot Be Empty.</div>';
		}
		
		if (errorMsg == "") {
			
			link2 = 'Home/contact_us';
			dataArray = { firstName : firstName, userEmail : userEmail, userPhone : userPhone, userMessage : userMessage, ajax : 1 };
					
			$.post(link + link2, dataArray, function(data) {
				if (data == "sent") {
					var successMsg = '<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Success!</strong> Your Message Has Been Sent Successfully.</div>';
					contactFormErrorMessage.html(successMsg);
				}else {
					var notSentMsg = '<div class="alert alert-warning"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Error!</strong> Your Message Was Not Sent. Try Again Later.</div>';
					contactFormErrorMessage.html(notSentMsg);
				}
			});
		}else {
			contactFormErrorMessage.html(errorMsg);
		}
		
		//alert("userName: " + userName + " userEmail: " + userEmail + " userPhone: " + userPhone + " message: " + userMessage);
		
		return false;
	});	
	
});

function inputEmpty(data) {
	if (data != "") {
		return true;
	}else {
		return false;
	}
}

function inputAlphabet(inputtext) {
	var alphaExp = /^[a-zA-Z\s\.]+$/;
	if (inputtext.match(alphaExp)) {
		return true;
	} else {
		return false;
	}
}

function inputNumeric(inputtext) {
	var alphaExp = /^[0-9]{11}$/;
	if (inputtext.match(alphaExp)) {
		return true;
	} else {
		return false;
	}
}

function ValidateEmail(uemail)  {  
	var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;  
	if(uemail.match(mailformat))  {  
		return true;  
	}  
	else {  
		return false;  
	}  
}
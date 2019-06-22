$(document).ready(function() {
	var email_modal = $('#email_overlay_wrapper');
	var innerOfModal = $('#email_inner_container');
	var theContainer = $('#the_modal_container');
	var leaveCounter = 1;
	
	$(this).mouseleave(function() {
		
		var winPos = parseInt($(window).scrollTop()) + 70;
		
		if (leaveCounter == 1) {
			theContainer.css("top", winPos+"px");
			email_modal.fadeIn("fast");
			innerOfModal.addClass('scale-in-out');
		}
			
		leaveCounter++;
	});
	
	$('#show_the_email_modal').click(function(e) {
		e.preventDefault();
		
		var winPos = parseInt($(window).scrollTop()) + 70;
		
		theContainer.css("top", winPos+"px");
		email_modal.fadeIn("fast");
		innerOfModal.addClass('scale-in-out');
	});
	
	$('#close_the_modal').click(function(e) {
		e.preventDefault();
		innerOfModal.removeClass('scale-in-out');
		innerOfModal.addClass('scale-in-out');
		email_modal.fadeOut("fast");
	});
	
	$('.close_modal_overlay').click(function() {
		innerOfModal.removeClass('scale-in-out');
		innerOfModal.addClass('scale-in-out');
		email_modal.fadeOut("fast");
	});
	
	$('#email_address').keyup(function() {
		var $email = this.value;
		var $inputSubmitButton = $('#submit_email');
		var $emailFormIndicator = $('#email_format_indicator');
		//if the input field is empty don't show the indicator
			//but disable the input button
		if (inputEmpty($email)) {
			if (validateEmail($email)) {
				$inputSubmitButton.prop('disabled', false);
				$emailFormIndicator.html('<i class="fa fa-check correct"></i>');
			}else {
				$inputSubmitButton.prop('disabled', true);
				$emailFormIndicator.html('<i class="fa fa-times wrong"></i>');
			}
		}else {
			$inputSubmitButton.prop('disabled', true);
			$emailFormIndicator.html('');
		}
	});
	
	$('.markets-insider-search-input').keyup(function() {
		var $email = this.value;
		var $inputSubmitButton = $('#markets-insider-search-submit');
		//if the input field is empty don't show the indicator
		//but disable the input button
		if (inputEmpty($email)) {
			if (validateEmail($email)) {
				$inputSubmitButton.prop('disabled', false);
			}else {
				$inputSubmitButton.prop('disabled', true);
			}
		}else {
			$inputSubmitButton.prop('disabled', true);
		}
	});
});


function validateEmail(email) {
	var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
	if (!emailReg.test(email)) {
		return false;
	} else {
		return true;
	}
}

function inputEmpty(data) {
	if (data != "") {
		return true;
	}else {
		return false;
	}
}
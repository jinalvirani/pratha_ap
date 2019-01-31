

$(document).ready(function()
{
	$(window).scroll(function()
	{
		if ($(this).scrollTop() > 100) 
		{
			$('.scrollToTop').fadeIn();
		} 
		else 
		{
			$('.scrollToTop').fadeOut();
		}
	});
	$('.scrollToTop').click(function()
	{
		$('html, body').animate({scrollTop : 0},800);
		return false;
	});
	
});

function recaptchaCallback() {
    var response = grecaptcha.getResponse(),
        $button = jQuery(".button-register");
    jQuery("#hidden-grecaptcha").val(response);
    console.log(jQuery("#registerForm").valid());
    if (jQuery("#insertform").valid()) {
        $button.attr("disabled", false);
    }
    else {
        $button.attr("disabled", "disabled");
    }
}

function recaptchaExpired() {
    var $button = jQuery(".button-register");
    jQuery("#hidden-grecaptcha").val("");
    var $button = jQuery(".button-register");
    if (jQuery("#insertform").valid()) {
        $button.attr("disabled", false);
    }
    else {
        $button.attr("disabled", "disabled");
    }
}

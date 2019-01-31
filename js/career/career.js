$(document).ready(function()
{
	$.validator.addMethod("n", function(value, element) 
	{
    	return this.optional(element) || /^[a-zA-Z\s\W]+$/.test(value);
	}, "Please enter valid name");
	
	$.validator.addMethod("phone", function(value, element) 
	{
   	    return this.optional(element) || /^[0-9]+$/.test(value);
    }, "Please enter only digits");
	
	$.validator.addMethod("filesize", function(value, element, param) {
    	    return this.optional(element) || (element.files[0].size <= param)
    	});	
	
	$("#insertform").validate({
		errorElement:'span',
		rules:{
			career_name:{
				required:true,
				n:true
			},

				career_email: {
					required: true,
					email:true
				},
							career_phone: {
					required: true,
					phone:true
				},
				myfile: {
					required: true,
					filesize: 2097152
				},
				"hidden-grecaptcha": {
              required: true,
              minlength: "255"
            }
		},
		 submitHandler: function(form) {
			 var formData=new FormData($("#insertform")[0]);
        $.ajax({
           type: "POST",
           url: "send_mail.php",
		   cache: false,
		   contentType: false,
		   processData: false,
           data: formData, // serializes the form's elements.
		   async: false,
           success: function(data)
           {
				$("#c_form").html(data); // show response from the php script.
           }           
        });
    },
		messages:{
			career_name:{
				required:"Plesae enter name",
				n:"Plesae enter valid name",
			},

				career_email: {
					required: "Plesae enter email",
					email:"Please enter valid email",
				
				},
				career_phone: {
					required: "Plesae enter phone",
					phone:"Please enter valid phone",
				},
				myfile: {
					required: "Please select file",
					filesize: "File must be less than 2MB"
				},
				"hidden-grecaptcha":{
					required: "Please verify you are human",
				}
		}
	});
});

$(function() {
$('#uploadfile').change(function() {
var fileExtension = ['doc', 'docx', 'txt', 'pdf'];
if ($.inArray($(this).val().split('.').pop().toLowerCase(), fileExtension) == -1) {
alert("Only '.doc','.docx', '.txt', '.pdf' formats are allowed.");
}
})
});

function myFunction(){
    var x = document.getElementById("uploadfile");
    var txt = "";
    if ('files' in x) {
        if (x.files.length == 0) {
        } else {
            for (var i = 0; i < x.files.length; i++) {
                var file = x.files[i];
                if ('name' in file) {
                    txt += file.name + "<br>";
                }
            }
        }
    } 
    document.getElementById("demo").innerHTML = txt;
}
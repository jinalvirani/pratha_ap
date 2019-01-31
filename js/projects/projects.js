function openNav(testing) {
	 
	 var userID='id='+testing;
	 var useID='iddd='+testing;
	 var userrID='idddd='+testing;
	$.ajax({
		type:"POST",
		url:"test2.php",
		data: userID,
		cache:false,
		success:function(html)
		{
			
			$('#msg').html(html);
			
		}
	});
	$.ajax({
		type:"POST",
		url:"test3.php",
		data: useID,
		cache:false,
		success:function(html)
		{
			
			$('#msg2').html(html);
			
		}
	});
	$.ajax({
		type:"POST",
		url:"test4.php",
		data: userrID,
		cache:false,
		success:function(html)
		{
			
			$('#msg4').html(html);
			
		}
	});
	 document.getElementById("myNav").style.height = "100%";
document.getElementById("abc").style.overflow = "hidden";
 document.getElementById("loader").style.display = "block";
 setTimeout(function(){ document.getElementById("loader").style.display = "none";}, 2000);
	return false;
	 

}

function closeNav() {
	
	document.getElementById("myNav").style.height = "0%";

	document.getElementById("abc").style.overflow = "scroll";
}

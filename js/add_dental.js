$(document).ready(function(){
	$("#save_dental").click(function(){
			var family_no = $("#family_no").val();
			var name = $("#name").val();
			var birthdate = $("#birthdate").val();
			var age = $("#age").val();
			var phil_health_no = $("#phil_health_no").val();
			var address = $("#address").val();
			var civil_status = $("#civil_status").val();
			var sex = $("#sex").val();
			var bp = $("#bp").val();
			var temp = $("#temp").val();
			var pr = $("#pr").val();
			var rr = $("#rr").val();
			var wt = $("#wt").val();
			var ht = $("#ht").val();
		$.ajax({
				type: "POST",
				url: "../add_dental.php",
				data: {
					family_no: family_no,
					name: name,
					birthdate: birthdate,
					age: age,
					phil_health_no: phil_health_no,
					address: address,
					civil_status: civil_status,
					sex: sex,
					bp: bp,
					temp: temp,
					pr: pr,
					rr: rr,
					wt: wt,
					ht: ht
				},
				success: function(msg){
					$("#a").html(msg);
					$("#a").fadeIn();
					$("#a").fadeOut(2000);
				},
				error: function (xhr, ajaxOptions, thrownError) {
        alert(xhr.status);
        alert(thrownError);
				}
		});		
	});
});	
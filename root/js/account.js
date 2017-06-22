function login() {
	var username = $('#login_form').find('input').eq(0).val();
	var password = $('#login_form').find('input').eq(1).val();

	if(username == "") {
		alert("用户名不能为空!");
	}
	if(password == "") {{
		alert("密码不能为空!");
	}}

	// var form = document.getElementById("login_form");
	// document.forms["login_form"].submit();
	$("#login_form").submit();
	
}
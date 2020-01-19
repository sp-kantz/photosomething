function validate_register()
{
	x=document.register_form;

	at=x.email.value.indexOf("@");
	c1=x.password.value.indexOf("|");
	c2=x.password.value.indexOf("&");
	c3=x.password.value.indexOf("!");

	name=x.username.value;
	pass=x.password.value;
	r_pass=x.r_password.value;

	submitOK="True";

	if (at==-1)
	{
		alert("Invalid E-mail");
		submitOK="False";
	}

	if ((name.length<6) || (name.length>16))
	{
		alert("Username should be 6-15 characters");
		submitOK="False";
	}
  
	if ((c1<0)&&(c2<0)&&(c3<0))
	{
		if ((pass.length<6) || (pass.length>16))
		{
			alert("Your password should be 6-16 characters");
			submitOK="False";
		}
		if (r_pass!=pass)
		{
			alert("Confirmation fail");
			submitOK="False";
		}
	}
	else
	{  
		alert("Invalid characters in password");
		submitOK="False";
	}

	if (submitOK=="False")
	{
		return false;
	}
}

function validate_login()
{
	x=document.login_form;
	name=x.username.value;
	pass=x.password.value;
	c1=x.password.value.indexOf("|");
	c2=x.password.value.indexOf("&");
	c3=x.password.value.indexOf("!");

	submitOK="True";
	
	if ((name.length<6) || (name.length>15))
	{
		alert("Username should be 6-15 characters");
		submitOK="False";
	}
  
	if ((c1<0)&&(c2<0)&&(c3<0))
	{
		if ((pass.length<6) || (pass.length>15))
		{
			alert("Your password should be 6-16 characters");
			submitOK="False";
		}
	}
	else
	{  
		alert("Invalid characters in password");
		submitOK="False";
	}
	if (submitOK=="False")
	{
		return false;
	}
}

function validate_edit()
{
	x=document.edit_form;
	title=x.title.value;
	description=x.description.value;

	submitOK="True";
	
	if (title.length<1)
	{
		alert("Empty title");
		submitOK="False";
	}
  

	if (submitOK=="False")
	{
		return false;
	}
}

function validate_ch_pass()
{
	x=document.change_pass_form;
	
	c1=x.password.value.indexOf("|");
	c2=x.n_password.value.indexOf("|");
	c3=x.c_password.value.indexOf("|");
	
	c4=x.password.value.indexOf("&");
	c5=x.n_password.value.indexOf("&");
	c6=x.c_password.value.indexOf("&");
	
	c7=x.password.value.indexOf("!");
	c8=x.n_password.value.indexOf("!");
	c9=x.c_password.value.indexOf("!");

	pass=x.password.value;
	n_pass=x.n_password.value;
	c_pass=x.c_password.value;

	submitOK="True";
  
	if ((c1<0)&&(c2<0)&&(c3<0)&&(c4<0)&&(c5<0)&&(c6<0)&&(c7<0)&&(c8<0)&&(c9<0))
	{
		if ((pass.length<6) || (pass.length>16))
		{
			alert("Your password should be 6-16 characters");
			submitOK="False";
		}
		if ((n_pass.length<6) || (n_pass.length>16))
		{
			alert("Your new password should be 6-16 characters");
			submitOK="False";
		}
		if (c_pass!=n_pass)
		{
			alert("Confirmation fail");
			submitOK="False";
		}
	}
	else
	{  
		alert("Invalid characters in password");
		submitOK="False";
	}

	if (submitOK=="False")
	{
		return false;
	}
}

function validate_ch_email()
{
	x=document.change_email_form;

	c1=x.password.value.indexOf("|");
	c2=x.password.value.indexOf("&");
	c3=x.password.value.indexOf("!");
	at=x.email.value.indexOf("@");

	pass=x.password.value;

	submitOK="True";
	
	if (at==-1)
	{
		alert("Invalid E-mail");
		submitOK="False";
	}
  
	if ((c1<0)&&(c2<0)&&(c3<0))
	{
		if ((pass.length<6) || (pass.length>16))
		{
			alert("Your password should be 6-16 characters");
			submitOK="False";
		}
	}
	else
	{  
		alert("Invalid characters in password");
		submitOK="False";
	}

	if (submitOK=="False")
	{
		return false;
	}
}

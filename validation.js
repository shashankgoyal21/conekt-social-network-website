
function validate()
      {
		  
         if( document.myform.first_name.value == "" )
         {
            alert( "Please provide your first name!" );
            document.myform.name.focus() ;
			return false;
         }
         if( document.myform.last_name.value == "")
         {
            alert( "Please provide your last name" );
            document.myform.last_name.focus() ;
			return false;
         }
         if(document.myform.password.value =="" || document.myform.password.value.length <8)
		 {
			 alert("Minimum 8 character password required");
			 doucument.myform.password.focus();
			 return false;
		 }
		 if(document.myform.passverif.value =="" || document.myform.passverif.value.length <8 ||document.myform.password.value !=document.myform.passverif.value)
		 {
			 alert("Password missmatch");
			 doucument.myform.passverif.focus();
			 return false;
		 }
         if( document.myform.email.value == "" )
         {
            alert( "Please provide your Email!" );
            document.myform.email.focus() ;
			return false;
         }
         
		 if(document.myform.mobile.value.length != 10)
		 {
			 alert("Enter valid mobile number");
			 document.myform.mobile.focus();
			 return false;
		 }
	  if(document.myform.dob.value == "")
	  {
		  alert("Correct date format is : 1999/12/30");
		  document.myform.dob.focus();
		  return false;
	  }
	  if(document.myform.city.value=="")
	  {
		  alert("City cannot be left empty");
		  document.myform.city.focus();
		  return false;
	  }
	  if(document.myform.state.value=="")
	  {
		  alert("State cannot be left empty");
		  document.myform.state.focus();
		  return false;
	  }
	  else{
	  return true;}
	  }


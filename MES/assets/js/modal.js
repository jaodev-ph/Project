

   $(document).ready(function(){

    // --------------------- CHANGE PASSWORD --------------------------
	document.getElementById("changepass").addEventListener("click",
        function(event){
            event.preventDefault();  
            


        if (document.getElementById("txtoldPass").value == '') { 
        document.getElementById("error1").removeAttribute("hidden");
        document.getElementById("success1").setAttribute("hidden","");
        document.getElementById("error2").setAttribute("hidden","");
        document.getElementById("error3").setAttribute("hidden","");
        document.getElementById("error4").setAttribute("hidden","");
        document.getElementById("error5").setAttribute("hidden","");
        return;
    	} else if (document.getElementById("txtPass").value == '') { 
        document.getElementById("error2").removeAttribute("hidden");
        document.getElementById("success1").setAttribute("hidden","");
        document.getElementById("error1").setAttribute("hidden","");
        document.getElementById("error3").setAttribute("hidden","");
        document.getElementById("error4").setAttribute("hidden","");
        document.getElementById("error5").setAttribute("hidden","");
        return;
    	}else if (document.getElementById("txtComPass").value == '') { 
        document.getElementById("error3").removeAttribute("hidden");
        document.getElementById("success1").setAttribute("hidden","");
        document.getElementById("error1").setAttribute("hidden","");
        document.getElementById("error2").setAttribute("hidden","");
        document.getElementById("error4").setAttribute("hidden","");
        document.getElementById("error5").setAttribute("hidden","");
        return;
    	}
    	else {
        	var xmlhttp = new XMLHttpRequest();
       		xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
               var result = this.responseText;

               if(this.responseText =='success1'){
               document.getElementById("success1").removeAttribute("hidden");
        		document.getElementById("error1").setAttribute("hidden","");
        		document.getElementById("error2").setAttribute("hidden","");
        		document.getElementById("error3").setAttribute("hidden","");
        		document.getElementById("error4").setAttribute("hidden","");
        		document.getElementById("error5").setAttribute("hidden","");
        		document.getElementById("txtoldPass").value ='';
				document.getElementById("txtPass").value ='';
				document.getElementById("txtComPass").value ='';
          		}
          	   else if(this.responseText =='error4'){
          		 document.getElementById("error4").removeAttribute("hidden"); 
          		 document.getElementById("success1").setAttribute("hidden","");
        		document.getElementById("error1").setAttribute("hidden","");
        		document.getElementById("error2").setAttribute("hidden","");
        		document.getElementById("error3").setAttribute("hidden","");
        		document.getElementById("error5").setAttribute("hidden","");	
          		}
          	   else if(this.responseText =='error5'){
          		 document.getElementById("error5").removeAttribute("hidden");
          		 document.getElementById("success1").setAttribute("hidden","");
        		document.getElementById("error1").setAttribute("hidden","");
        		document.getElementById("error2").setAttribute("hidden","");
        		document.getElementById("error3").setAttribute("hidden","");
        		document.getElementById("error4").setAttribute("hidden","");	 	
          		}else{
          			document.getElementById("result_modal").innerHTML = this.responseText;
          		}

              
            }
        };
        	xmlhttp.open("GET", "../php/changepass.php?oldpass=" + document.getElementById("txtoldPass").value +"&newpass="+ document.getElementById("txtPass").value + "&compass=" + document.getElementById("txtComPass").value, true);
        	xmlhttp.send();
    	  }

        }

    	);  


	document.getElementById("cancel").addEventListener("click",
        function(event){
        	document.getElementById("success1").setAttribute("hidden","");
        	document.getElementById("error1").setAttribute("hidden","");
        	document.getElementById("error2").setAttribute("hidden","");
        	document.getElementById("error3").setAttribute("hidden","");
        	document.getElementById("error4").setAttribute("hidden","");
        	document.getElementById("error5").setAttribute("hidden","");
        	document.getElementById("txtoldPass").value ='';
			document.getElementById("txtPass").value ='';
			document.getElementById("txtComPass").value ='';
        }
		);  


 	document.getElementById("modalmenuclose").addEventListener("click",
        function(event){
        	document.getElementById("success1").setAttribute("hidden","");
        	document.getElementById("error1").setAttribute("hidden","");
        	document.getElementById("error2").setAttribute("hidden","");
        	document.getElementById("error3").setAttribute("hidden","");
        	document.getElementById("error4").setAttribute("hidden","");
        	document.getElementById("error5").setAttribute("hidden","");
        	document.getElementById("txtoldPass").value ='';
			document.getElementById("txtPass").value ='';
			document.getElementById("txtComPass").value ='';
        }
		); 


 // --------------------- ADD USER --------------------------
 	document.getElementById("adduser").addEventListener("click",
        function(event){
            event.preventDefault();

        if (document.getElementById("txtEmployee").value == '') { 
        document.getElementById("adderror1").removeAttribute("hidden");
        document.getElementById("addsuccess1").setAttribute("hidden","");
        document.getElementById("adderror2").setAttribute("hidden","");
        document.getElementById("adderror3").setAttribute("hidden","");
        document.getElementById("adderror4").setAttribute("hidden","");
        document.getElementById("adderror5").setAttribute("hidden","");
        document.getElementById("adderror6").setAttribute("hidden",""); 

        return;
    	} else if (document.getElementById("txtAddUser").value == '') { 
        document.getElementById("adderror2").removeAttribute("hidden");
        document.getElementById("addsuccess1").setAttribute("hidden","");
        document.getElementById("adderror1").setAttribute("hidden","");
        document.getElementById("adderror3").setAttribute("hidden","");
        document.getElementById("adderror4").setAttribute("hidden","");
        document.getElementById("adderror5").setAttribute("hidden","");
        document.getElementById("adderror6").setAttribute("hidden",""); 
        return;
    	}else if (document.getElementById("txtaddNewPass").value == '') { 
        document.getElementById("adderror3").removeAttribute("hidden");
        document.getElementById("addsuccess1").setAttribute("hidden","");
        document.getElementById("adderror1").setAttribute("hidden","");
        document.getElementById("adderror2").setAttribute("hidden","");
        document.getElementById("adderror4").setAttribute("hidden","");
        document.getElementById("adderror5").setAttribute("hidden","");
        document.getElementById("adderror6").setAttribute("hidden",""); 
        return;
    	}else if (document.getElementById("txtAddComPass").value == '') { 
        document.getElementById("adderror4").removeAttribute("hidden");
        document.getElementById("addsuccess1").setAttribute("hidden","");
        document.getElementById("adderror1").setAttribute("hidden","");
        document.getElementById("adderror2").setAttribute("hidden","");
        document.getElementById("adderror3").setAttribute("hidden","");
        document.getElementById("adderror5").setAttribute("hidden","");
        document.getElementById("adderror6").setAttribute("hidden",""); 
        return;
    	}else {

        	var xmlhttp = new XMLHttpRequest();
       		xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
               var result = this.responseText;

               if(this.responseText =='addsuccess1'){
                document.getElementById("addsuccess1").removeAttribute("hidden");
        		document.getElementById("adderror1").setAttribute("hidden","");
        		document.getElementById("adderror2").setAttribute("hidden","");
        		document.getElementById("adderror3").setAttribute("hidden","");
        		document.getElementById("adderror4").setAttribute("hidden","");
        		document.getElementById("adderror5").setAttribute("hidden","");
                document.getElementById("adderror6").setAttribute("hidden",""); 
        		document.getElementById("txtEmployee").value ='';
                document.getElementById("txtAddUser").value ='';
                document.getElementById("txtaddNewPass").value ='';
                document.getElementById("txtAddComPass").value ='';
          		}
                else if(this.responseText =='adderror6'){
                document.getElementById("adderror6").removeAttribute("hidden");
                document.getElementById("addsuccess1").setAttribute("hidden","");
                document.getElementById("adderror1").setAttribute("hidden","");
                document.getElementById("adderror2").setAttribute("hidden","");
                document.getElementById("adderror3").setAttribute("hidden","");
                document.getElementById("adderror4").setAttribute("hidden","");  
                document.getElementById("adderror5").setAttribute("hidden",""); 
                }
          	   else if(this.responseText =='adderror5'){
          		document.getElementById("adderror5").removeAttribute("hidden");
          		document.getElementById("addsuccess1").setAttribute("hidden","");
        		document.getElementById("adderror1").setAttribute("hidden","");
        		document.getElementById("adderror2").setAttribute("hidden","");
        		document.getElementById("adderror3").setAttribute("hidden","");
        		document.getElementById("adderror4").setAttribute("hidden","");	 ;	
                document.getElementById("adderror6").setAttribute("hidden",""); 
          		}else{
          			document.getElementById("result_modal2").innerHTML = this.responseText;
          		}

              
            }
        };
        	xmlhttp.open("GET", "../php/adduser.php?employeeCode=" + document.getElementById("txtEmployee").value +"&username="+ document.getElementById("txtAddUser").value + "&password=" + document.getElementById("txtaddNewPass").value + "&compass=" + document.getElementById("txtAddComPass").value + "&gender=" + document.getElementById("txtGender").value + "&auth=" + document.getElementById("txtAuth").value, true);
        	xmlhttp.send();
    	  }

        }

    	);  

			document.getElementById("adduser_cancel").addEventListener("click",
        function(event){
        	document.getElementById("addsuccess1").setAttribute("hidden","");
        	document.getElementById("adderror1").setAttribute("hidden","");
        	document.getElementById("adderror2").setAttribute("hidden","");
        	document.getElementById("adderror3").setAttribute("hidden","");
        	document.getElementById("adderror4").setAttribute("hidden","");
        	document.getElementById("adderror5").setAttribute("hidden","");
            document.getElementById("adderror6").setAttribute("hidden",""); 
        	document.getElementById("txtEmployee").value ='';
			document.getElementById("txtAddUser").value ='';
			document.getElementById("txtaddNewPass").value ='';
			document.getElementById("txtAddComPass").value ='';
        }
		);  


 	document.getElementById("modalmenuexit").addEventListener("click",
        function(event){
        	document.getElementById("addsuccess1").setAttribute("hidden","");
        	document.getElementById("adderror1").setAttribute("hidden","");
        	document.getElementById("adderror2").setAttribute("hidden","");
        	document.getElementById("adderror3").setAttribute("hidden","");
        	document.getElementById("adderror4").setAttribute("hidden","");
        	document.getElementById("adderror5").setAttribute("hidden","");
            document.getElementById("adderror6").setAttribute("hidden",""); 
        	document.getElementById("txtEmployee").value ='';
			document.getElementById("txtAddUser").value ='';
			document.getElementById("txtaddNewPass").value ='';
			document.getElementById("txtAddComPass").value ='';
        }
		); 

    $('#txtSearch').change(function() {


            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
               var result = this.responseText;

               if(result == "editerror1"){
                document.getElementById("editerror1").removeAttribute("hidden");
                document.getElementById("txtEditEmployee").value ='';
                document.getElementById("txtEditUser").value ='';
                document.getElementById("txtEditComPass").value ='';
                document.getElementById("txtEditNewPass").value ='';
                document.getElementById("txtEditModule").value ='';
                document.getElementById("txtEditGender").value ='';
                document.getElementById("txtEditAuth").value ='';
               }else{
                 res = result.split(",");
                 document.getElementById("txtEditEmployee").value = res[2];
                 document.getElementById("txtEditUser").value = res[3];
                 document.getElementById("txtEditComPass").value = res[5];
                 document.getElementById("txtEditNewPass").value = res[5];
                 document.getElementById("txtEditModule").value = res[1];
                 document.getElementById("txtEditGender").value = res[0];
                 document.getElementById("txtEditAuth").value = res[4];
                 document.getElementById("editerror1").setAttribute("hidden","");
                 document.getElementById("Edituser").removeAttribute("disabled","");
               
                }


                }
            
        };
            xmlhttp.open("GET", "../php/edituser.php?employeeCode=" + document.getElementById("txtSearch").value, true);
            xmlhttp.send();
          
    });




    document.getElementById("Edituser").addEventListener("click",
        function(event){
            event.preventDefault();  
            


        if (document.getElementById("txtEditEmployee").value == '') {
         document.getElementById("editerror2").removeAttribute("hidden"); 
         document.getElementById("Edituser").setAttribute("disabled","");
         document.getElementById("success1").setAttribute("hidden",""); 
         document.getElementById("editerror1").setAttribute("hidden","");    
         document.getElementById("editerror3").setAttribute("hidden",""); 
        return;
        } else if (document.getElementById("txtEditUser").value == '') { 
        document.getElementById("editerror2").removeAttribute("hidden"); 
        document.getElementById("Edituser").setAttribute("disabled","");
        document.getElementById("success1").setAttribute("hidden",""); 
        document.getElementById("editerror1").setAttribute("hidden","");    
        document.getElementById("editerror3").setAttribute("hidden","");     
        return;
        }else if (document.getElementById("txtEditComPass").value == '') { 
       document.getElementById("editerror2").removeAttribute("hidden"); 
       document.getElementById("Edituser").setAttribute("disabled","");
       document.getElementById("success1").setAttribute("hidden",""); 
       document.getElementById("editerror1").setAttribute("hidden","");    
       document.getElementById("editerror3").setAttribute("hidden",""); 
        return;
        }else if (document.getElementById("txtEditNewPass").value == '') { 
       document.getElementById("editerror2").removeAttribute("hidden"); 
       document.getElementById("Edituser").setAttribute("disabled","");
       document.getElementById("success1").setAttribute("hidden",""); 
       document.getElementById("editerror1").setAttribute("hidden","");    
       document.getElementById("editerror3").setAttribute("hidden",""); 
        return;
        }
        else if (document.getElementById("txtEditModule").value == '') { 
       document.getElementById("editerror2").removeAttribute("hidden"); 
       document.getElementById("Edituser").setAttribute("disabled","");
       document.getElementById("success1").setAttribute("hidden",""); 
       document.getElementById("editerror1").setAttribute("hidden","");    
       document.getElementById("editerror3").setAttribute("hidden",""); 
        return;
        }
        else if (document.getElementById("txtEditGender").value == '') { 
       document.getElementById("editerror2").removeAttribute("hidden"); 
       document.getElementById("Edituser").setAttribute("disabled","");
       document.getElementById("success1").setAttribute("hidden",""); 
       document.getElementById("editerror1").setAttribute("hidden","");    
       document.getElementById("editerror3").setAttribute("hidden",""); 
        return;
        }
        else if (document.getElementById("txtEditAuth").value == '') { 
       document.getElementById("editerror2").removeAttribute("hidden"); 
       document.getElementById("success1").setAttribute("hidden",""); 
       document.getElementById("editerror1").setAttribute("hidden","");    
       document.getElementById("editerror3").setAttribute("hidden",""); 
       document.getElementById("Edituser").setAttribute("disabled","");
        return;
        }
        else {
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
               var result = this.responseText;

               if( result  == 'editsuccess1'){
                document.getElementById("editsuccess1").removeAttribute("hidden");
                document.getElementById("Edituser").setAttribute("disabled","");
                document.getElementById("editerror2").setAttribute("hidden",""); 
                document.getElementById("editerror1").setAttribute("hidden","");    
                document.getElementById("editerror3").setAttribute("hidden","");
                document.getElementById("txtSearch").value ='';
                document.getElementById("txtEditEmployee").value ='';
                document.getElementById("txtEditUser").value ='';
                document.getElementById("txtEditNewPass").value ='';
                document.getElementById("txtEditComPass").value ='';
                document.getElementById("txtEditModule").value ='';
                document.getElementById("txtEditGender").value ='';
                document.getElementById("txtEditAuth").value ='';           
                }else if( result  == 'editerror3')
                {
                document.getElementById("editerror3").removeAttribute("hidden");
                document.getElementById("success1").setAttribute("hidden",""); 
                document.getElementById("editerror2").setAttribute("hidden",""); 
                document.getElementById("editerror1").setAttribute("hidden",""); 
                }else{
                    document.getElementById("result_modal4").innerHTML = this.responseText;
                }

              
            }
        };
            xmlhttp.open("GET", "../php/updateuser.php?employeeCode=" + document.getElementById("txtEditEmployee").value +"&user="+ document.getElementById("txtEditUser").value + "&compass=" + document.getElementById("txtEditComPass").value + "&newpass=" + document.getElementById("txtEditNewPass").value + "&newmodule=" + document.getElementById("txtEditModule").value + "&gender=" + document.getElementById("txtEditGender").value + "&auth=" + document.getElementById("txtEditAuth").value, true);
            xmlhttp.send();
          }

        }

        );

 

    document.getElementById("Edituser_cancel").addEventListener("click",
        function(event){
               
                document.getElementById("Edituser").setAttribute("disabled","");
                document.getElementById("success1").setAttribute("hidden",""); 
                document.getElementById("editerror2").setAttribute("hidden",""); 
                document.getElementById("editerror1").setAttribute("hidden","");    
                document.getElementById("editerror3").setAttribute("hidden",""); 
                document.getElementById("txtSearch").value ='';
                document.getElementById("txtEditEmployee").value ='';
                document.getElementById("txtEditUser").value ='';
                document.getElementById("txtEditNewPass").value ='';
                document.getElementById("txtEditComPass").value ='';
                document.getElementById("txtEditModule").value ='';
                document.getElementById("txtEditGender").value ='';
                document.getElementById("txtEditAuth").value ='';
        }); 


    });





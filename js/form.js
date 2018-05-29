//ajax_send_form function sends data to specific page
//page will be provided in php form array
function ajax_send_form(id='',method='',file='',handle_function){
	//see if handle_function is function or else return false
	if(typeof(handle_function) != 'function')
		return false;
	//see if form exist with that id
	if(!document.getElementById(id))
		return false;
	
	//that data will be available as POST
	
	var data = new FormData( document.getElementById(id) );
	//var req = new XMLHttpRequest();
	//req.send(data);
	// get mozzila flag
	// this code is not mine it makes shore that we have brawser compability
	var mozillaFlag = false;
	var XMLHttpRequestObject = false;
		
	if (window.XMLHttpRequest){	
		XMLHttpRequestObject = new XMLHttpRequest();	
		mozillaFlag = true;
	} 
	else if (window.ActiveXObject){	
		XMLHttpRequestObject = new ActiveXObject("Microsoft.XMLHTTP");
	}
	

	//now that we have XMLHttpRequestObject	ready let's make a call
	if(XMLHttpRequestObject){
		//opet file
		XMLHttpRequestObject.open(method,file);

	
		//when state changes call function
		XMLHttpRequestObject.onreadystatechange = function(){	
		//if status is OK
		if (XMLHttpRequestObject.readyState == 4 && XMLHttpRequestObject.status == 200){	
				//retrived text
				var text = XMLHttpRequestObject.responseText;
				//function that will handle text
				handle_function(text);
				delete XMLHttpRequestObject; //delete XMLHttpRequestObject
				XMLHttpRequestObject = null;//delete XMLHttpRequestObject
			}
		}	
		XMLHttpRequestObject.send(data);	//send data to file 		
	}	
}

/*
* allow only number insert on keypress 
* this if function that should be called on keypress 
* it shoul be added as onkeypress on input text fields
* when included on keypress it will disaloow anything except number
*/
function only_pos_int(evt) {
	var charCode = (evt.which) ? evt.which : event.keyCode
	if (charCode < 48 || charCode > 57)
		return false;
    return true;
}


/*
* allow only positive folat numbers
* this if function that should be called on keypress 
* it shoul be added as onkeypress on input text fields
* when included on keypress it will disaloow anything except number and dot
*/
function isPressedPositiveFloat(evt){
	evt = (evt) ? evt : window.event;
	var charCode = (evt.which) ? evt.which : event.keyCode
	if (charCode > 31 && (charCode != 46 &&(charCode < 48 || charCode > 57)))return false;
    return true;
}

//allow only positive and negative integers on press
function is_presed_signed_int(evt){
	var charCode = (evt.which) ? evt.which : event.keyCode
      if ( charCode != 45 && (charCode < 48 || charCode > 57)) 
		return false;
    return true;
}



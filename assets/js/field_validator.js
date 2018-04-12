
function checkNameField(data){
	var pattern = /[A-Za-zÜÕÄÖüõäö\. -]{3,30}/
	return pattern.test(data);
}

function checkEmailField(data){
	var pattern = /[A-Za-z0-9._-]+@[A-Za-z-]{1,20}\.[A-Za-z]{2,10}(\.[A-Za-z]{2,10})?/
	return pattern.test(data);
}

function checkPasswordField(data){
	var pattern = /[A-Za-zÜÕÄÖüõäö0-9.]{6,30}/
	return pattern.test(data);
}

function addNameFieldChangeListener(id){
	$(id).keyup(function(){
		if(checkNameField($(id).val())){
			$(id).parent().attr("class", "pt-3 has-success");
			removeErrorMessage("#reg_form_message_container", "name_message");
		} else {
			$(id).parent().attr("class", "pt-3 has-error");
			addErrorMessage("#reg_form_message_container", "name_message", "Nimi peab olema vähemalt 3 karakterit!");
		}
	});
}

function addEmailFieldChangeListener(id){
	$(id).keyup(function(){
		if(checkEmailField($(id).val())){
			$(id).parent().attr("class", "pt-3 has-success");
			removeErrorMessage("#reg_form_message_container", "email_message");
		} else {
			$(id).parent().attr("class", "pt-3 has-error");
			addErrorMessage("#reg_form_message_container", "email_message", "E-maili formaat pole õige!");
		}
	});
}

function addPasswordFieldChangeListener(id){
	$(id).keyup(function(){
		if(checkPasswordField($(id).val())){
			$(id).parent().attr("class", "pt-3 has-success");
			removeErrorMessage("#reg_form_message_container", "password_message");
		} else {
			$(id).parent().attr("class", "pt-3 has-error");
			addErrorMessage("#reg_form_message_container", "password_message", "Parool peab olema vähemalt 6 karakterit!");
		}
	});
}

function addErrorMessage(messageBoxId, messageId, message){
	console.log("yes");
	if($("#" + messageId).length == 0){
		$(messageBoxId).append("<p id=\"" + messageId + "\">" + message + "</p>");
		$(messageBoxId).attr("class", "pt-3 alert alert-warning");
	}
}

function removeErrorMessage(messageBoxId, messageId){
	$("#" + messageId).remove();
	if(isEmpty(messageBoxId)){
		$(messageBoxId).attr("class", "");
	}
	
}

function isEmpty(el){
      return $.trim($(el).html())=='';
  }
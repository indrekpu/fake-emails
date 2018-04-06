
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
		} else {
			$(id).parent().attr("class", "pt-3 has-error");
		}
	});
}

function addEmailFieldChangeListener(id){
	$(id).keyup(function(){
		if(checkEmailField($(id).val())){
			$(id).parent().attr("class", "pt-3 has-success");
		} else {
			$(id).parent().attr("class", "pt-3 has-error");
		}
	});
}

function addPasswordFieldChangeListener(id){
	$(id).keyup(function(){
		if(checkPasswordField($(id).val())){
			$(id).parent().attr("class", "pt-3 has-success");
		} else {
			$(id).parent().attr("class", "pt-3 has-error");
		}
	});
}


function resetValues() {
    $('#classG').empty();
    $('#classG').append(new Option('Please select', '', true, true));	
    $('#classG').attr("disabled", "disabled");	
	$('#number').empty();
    $('#number').append(new Option('Please select', '', true, true));	
    $('#number').attr("disabled", "disabled");	
}


function populateStan(xmlindata) {

var mySelect = $('#standard');
 $('#classG').disabled = false;
$(xmlindata).find("standard").each(function()
  {
  optionValue=$(this).find("id").text();
  optionText =$(this).find("description").text();
   mySelect.append($('<option></option>').val(optionValue).html(optionText));	
  });
}

function populateClass(xmlindata) {

var mySelect = $('#classG');
$('#classG').removeAttr('disabled');    
$(xmlindata).find("classification").each(function()
  {
  optionValue=$(this).find("id").text();
  optionText =$(this).find("description").text();
   mySelect.append($('<option></option>').val(optionValue).html(optionText));	
  });
}

function populateNumber(xmlindata) {

var mySelect = $('#number');;
 $('#number').removeAttr('disabled');  
$(xmlindata).find("numbername").each(function()
  {
  optionValue=$(this).find("id").text();
  optionText =$(this).find("number_name").text();
   mySelect.append($('<option></option>').val(optionValue).html(optionText));	
});
}
<!-- start Simple Custom CSS and JS -->
<script type="text/javascript">
/* Adding character limits to the story submission form */
// #form-field-custom_message is the message window
// #letter_counter is the text box that conveys remaining letter count for message box
// #form-field-form_name is the name window

//limiting message entry

var messageInput = document.querySelector("#form-field-custom_message");
var letterCounter = document.querySelector("#letter_counter p");
var messageLimit = 5000;

letterCounter.innerText = messageLimit + " Letters Remaining";

messageInput.addEventListener("keyup", function(){
  var messageLetters = messageInput.value.split("");
  letterCounter.innerText = (messageLimit - messageLetters.length) + " Letters Remaining";
  
  if(messageLetters.length >= messageLimit) {
    messageInput.value = messageInput.value.substring(0, messageLimit);
    LetterCounter.innerText = "0 Letters Remaining";
  }
});

//limiting name entry
var nameInput = document.querySelector("#form-field-form_name");
var nameLimit = 40;
nameInput.addEventListener("keyup", function(){
  var nameLetters = nameInput.value.split("");
  if(nameLetters.length >= nameLimit) {
    nameInput.value = nameInput.value.substring (0, nameLimit);
  }
});

//limiting email entry
var emailInput = document.querySelector("#form-field-form_email");
var emailLimit = 40;
emailInput.addEventListener("keyup", function(){
  var emailLetters = emailInput.value.split("");  
  if(emailLetters.length >= emailLimit) {
    emailInput.value = emailInput.value.substring (0, emailLimit);
  }   
});


</script>
<!-- end Simple Custom CSS and JS -->

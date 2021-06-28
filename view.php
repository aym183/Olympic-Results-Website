<!DOCTYPE html>
<html>
    <!-- This is the first php file of the task 4, this is the landing page which allows the user to register their email with AchieversUnion-->
    <!-- Below is all of the css styling to all of the individual elements-->
    <style>
       
       body{
    font-family: Arial;
    text-align: center;
    background-color:darkblue;
    color : black;
        p{
        font-family: Fantasy;
        }
}
table.table{
    text-allign:center;
    margin-left:auto;
    margin-right:auto;
}
.wow{
    background-color: aquamarine;
   /*padding from all up down left right increases distance if you right just padding*/ 
    padding: 20px;
    border-width: 5px;
    border-color:azure;
    border-style:ridge;
    position: relative;
    left: 20px;
}

h3{
    background-color: aquamarine;
   /*padding from all up down left right increases distance if you right just padding*/ 
    padding: 20px;
    border-width: 5px;
    border-color:azure;
    border-style:ridge;
    position: relative;
    left: 20px;
}
h3{
    text-align:center;
    position: relativel
    animation: bub;
    animation-duration: 2s;
}

/* ANIMATIONS FOR THE BUTTON ARE BELOW*/ 
.wow{
    text-align:center;
    position: relativel
    animation: bub;
    animation-duration: 2s;
}
@keyframes bub{
    0%{top:-50px}
    100%{top:200px}
}


.larger2{
    text-align:center;
    display: inline-block;
    color: 'aqua';
    text-decoration: none;
    padding: 1rem 2rem;
    border: black;
    
    animation-name: btn;
    opacity:0;
    margin-top:40px;
    animation-duration: 2s;
    animation-delay : 1s;
    animation-fill-mode: forwards;
    transition-property: transform;
    transition-duration:1s;

}

.larger2:hover{
    transform: rotateY(180deg);
}
@keyframes btn{
    0%{opacity:0}
    100%{opacity:1}
}

        </style>
<head>
<h1>
<?php 
echo "<h1 class= 'wow'>Welcome To AcheiversUnion</h1>"; 
echo "<hr>";
?>

</h1>
</head>

<!-- If you wish to subscribe to newsletter, Please click the subscribe button and then input email and click register to complete registration and be subscribed to the newsletter.
If you enter email and click the subscribe to newsletter button, the registration process  takes place and next page is shown-->
<p>
  <?php echo"<h3> The sole purpose of this site is to help you increase your knowledge of the performance of every country in the Olympics.<br><br>
    All you need to get started is your email and you're good to go! <br><br> Please click on 'Subscribe to our newsletter' before entering your email if you wish to subscribe to our newsletter.
    </h3>"?>
</p>



<?php echo '<br>'?>







<!--below are the JS and JQuery files that are used to add more functionality to the landing page-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"> </script>

<!--this JQuery script changes colour of text field when mouseover it-->
<script>

    $(document).ready(function(){
        $('#email').mouseover(function(){
            $(this).css({'background-color': 'beige'});
        });

        $('#confirmemail').mouseover(function(){
            $(this).css({'background-color': 'beige'});
        });


});
</script>

<!-- This is the javascript functionality used to verify email and confirm email values -->
<script>
   document.getElementById("email").required = true;
    document.getElementById("confirmemail").required = true;
function validateEmails() { 
	
	 var email = document.getElementById("email").value;
	 var confirmEmail = document.getElementById("confirmemail").value;
     if (email != confirmEmail) {  
		alert("Email and Confirm Email are not the same!");
		return false;
	 }
	 else{
        return true;
	 }
}
</script>




<body style="background-image: url('pexels-madison-inouye-1831234.jpg');">




<!--below is the form where the user inputs the email and the confirm email and submits it.
After email and confirm email validated, next page loads-->
<form action = 'view2.html' onsubmit = 'return validateEmails()' method = 'get' >
    <table class='table'>
    <tr>
        <td><label for="email">Email:</label></td>
        <td><input name="email" type="email" class="larger" id="email" value=""  required></td>
</tr>
<tr>
        <td><label for="cemail">Confirm Email:</label></td>
        <td><input name="cemail" type="email" class="larger" id="confirmemail" value="" required>
</tr>   
<tr> 
       <td><input type="submit"  name="submit" id="submit" value="Register" class="larger2" ></td>
       <td><button name="submit2"  id="submit2" class="larger2" >Subscribe to our newsletter</button></td>


</tr>
</form>

</table>
<!-- This is where AJAX has been used to help customers subscribe to newsletter, when button is clicked, the user has subscribed to newsletter-->
<script>

    function myFunction() {
    var httpRequest = new XMLHttpRequest();
    
    httpRequest.onreadystatechange = function() {
                                  
    if (this.readyState == 4 && this.status == 200) {             
        document.getElementById("MYID").innerHTML = httpRequest.responseText;
}
     
};
    
httpRequest.open("GET", "load.php", true);
httpRequest.send();
    }
var elmnt = document.getElementById("submit2");
elmnt.addEventListener("click", myFunction);
     
</script>


<br><br><br><br><br><br><br><br><br><br><br><br><hr>
<?php 

echo"<h3 id = 'MYID'>COPYRIGHTS RESERVED</h3>";
?>
</body>
</html>


<?php

//Server side validation για μια υποτυπώδης ασφάλεια
if ($_SERVER['REQUEST_METHOD'] == 'POST') //Αν ο server λάβει POST request
{
    //Αν πατηθεί το submit
    if (isset($_POST['mailSubmit']))
    {
        $errors = array("fullname"=>"", "email"=>"", "subject"=>"", "noErrors"=>""); //Αρχικοποίηση πίνακα σφαλμάτων 
    
        if(!preg_match("/^[a-zA-Z\'\-\040]+$/",$_POST['fullnameMail']) || empty($_POST['fullnameMail'])) //validation του ονόματος
        {
            $errors["fullname"] = "Invalid fullname"; //Σφάλμα ονόματος
        }
           
        if(!filter_var($_POST['emailMail'], FILTER_VALIDATE_EMAIL)) //validation του email
        {
            $errors["email"] = "Invalid email";
        }

        if(trim($_POST['subjectMail']) == "") //validation του σχολίου
        {
            $errors["subject"] = "Invalid subject"; 
        }
        
        if ($errors["fullname"]=="" && $errors["email"]=="" && $errors["subject"]=="") //Αν όλα είναι εντάξει, δλδ αν το errors array δεν έχει χρησιμοποιηθεί
        {
            $errors["noErrors"] = "Success!";
            
            //Αποστολή μορφοποιημένου email μέσω javascript με θέμα, το όνομα του αποστολέα και κυρίος θέμα, το σχόλιο του
            echo '
            <script>
                window.open("mailto:rekkles@gmail.com?subject=From%20'.$_POST['fullnameMail'].'&body='.$_POST['subjectMail'].'"); 
            </script>
            ';
        }
    }
} 
?>

<!DOCTYPE HTML>
<html>
<head>
    <title>Contact</title>

    <meta charset="utf-8">

    <!--Fonts-->
    <link href="https://fonts.googleapis.com/css?family=Oswald&display=swap" rel="stylesheet">

    <!--Icons-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!--Tab Icon-->
    <link rel="icon" href="Images/FnaticIcon.png">

    <!--CSS-->
    <link rel="stylesheet" type="text/css" href="css/default.css">
</head>
<body>

<!--NAVIGATION BAR-->
<header>
    <nav>       
        <ul>           
            <li><a href="index.php"><i class="fa fa-fw fa-home"></i>Home</a></li>
            <li><a href="about.php"><i class="fa fa-fw fa-search"></i>About</a></li>
            <li><a href="merchandise.php"><i class="fa fa-fw fa-truck"></i>Merchandise</a></li>
            <li><a href="contact.php"><i class="fa fa-fw fa-envelope"></i>Contact</a></li>
        </ul>       
    </nav>
</header><br><br>

<!--ΦΟΡΜΑ-->
<div stye="text-align:center">
    <h3 style="text-align:center; font-size:35px;">Contact</h3>
    <form name="contactForm" style="text-align:center;" method = "post">
            <div>
                <!--Καθε input παίρνει τιμές σύμφωνα με την τιμή της αντίστοιχης μεταβλητής στον server. 
                Αν ο χρήστης δεν ακολουθήσει τους κανόνες θα του πετάει σφάλμα το οποίο είναι ενα απλό span που παίρνει τιμές 
                ανάλογα με το αντίστοιχο σφάλμα στον server. Αμα κάνει λάθος ενα πεδίο και πατήσει submit, τα υπόλοιπα πεδία δεν γίνονται reset 
                παραμόνο το λάθος. Επειδή υπάρχουν θέματα με τις αρχικοποιήσεις των σφαλμάτων έχει χρησιμοποιηθεί ο operator @ που αγνοεί το σφάλμα της έκφρασης-->
                <label for="fullnameID">Fullname</label><br> 
                <input type="text" class="inputText" name="fullnameMail" id="fullnameID" value="<?php echo @$_POST['fullnameMail'];?>"><br>
                <span style="color: red; margin:0;"><?php echo @$errors["fullname"]; ?></span><br>
                <label for="emailID">Email</label><br>
                <input type="text" class="inputEmail" name="emailMail" id="emailID" value="<?php echo @$_POST['emailMail'];?>"><br>
                <span style="color: red; margin:0;"><?php echo @$errors["email"]; ?></span><br>
                <label for="subjectID" style="vertical-align: top;">Subject</label><br>
                <textarea name="subjectMail" id="subjectID" placeholder="Write something..."><?php echo @$_POST['subjectMail'];?></textarea><br>
                <span style="color: red; margin:0;"><?php echo @$errors["subject"]; ?></span><br><br>
            </div>

            <input class="submitInput" type="submit" name="mailSubmit" id="submitBtnID" value="Submit">
            <input class="submitInput" type="button" name="mailReset" id="resetBtnID" value="Reset"><br> 
            <span style="color: green; margin:0; font-size: 150%;"><?php echo @$errors["noErrors"]; ?></span><br> 
            
            <p style="color:red;">*All fields are required <br>*For fullname use only only characters of the Latin Alphabet</p>
    </form>
</div>

<!--FOOTER-->
<p class="footerText"> Powered by Lefteris Kontouris<br>General Assigment for Network Technologies Labs 2019</p>


<script>
//RESET BUTTON
document.getElementById('resetBtnID').onclick = function()
{
    document.getElementById("fullnameID").value = "";
    document.getElementById("emailID").value = "";
    document.getElementById("subjectID").value = "";
}
</script>

</body>

</html>


<?php
session_start();

$itemID = array(0, 1, 2, 3, 4, 5);

$itemName = array(
    "White Shirt 1", 
    "White Shirt 2", 
    "Fnatic Jacket",
    "Mouse - Rekkles Edition",
    "Mousepad - Rekkles Edition",
    "Elo Boost");

//Server side validation για μια υποτυπώδη ασφάλεια
if ($_SERVER['REQUEST_METHOD'] == 'POST') //Αν ο server λάβει POST request
{
    //Αν πατηθεί το submit
    if (isset($_POST['orderSubmit']))
    {
        //λίστα με errors για κάθε input
        $errorsOrder = array("username"=>"","password"=>"","fullname"=>"","email"=>"","birthday"=>"","address"=>"",
        "payment"=>"","subject"=>"","noErrors"=>""); 
    
        //Κάνει validate όλα τα στοιχεία που δόθηκαν
        if(!preg_match("/^[a-zA-Z]*$/",$_POST['username']) || empty($_POST['username'])) 
        {
            $errorsOrder["username"] = "Invalid username. Use only characters of the Latin Alphabet"; 
        }

        if(!preg_match("/^[a-zA-Z]*$/",$_POST['password']) || empty($_POST['password'])) 
        {
            $errorsOrder["password"] = "Invalid password. Use only characters of the Latin Alphabet"; 
        }

        if(!preg_match("/^[a-zA-Z\'\-\040]+$/",$_POST['fullnameOrder']) || empty($_POST['fullnameOrder'])) 
        {
            $errorsOrder["fullname"] = "Invalid fullname. Use only characters of the Latin Alphabet"; 
        }
           
        if(!filter_var($_POST['emailOrder'], FILTER_VALIDATE_EMAIL) || empty($_POST['emailOrder'])) 
        {
            $errorsOrder["email"] = "Invalid email";
        }

        if(empty($_POST['birthday']))
        {
            $errorsOrder["birthday"] = "Invalid birthday"; 
        }

        if(empty($_POST['address']))
        {
            $errorsOrder["address"] = "Invalid address"; 
        }

        if(!isset($_POST['paymentMeth']))
        {
            $errorsOrder["payment"] = "Please choose a payment method"; 
        }

        if(trim($_POST['subjectOrder']) == "") 
        {
            $errorsOrder["subject"] = "Invalid comments"; 
        }
        
        //Αν όλα είναι εντάξει, δλδ αν το errors array δεν έχει χρησιμοποιηθεί
        if ($errorsOrder["username"]=="" && $errorsOrder["password"]=="" && $errorsOrder["fullname"]=="" && $errorsOrder["email"]=="" && 
            $errorsOrder["birthday"]=="" && $errorsOrder["address"]=="" && $errorsOrder["payment"]=="" && $errorsOrder["subject"]=="") 
        {
            //Επιτυχία!
            $errorsOrder["noErrors"] = "Success! Your order has been placed!";
            
            InsertDataToDB();
        }
    }
} 

//Συνάρτηση υπεύθυνη για την εισαγωγή των στοιχείων στη βάση
function InsertDataToDB()
{
    //Τα ονόματα των προιόντων
    $itemName = array(
        "White Shirt 1", 
        "White Shirt 2", 
        "Fnatic Jacket",
        "Mouse - Rekkles Edition",
        "Mousepad - Rekkles Edition",
        "Elo Boost");
    
    //Έλεγχος των προιόντων που έχουν επιλεχθεί και εισαγωγή τους σε πίνακα ώστε έπειτα να δημιουργηθεί ενα string για την database
    $orderItems = array("", "", "", "", "", "", "");
    for ($i=0; $i<7; $i++)
    {
        //Εισαγωγή της τελικής τιμής στην τελευταία γραμμή του πίνακα 
        if($i==6)
        {
            $orderItems[6]= "Total Price: {$_SESSION['totalPrice']}";
            break;
        }

        //Αν έχει επιλεχθεί αυτο το προιόν...
    	if(@$_SESSION["quantity{$i}"] > 0)
        {
            $orderItems[$i] = "{$itemName[$i]}: {$_SESSION["quantity{$i}"]}";
        }     
    }
    
    //Διαδικασία εισαγωγής
    $servername = "localhost";
    $dbUsername = "root";
    $dbPassword = "";
    $dbname = "orders";
    $conn = mysqli_connect($servername, $dbUsername, $dbPassword, $dbname);

    if (!$conn) 
    {      
        die("Connection failed: " . mysqli_connect_error());
    }

    mysqli_set_charset($conn, "utf8");

    $username = $_POST['username'];
    $password = $_POST['password'];
    $fullname = $_POST['fullnameOrder'];
    $email = $_POST['emailOrder'];
    $birthday = $_POST['birthday'];
    $address = $_POST['address'];
    $paymentMeth = $_POST['paymentMeth'];
    $orderDetails = implode(" ", $orderItems); //Η συνάρτηση implode δημιουργεί ενα string με τα στοιχεία του πίνακα($orderItems) και ανάμεσα τους βάζει κενό(" ")
    $comments = $_POST['subjectOrder'];

    $sql = "INSERT INTO registers 
    values ('$username', '$password', '$fullname', '$email', '$birthday', '$address', '$paymentMeth', '$orderDetails', '$comments')";

    if($conn->query($sql))
    {
        mysqli_close($conn);  
    }
    else
    {
        echo "Error: ". $sql ."
        ". $conn->error;
    }
}
?>

<!DOCTYPE HTML>
<html>
<head>
    <title>Order</title>

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
</header>

<h3 style="font-size:35px; padding-top:50px; text-align:center;">Finish Order</h3>

<div style="text-align:center;">
    <span style="color: green; margin:0; font-size: 150%;" ><?php echo @$errorsOrder["noErrors"]; ?></span>
</div>

<div stye="text-align:center">
    <form name="orderForm" style="text-align:center;" method = "post">
        <div>
            <!--Λογική παρόμοια με αυτη του Contact.php όσον αφορά το validation των στοιχείων που δόθηκαν απο τον χρήστη-->
            <label for="username">Username</label><br> 
            <input type="text" class="inputText" name="username" id="username" value="<?php echo @$_POST['username'];?>"><br>
            <span style="color: red; margin:0;"><?php echo @$errorsOrder["username"]; ?></span><br>

            <label for="password">Password</label><br> 
            <input type="password" class="inputText" name="password" id="password" value="<?php echo @$_POST['password'];?>"><br>
            <span style="color: red; margin:0;"><?php echo @$errorsOrder["password"]; ?></span><br>

            <label for="fullname">Fullname</label><br> 
            <input type="text" class="inputText" name="fullnameOrder" id="fullname" value="<?php echo @$_POST['fullnameOrder'];?>"><br>
            <span style="color: red; margin:0;"><?php echo @$errorsOrder["fullname"]; ?></span><br>

            <label for="email">Email</label><br>
            <input type="text" class="inputEmail" name="emailOrder" id="email" value="<?php echo @$_POST['emailOrder'];?>"><br>
            <span style="color: red; margin:0;"><?php echo @$errorsOrder["email"]; ?></span><br>

            <label for="birthday">Birthday</label><br>
            <input type="date" class="inputText" name="birthday" id="birthday" value="<?php echo @$_POST['birthday'];?>"><br>
            <span style="color: red; margin:0;"><?php echo @$errorsOrder["birthday"]; ?></span><br>

            <label for="address">Address</label><br>
            <input type="text" class="inputText" name="address" id="address" value="<?php echo @$_POST['address'];?>"><br>
            <span style="color: red; margin:0;"><?php echo @$errorsOrder["address"]; ?></span><br>

            <div>
                <h3 style="margin:0;">Payment methods</h3>
                <label class="radioLabel" for="paymentMeth">Paypal</label>
                <input type="radio" name="paymentMeth" id="paymentMeth" value="Paypal"></input><br>
                <label class="radioLabel" for="paymentMeth">Visa</label>
                <input type="radio" name="paymentMeth" id="paymentMeth" value="Visa"></input><br>
                <label class="radioLabel" for="paymentMeth">Mastercard</label>
                <input type="radio" name="paymentMeth" id="paymentMeth" value="Mastercard"></input><br> 
                <label class="radioLabel" for="paymentMeth">Viva wallet</label>
                <input type="radio" name="paymentMeth" id="paymentMeth" value="VivaWallet"></input><br>
                <span style="color: red; margin:0;"><?php echo @$errorsOrder["payment"]; ?></span><br>
            </div> 
                
            <h2>Order details:</h2>
            <table class="ShoppingCart" style="border:1px solid black; text-align:center;" align="center">
                <tr> <th>Item</th><th>Quantity</th><th>Price</th> </tr>                                   
                <tr> <td style="text-align: center;"><?php echo $itemName[0]; ?></td><td style="text-align: center;"><?php echo @$_SESSION['quantity0']; ?></td><td style="text-align: center;"><?php echo @$_SESSION['price0']; ?></td> </tr>                                         
                <tr> <td style="text-align: center;"><?php echo $itemName[1]; ?></td><td style="text-align: center;"><?php echo @$_SESSION['quantity1']; ?></td><td style="text-align: center;"><?php echo @$_SESSION['price1']; ?></td> </tr>
                <tr> <td style="text-align: center;"><?php echo $itemName[2]; ?></td><td style="text-align: center;"><?php echo @$_SESSION['quantity2']; ?></td><td style="text-align: center;"><?php echo @$_SESSION['price2']; ?></td> </tr>
                <tr> <td style="text-align: center;"><?php echo $itemName[3]; ?></td><td style="text-align: center;"><?php echo @$_SESSION['quantity3']; ?></td><td style="text-align: center;"><?php echo @$_SESSION['price3']; ?></td> </tr>
                <tr> <td style="text-align: center;"><?php echo $itemName[4]; ?></td><td style="text-align: center;"><?php echo @$_SESSION['quantity4']; ?></td><td style="text-align: center;"><?php echo @$_SESSION['price4']; ?></td> </tr>
                <tr> <td style="text-align: center;"><?php echo $itemName[5]; ?></td><td style="text-align: center;"><?php echo @$_SESSION['quantity5']; ?></td><td style="text-align: center;"><?php echo @$_SESSION['price5']; ?></td> </tr>      
                <tr> <td></td><td></td><th style="color:red;">Total Price: <?php echo @$_SESSION['totalPrice']; ?> $</th> </tr>
            </table><br>
            
            <label for="subject" style="vertical-align: top;">Comments</label><br>
            <textarea name="subjectOrder" id="subject" placeholder="Write something..."><?php echo @$_POST['subjectOrder'];?></textarea><br>
            <span style="color: red; margin:0;"><?php echo @$errorsOrder["subject"]; ?></span>
        </div><br>

        <input class="submitInput" type="submit" name="orderSubmit" id="orderSubmitID" value="Submit">
        <input class="submitInput" type="submit" name="orderReset" id="orderReset" value="Reset"><br><br>
          
        <p style="color:red;">*All fields are required <br>*For username, password and fullname use only only characters of the Latin Alphabet</p>
    </form>
</div>

<!--FOOTER-->
<p class="footerText"> Powered by Lefteris Kontouris<br>General Assigment for Network Technologies Labs 2019</p>

<script>
//RESET BUTTON
document.getElementById('orderReset').onclick = function()
{
    document.getElementById("username").value = "";
    document.getElementById("password").value = "";
    document.getElementById("fullname").value = "";
    document.getElementById("email").value = "";
    document.getElementById("birthday").value = "";
    document.getElementById("address").value = "";
    document.getElementById("paymentMeth").value = "";
    document.getElementById("subject").value = "";
}
</script>
</body>
</html>
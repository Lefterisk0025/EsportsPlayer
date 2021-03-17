<?php
session_start();

$itemID = array(0, 1, 2, 3, 4, 5);

//Εικόνες
$itemImage = array(
    "Images/Merchandise/WhiteShirt1.png",
    "Images/Merchandise/WhiteShirt2.png",
    "Images/Merchandise/FNCjacket.png",
    "Images/Merchandise/RekklesMouse.png",
    "Images/Merchandise/rekklesMousepad.png",
    "Images/Merchandise/eloBoost.png");

//Τα ονόματα των προιόντων
$itemName = array(
    "White Shirt 1", 
    "White Shirt 2", 
    "Fnatic Jacket",
    "Mouse - Rekkles Edition",
    "Mousepad - Rekkles Edition",
    "Elo Boost");

//Τιμές των προιόντων ανα μονάδα
$itemPrice = array(20, 20, 45, 80, 25, 50);

//Αν 'έρθει' POST request
if ($_SERVER['REQUEST_METHOD'] === 'POST')
{
    //Αν πατηθεί το reset
    if(isset($_POST['cartReset']))
    {
        //Μηδενίζει όλες τις μεταβλτητές που αφορούν τα προιόντα καθώς και την τελική τιμή
        for($i=0; $i<6; $i++)
        {
            $_SESSION["quantity{$i}"] = "";
            $_SESSION["price{$i}"] = "";      
        }
        $_SESSION['totalPrice'] = "";
    }

    //Κάποιο remove 
    for($i=0; $i<6; $i++)
    {
        //Αν πατηθεί
        if(isset($_POST["remove{$i}"]))
        {
            //μηδενίζονται τα αντίστοιχα στοιχεία 
            $_SESSION["quantity{$i}"] = "";
            $_SESSION["price{$i}"] = "";      
        }
    }

    //Κάποιο add to cart κουμπί 
    for($i=0; $i<6; $i++)
    {
        //Αν πατηθεί, το καλάθι αγορών ανανεώνεται σύμφωνα με τα στοιχεία που έλαβε απο το χρήστη 
        if(isset($_POST["addToCart{$i}"]))
        {
            if($_POST["quantity{$i}"] > 0)
            {
                //Χρησιμοποιύνται μεταβλητές SESSION ώστε οι μεταβλητές να μην επηρεάζονται όταν γίνεται refresh(πχ αν προστεθεί κάποιο άλλο προιόν)
                $_SESSION["quantity{$i}"] = $_POST["quantity{$i}"]; 
                $_SESSION["price{$i}"] = $_POST["quantity{$i}"] * $itemPrice[$i];  
            }
            else
            {
                $error = "*Invalid addition";
            }   
        }
    }

    //Όταν γίνει μια αλλαγή ανανεώνεται η τελική τιμή
    $_SESSION['totalPrice'] = ""; 
    for ($i=0; $i<6; $i++)
    {
        @$_SESSION['totalPrice'] += $_SESSION["price{$i}"];
    }

    //Checkout
    if(isset($_POST['checkout']))
    {
        //Έλεγχος για το αν έχουν προστεθεί προιόντα στην κάρτα οταν πατηθεί το checkout (μην είναι άδεια.....)
        for($i=0; $i<6; $i++)
        {
            if($_SESSION["quantity{$i}"] != 0)
            {
                header("Location: http://localhost/GeneralAssignment/PaymentPage.php");
                break;
            } 
            else
            {
                $error = "*Please add at least 1 product";
            }       
        } 
    }
}
?>

<!DOCTYPE HTML>
<html>
<head>
    <title>Merchandise</title>

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

<h3 style="font-size:35px; padding-top:50px; text-align:center;">Merchandise</h3>

<!--ΠΙΝΑΚΑΣ ΠΡΟΙΟΝΤΩΝ-->
<div class="shopFlex">
    <form method="post"> 
        <?php
            for($i=0; $i<6; $i++) //Δημιουργεί ένα grid καρτών με τιμές σύμφωνα με τις μεταβλητές στα arrays του server
            {
                //Στό name χρησιμοποίεται το καθολικό όνομα του input, πχ quantity, ακολουθούμενο με το αντίστοιχο ID, πχ $itemID[0], = 0 του ώστε να είναι εφικτή η αναγνώριση του απο τον server 
                echo'
                <div class="ItemContainer">
                    <img class="ItemImage" src="'.$itemImage[$i].'" alt="item" style="width:100%">       
                    <h3 style="font-size:25px;">'.$itemName[$i].'</h3>
                    <p style="font-size:25px;">'.$itemPrice[$i].'$</p>
                    <input class="quantityInput" type="number" name="quantity'.$itemID[$i].'" id="quantity'.$itemID[$i].'" placeholder="Quantity"><br><br> 
                    <input class="Button buyButton" type="submit" name="addToCart'.$itemID[$i].'"  id="buyItem'.$itemID[$i].'" value="Add To Cart">    
                </div>';    
            }
        ?>
    </form>
</div>

<!--ΚΑΛΑΘΙ ΑΓΟΡΩΝ-->
<div>
    <form method="post">
        <h2 style="margin-left:63px;">Shopping Cart:</h2>
        <table class="ShoppingCart">
            <tr> <th>Item</th><th>Quantity</th><th>Price</th> </tr>  
             <!--Τα ονόματα, οι ποσότητες και οι τιμές ανανεώνονται σύμφωνα με την κατάσταση τους στον server-->                                
            <tr> <td style="text-align: center;"><?php echo $itemName[0]; ?></td><td style="text-align: center;"><?php echo @$_SESSION['quantity0']; ?></td><td style="text-align: center;"><?php echo @$_SESSION['price0']; ?></td>
            <td style="text-align: center;"><input class="removeBtn" type="submit" name="remove0" value="Remove"></td> </tr> 

            <tr> <td style="text-align: center;"><?php echo $itemName[1]; ?></td><td style="text-align: center;"><?php echo @$_SESSION['quantity1']; ?></td><td style="text-align: center;"><?php echo @$_SESSION['price1']; ?></td>
            <td style="text-align: center;"><input class="removeBtn" type="submit" name="remove1" value="Remove"></td> </tr>

            <tr> <td style="text-align: center;"><?php echo $itemName[2]; ?></td><td style="text-align: center;"><?php echo @$_SESSION['quantity2']; ?></td><td style="text-align: center;"><?php echo @$_SESSION['price2']; ?></td>
            <td style="text-align: center;"><input class="removeBtn" type="submit" name="remove2" value="Remove"></td> </tr>

            <tr> <td style="text-align: center;"><?php echo $itemName[3]; ?></td><td style="text-align: center;"><?php echo @$_SESSION['quantity3']; ?></td><td style="text-align: center;"><?php echo @$_SESSION['price3']; ?></td>
            <td style="text-align: center;"><input class="removeBtn" type="submit" name="remove3" value="Remove"></td> </tr>

            <tr> <td style="text-align: center;"><?php echo $itemName[4]; ?></td><td style="text-align: center;"><?php echo @$_SESSION['quantity4']; ?></td><td style="text-align: center;"><?php echo @$_SESSION['price4']; ?></td>
            <td style="text-align: center;"><input class="removeBtn" type="submit" name="remove4" value="Remove"></td> </tr>

            <tr> <td style="text-align: center;"><?php echo $itemName[5]; ?></td><td style="text-align: center;"><?php echo @$_SESSION['quantity5']; ?></td><td style="text-align: center;"><?php echo @$_SESSION['price5']; ?></td>
            <td style="text-align: center;"><input class="removeBtn" type="submit" name="remove5" value="Remove"></td> </tr>  

            <tr> <td></td><td></td><th>Total Price: <?php echo @$_SESSION['totalPrice']; ?> $</th> </tr>
        </table>
        <input type="submit" class="Button checkoutBtn" name="checkout" id="checkout" value="Checkout">
        <input type="submit" class="Button checkoutBtn"  name="cartReset" id="cartReset" value="Reset"><br><br>
        <span style="color: red; margin:0; margin-left:50px;"><?php echo @$error; ?></span><br>
    </form>
</div>

<!--FOOTER-->
<p class="footerText"> Powered by Lefteris Kontouris<br>General Assigment for Network Technologies Labs 2019</p>

</body>
</html>
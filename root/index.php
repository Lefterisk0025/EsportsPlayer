<!DOCTYPE HTML>
<html>
<head>
    <title>Home Page</title>

    <meta charset="utf-8">

    <!--Fonts-->
    <link href="https://fonts.googleapis.com/css?family=Oswald&display=swap" rel="stylesheet">

    <!--Nav Bar Icons-->
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

<img id='HomeImage' src="Images/homePageImage.jpg" alt="Rekkles"><br><br>

<!--ΕΙΚΟΝΑ ΜΕ ΚΕΙΜΕΝΟ ΣΤΑ ΔΕΞΙΑ-->
<div class="image2Container">
    <img id='HomeImage2' src="Images/lol-rekkles-slams-worlds-seeding-after-fnatic-draw-group-of-death2.jpg" alt="RekklesPlayingLeague">
    <p id='HomeImage2Text'>Martin "Rekkles" Larsson is a League of Legends esports player, currently bot laner for Fnatic</p> 
</div><br><br><br>

<h1 style="text-align:center; color:#ff6600;">The pillars of his career:</h3>

<!--ΕΙΚΟΝΕΣ ΜΕ ΛΙΝΚ-->
<div>
    <table style="width:100%;">
        <tr>
        <td align="center">
            <div class="ImageContaier">
                <img src="Images/FnaticLogo.png" alt="FnaticLogo" class="Image" style="width:100%;">
                <div class="Overlay">
                    <div class="content">
                        <span class="textAnim" style="margin-bottom: 10px;">Team</span>                    
                        <input type="button" class="Button" id="toFNC" value="Visit"></input>
                    </div>
                </div>
            </div>
        </td>
        <td align="center">
            <div class="ImageContaier">
                <img src="Images/OPGGLogo.png" alt="OPGGLogo" class="Image" style="width:100%;">
                <div class="Overlay">
                    <div class="content">
                        <span class="textAnim" style="margin-bottom: 10px;">Skill</span>
                        <input type="button" class="Button" id="toOPGG" value="Visit"></input>
                    </div>
                </div>
            </div>
        </td>
        <td align="center">
            <div class="ImageContaier">
                <img src="Images/LOLLogo2.png" alt="LOLLogo" class="Image" style="width:100%;">
                <div class="Overlay">
                    <div class="content">
                        <span class="textAnim" style="margin-bottom: 10px;">The Game</span>
                        <input type="button" class="Button" id="toLOL" value="Visit"></input>
                    </div>
                </div>
            </div>
        </td>
        </tr>
    </table>
</div><br>

<div class="ImageContaier Image3Contaier">
    <img src="Images/homeImage3.png" alt="homeImage3" class="Image" style="width:100%;">
    <div class="Overlay">
        <div class="content img3Content">
            <span class="textAnim fbpageText" style="margin-bottom: 10px;">Facebook Page:</span>
            <input type="button" class="Button img3Btn" id="toFB" value="Visit"></input>    
        </div>
    </div>
</div><br><br>

<!--FOOTER-->
<p class="footerText"> Powered by Lefteris Kontouris<br>General Assigment for Network Technologies Labs 2019</p>


<script>
//ΛΕΙΤΟΥΡΓΗΚΟΤΗΤΑ ΤΩΝ ΠΑΡΑΠΑΝΩ ΚΟΥΜΠΙΩΝ
document.getElementById('toFNC').onclick = function()
{
    window.location.href = "http://www.fnatic.com";
} 

document.getElementById('toOPGG').onclick = function()
{
    window.location.href = "https://euw.op.gg/summoner/userName=Spencer+Reid";
} 

document.getElementById('toLOL').onclick = function()
{
    window.location.href = "https://play.euw.leagueoflegends.com/en_GB";
}

document.getElementById('toFB').onclick = function()
{
    window.location.href = "https://www.facebook.com/RekklesLoL";
} 
</script>

</body>

</html>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<nav class="w3-sidenav w3-collapse w3-card-2 w3-large" id="navcontainer">
  <ul id="navlist">
    <li><a href="javascript:void(0)" onclick="w3_close()" class="w3-closenav w3-large w3-hide-large">Close &times;</a></li>
    <li><a href="/EN/index.php" target="_parent">All Courses</a></li>
    <li><a href="index.php" target="_parent">{cursus}</a></li>
    <li><a href="cursus.php" target="_parent">Course details</a></li>
    <li><a href="programma.php">Programme</a></li>
    <li><a href="aanmelding.php" target="_parent">Registration</a></li>
    <li><a href="plaats.php" target="_parent">{locatie}, the venue</a></li>
    <div class="w3-accordion"> 
    <a onclick="myAccFunc('LP')" href="#"><em>La Pellegrina</em> <i class="fa fa-caret-down"></i></a>
        <div id="LP" class="w3-accordion-content w3-white w3-card-4"> 
            <li><a href="over_pellegrina.php">About <em>La Pellegrina</em></a></li>
            <li><a href="vorigeprojecten.php">Previous projects</a></li>
            <li><a href="../../algemeen/werken.php">Previously performed works</a></li>
            <li><a href="contact.php" target="_parent" >Contact & links</a></li>
            <li><a href="../privacy.php">Privacy and General Data Protection Regulation (GDPR)</a></li>    	</div>
    </div>
    <li><a href="docenten.php" target="_parent">Tutors</a></li>
    <div class="w3-accordion"> <a onclick="myAccFunc('praktisch')" href="#">Practical matters <i class="fa fa-caret-down"></i></a>
      <div id="praktisch" class="w3-accordion-content w3-white w3-card-4">
        <li><a href="praktisch.php" target="_parent">Practical & prices</a></li>
        <li><a href="faq.php" target="_parent">Frequently asked questions</a></li>
        <li><a href="route_plek.php" target="_parent">Travel information</a></li>
      </div>
    </div>
    <li><a href="adres_toevoegen.php" target="_parent" class="w3-text-red">Receive information?<br />
      Add E-mail Address!</a></li>
    <li><a href="login.php" target="_parent">For participants only</a></li>
  </ul>
  <div class="w3-content w3-center"> <a href="/EN/../NL/index.php" target="_parent"><img 
            src="/Images/Logos/Vlag_NL.jpg" alt="Go to the Dutch site" 
            width="34" height="24" class="geenlijn" /></a> <a href="http://www.facebook.com/pellegrina.net" title="Find La Pellegrina on Facebook" target="_blank" class="facebookicon"><img src="/Images/Logos/facebook_logo.png" 
        alt="Facebook" width="25" height="25" class="geenlijn" /></a> </div>
</nav>
<script>
function w3_open() {
  document.getElementById("main").style.marginLeft = "25%";
  document.getElementById("navcontainer").style.width = "25%";
  document.getElementById("navcontainer").style.display = "block";
  document.getElementById("openNav").style.display = "none";
}

function w3_close() {
  document.getElementById("main").style.marginLeft = "0%";
  document.getElementById("navcontainer").style.display = "none";
  document.getElementById("openNav").style.display = "inline-block";
}

function myAccFunc(naam) {
    var x = document.getElementById(naam);
    if (x.className.indexOf("w3-show") == -1) {
        x.className += " w3-show";
        x.previousElementSibling.className += " actiekleur";
    } else { 
        x.className = x.className.replace(" w3-show", "");
        x.previousElementSibling.className = 
        x.previousElementSibling.className.replace(" actiekleur", "");
    }
}

</script>

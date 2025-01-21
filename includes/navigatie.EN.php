<link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
    .w3-opennav {
        padding: 8px;
        background-color: palegoldenrod;
    }
</style>
<nav class="w3-sidebar w3-bar-block w3-collapse w3-card-2 w3-large"
    id="navcontainer">
    <a href="javascript:void(0)" onclick="w3_close()"
        class="w3-closenav w3-large w3-hide-large"><b>Close &times;</b></a>
    <a href="/EN/index.php" target="_parent" class="w3-bar-item w3-button">All
        Courses</a>
    <a href="index.php" target="_parent"
        class="w3-bar-item w3-button">{cursus}</a>
    <a class="w3-bar-item w3-button" href="cursus.php" target="_parent">Course
        details</a>
    <a href="programma.php" class="w3-bar-item w3-button">Programme</a>
    <a class="w3-bar-item w3-button" href="aanmelding.php"
        target="_parent">Registration</a>
    <div class="w3-dropdown-click">
        <a class="w3-bar-item w3-button" onclick="myFunction()"><em>La
                Pellegrina</em>
            <i class="fa fa-caret-down"></i></a>
        <div id="demo" class="w3-dropdown-content w3-bar-block w3-card">
            <a class="w3-bar-item w3-button" href="over_pellegrina.php">About
                <em>La Pellegrina</em></a>
            <a class="w3-bar-item w3-button"
                href="vorigeprojecten.php">Experiences of participants</a>
            <a class="w3-bar-item w3-button"
                href="/algemeen/werken.php">Previously performed works</a>
            <a class="w3-bar-item w3-button" href="contact.php"
                target="_parent">Contact & links</a>
        </div>
    </div>
    <a href="plaats.php" target="_parent"
        class="w3-bar-item w3-button">{locatie}, the venue</a>
    <a href="docenten.php" target="_parent"
        class="w3-bar-item w3-button">Tutors</a>
    <a class="w3-bar-item w3-button" href="praktisch.php" target="_parent"
        -->Prices & practical matters</a>
    <a href="faq.php" target="_parent" class="w3-bar-item w3-button">Frequently
        asked questions</a>
    <a href="route_plek.php" target="_parent"
        class="w3-bar-item w3-button">Travel information</a>
    <a href="adres_toevoegen.php" target="_parent"
        class="w3-bar-item w3-button w3-text-red">Receive information?<br /> Add
        E-mail Address!</a>
    <a class="w3-bar-item w3-button" href="login.php" target="_parent" -->For
        participants only</a>
    <div class="w3-content w3-center"> <a href="/NL/index.php"
            target="_parent"><img src="/Images/Logos/Vlag_NL.jpg"
                alt="Go to the Dutch site" width="34" height="24"
                class="geenlijn" /></a> <a
            href="http://www.facebook.com/pellegrina.net"
            title="Find La Pellegrina on Facebook" target="_blank"
            class="facebookicon"><img src="/Images/Logos/facebook_logo.png"
                alt="Facebook" width="25" height="25" class="geenlijn" /></a>
    </div>
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

    function myFunction() {
        var x = document.getElementById("demo");
        if (x.className.indexOf("w3-show") == -1) {
            x.className += " w3-show";
        } else {
            x.className = x.className.replace(" w3-show", "");
        }
    }
</script>
<link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
    .w3-opennav {
        padding: 8px;
        background-color: yellow;
    }
</style>
<nav class="w3-sidebar w3-bar-block w3-collapse w3-card-2 w3-large"
    id="navcontainer">
    <a class="w3-bar-item w3-button w3-large w3-hide-large"
        onclick="w3_close()"><b>Sluit &times;</b></a>
    <a href="/NL/index.php" target="_parent" class="w3-bar-item w3-button">Alle
        cursussen</a>
    <a href="index.php" target="_parent"
        class="w3-bar-item w3-button">{cursus}</a>
    <a href="cursus.php" class="w3-bar-item w3-button">Cursusdetails</a>
    <a href="programma.php" class="w3-bar-item w3-button">Programma</a>
    <a class="w3-bar-item w3-button" href="aanmelding.php" target="_parent"
        -->Aanmelding</a>
    <div class="w3-dropdown-click">
        <a class="w3-bar-item w3-button" onclick="myFunction()"><em>La
                Pellegrina</em>
            <i class="fa fa-caret-down"></i></a>
        <div id="demo" class="w3-dropdown-content w3-bar-block w3-card">
            <a href="over_pellegrina.php" class="w3-bar-item w3-button">Over
                <em>La Pellegrina</em></a>
            <a href="vorigeprojecten.php"
                class="w3-bar-item w3-button">Ervaringen van deelnemers</a>
            <a href="/algemeen/werken.php" class="w3-bar-item w3-button">Eerder
                uitgevoerde werken</a>
            <a href="contact.php" target="_parent"
                class="w3-bar-item w3-button">Contact & links</a>
        </div>
    </div>
    <a href="plaats.php" target="_parent"
        class="w3-bar-item w3-button">{locatie}, de locatie</a>
    <a href="docenten.php" target="_parent"
        class="w3-bar-item w3-button">Docenten</a>
    <a class="w3-bar-item w3-button" href="praktisch.php" target="_parent"
        -->Prijzen & praktische zaken</a>
    <a href="faq.php" target="_parent" class="w3-bar-item w3-button">Vaak
        gestelde vragen</a>
    <a href="route_plek.php" target="_parent"
        class="w3-bar-item w3-button">Reisinformatie</a>
    <a href="adres_toevoegen.php" target="_parent"
        class="w3-bar-item w3-button w3-text-red">Informatie ontvangen?<br>Geef
        E-mail op!</a>
    <a class="w3-bar-item w3-button" href="login.php" target="_parent"
        -->Speciaal voor deelnemers</a>
    <div class="w3-content w3-center">
        <a href="/EN/index.php" target="_parent"> <img
                src="/Images/Logos/Vlag_UK.jpg"
                alt="Ga naar de Engelstalige site" width="34" height="24"
                class="geenlijn" /></a> <a
            href="http://www.facebook.com/pellegrina.net"
            title="Vind La Pellegrina op Facebook" target="_blank"><img
                src="/Images/Logos/facebook_logo.png" alt="Facebook" width="25"
                height="25" class="geenlijn" /></a>
    </div>
</nav>
<script>
    function w3_open() {
        document.getElementById("main").style.marginLeft = "200px";
        document.getElementById("navcontainer").style.width = "200px";
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
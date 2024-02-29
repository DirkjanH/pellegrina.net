<?php
require_once( $_SERVER[ 'DOCUMENT_ROOT' ] . '/includes/includes2024.php' );
?>

<!DOCTYPE HTML>
<html>
<head>
<title>La Pellegrina&nbsp; <?php echo $jaar ?> </title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<?php require_once $_SERVER['DOCUMENT_ROOT'].'/includes/metatags+javascript.NL.php'; ?>
<?php require_once $_SERVER['DOCUMENT_ROOT'].'/includes/GA_code.php'; ?>
<script type="text/javascript">
		function klapdiensten( id ) {
			if ( document.getElementById( id ) ) {
				var cont = document.getElementById( id ).style;
				if ( cont.display == "block" ) {
					cont.display = "none";
				} else {
					cont.display = "block";
				}
				return false;
			} else {
				return true;
			}
		}
	</script>
<link href="../css/pellegrina_stijlen.css" rel="stylesheet" type="text/css">
<link href="../css/openingspagina.css" rel="stylesheet" type="text/css">
<link href="../css/banner.css" rel="stylesheet" type="text/css">
<!--[if gte IE 9]>
  <style type="text/css">
    .gradient {
       filter: none;
    }
  </style>
<![endif]--> 
<!-- Facebook Pixel Code --> 
<script>
		! function ( f, b, e, v, n, t, s ) {
			if ( f.fbq ) return;
			n = f.fbq = function () {
				n.callMethod ?
					n.callMethod.apply( n, arguments ) : n.queue.push( arguments )
			};
			if ( !f._fbq ) f._fbq = n;
			n.push = n;
			n.loaded = !0;
			n.version = '2.0';
			n.queue = [];
			t = b.createElement( e );
			t.async = !0;
			t.src = v;
			s = b.getElementsByTagName( e )[ 0 ];
			s.parentNode.insertBefore( t, s )
		}( window, document, 'script',
			'https://connect.facebook.net/en_US/fbevents.js' );
		fbq( 'init', '537749209897328' );
		fbq( 'track', 'PageView' );
	</script>
<noscript>
<img height="1" width="1" style="display:none"
  src="https://www.facebook.com/tr?id=537749209897328&ev=PageView&noscript=1"
/>
</noscript>
<!-- End Facebook Pixel Code -->
</head>

<body>
<script>
		( function ( d, s, id ) {
			var js, fjs = d.getElementsByTagName( s )[ 0 ];
			if ( d.getElementById( id ) ) return;
			js = d.createElement( s );
			js.id = id;
			js.src = "//connect.facebook.net/nl_NL/all.js#xfbml=1";
			fjs.parentNode.insertBefore( js, fjs );
		}( document, 'script', 'facebook-jssdk' ) );
	</script>
<div id="inhoud">
	<div id="envelop" class="w3-hide-small w3-hide-medium">
		<?php require_once $_SERVER['DOCUMENT_ROOT'].'/includes/header.NL.php'; ?>
		<div id="" class="onzichtbaar">
			<div class="bannergeel">De inschrijving voor zomer 2024 start 1 december!</div>
		</div>
		<div id="banner" class="">
			<div class="bannergroen">De inschrijving voor zomer 2024 is gestart!</div>
		</div>
		<div id="banner" class="onzichtbaar">
			<div class="bannergeel" style="font-size: 80%;">Data zomer 2024 bekend; inschrijving start 1 december!</div>
		</div>
		<div id="banner" class="onzichtbaar">
			<div class="bannergeel">Wie zich vóór 1 maart aanmeldt, krijgt € 50 korting</div>
		</div>
		<div id="banner" class="onzichtbaar">
			<div class="bannerblauw">Nog enkele plaatsen beschikbaar...</div>
		</div>
		<div id="banner" class="onzichtbaar">
			<div class="onzichtbaar bannerrood">De cursussen in 2022 zijn (nagenoeg) vol</div>
		</div>
	</div>
	<div id="main" class="w3-row-padding">
		<div class="w3-card-2 w3-padding w3-margin-bottom w3-half">
			<h2 class="kolom LP_colour">Muziekprojecten voor iedere muzikant met een professionele instelling<br>
			</h2>
			<p>De zomercursussen in <?php echo $jaar ?>: twee projecten  waarin je je kunt onderdompelen in een warm bad van prachtige muziek, met eersteklas docenten en gelijkgestemde zielen. De projecten van <?php echo $jaar ?> staan open voor ervaren muzikanten. Of je nou amateur bent of professional, bij <em>La Pellegrina </em>staat een professionele instelling hoog in het vaandel. Natuurlijk kom je goed voorbereid naar een cursus, natuurlijk vind je het fijn als anderen dat ook doen. Spreekt dit je aan? Lees dan verder...</p>
			<p>Deze pagina geeft een overzicht van de cursussen in <?php echo $jaar ?>. De barokcursus vindt plaats in het voormalige klooster Nieuw Sion in de bossen van Salland bij Deventer. De cursus rond Reicha's Requiem vindt plaats in Tsjechië, het meest muzikale land van Europa. Plaats van handeling is het conservatorium van České Budějovice, 120 km ten zuiden van Praag. </p>
			<p>Klik op de cursustitels voor meer informatie. Vanaf 1 december is alle informatie compleet en is de inschrijving  geopend. </p>
			<p>Mocht je vragen hebben, aarzel dan niet om contact op te nemen met Dirkjan Horringa (tel. 0619-224758).</p>
			<p class="w3-center w3-panel">In samenwerking met<br>
				<a href="http://www.acmp.net" target="_blank"><img src="../Images/Logos/ACMP_CMYK.jpg" width="200" height="104" alt=""/></a> </p>
			<div class="w3-content w3-center">
				<p><a href="/EN/index.php"><img src="/Images/Logos/Vlag_UK.jpg" alt="Ga naar de Engelstalige site" width="34" height="24" border="0" /></a> </p>
				<div class="fb-like" data-href="http://www.facebook.com/pages/La-Pellegrina/443675859011335?ref=hl" data-send="true" data-width="300" data-show-faces="false" data-action="recommend" data-font="verdana"></div>
			</div>
			</td>
		</div>
		<div class="w3-half">
			<div class="w3-card-2 w3-padding w3-margin-bottom">
				<h3><a href="romantic/index.php"><span class="romantic">Reicha's Requiem voor orkest, koor en solisten</span></a></h3>
				<p>voor instrumentalisten en (koor)zangers, met kamermuziek en kamerkoor</p>
				<ul>
					<li>České Budějovice (Tsjechië), 25 juli - 4 augustus <?php echo $jaar ?> </li>
				</ul>
				<p class="onzichtbaar">Nog enkele plaatsen in alle stemgroepen van het koor</p>
				<p class="onzichtbaar">De cursus is vol voor alle instrumenten</p>
			</div>
			<div class="w3-card-2 w3-padding w3-margin-bottom">
				<h3><a href="baroque/index.php"><span class="baroque">Barokmuziek in 415 Hz: Vivaldi's Venetiaanse Vespers</span></a></h3>
				<p>voor zangers &amp; 'oude' instrumenten </p>
				<ul>
					<li>Klooster Nieuw Sion, Diepenveen, 11 - 17 augustus <?php echo $jaar ?></li>
				</ul>
				<p class="plaatsvoor onzichtbaar">Nog plaats voor barokfagot, continuo (orgel/clavecimbel/theorbe), barokcello en viola da gamba. <br>
				</p>
				<p class="onzichtbaar">Deze cursus is vol voor alle instrumenten en zangers</p>
				<p class="onzichtbaar">Deze cursus is vol voor overige instrumeten en stemmen</p>
		  </div>
			<div class="w3-card-2 w3-padding w3-margin-bottom">
				<h3><a href="https://pellegrina.kinskytrio.cz/" target="_blank"><span class="chamber">Extra: Speel kamermuziek met het Kinsky Trio Prague &amp; Friends</span></a></h3>
				<p>speel met een professionele kamermuziekspeler in de groep </p>
				<ul>
					<li>České Budějovice (Tsjechië), 13 - 21 juli <?php echo $jaar ?> </li>
				</ul>
				<p class="nadruk">N.B. deze cursus wordt georganiseerd door en onder verantwoordelijkheid van het Kinsky Trio Prague, in samenwerking met <em>La Pellegrina</em> </p>
			</div>
		  <div class="w3-card-2 w3-padding w3-margin-bottom"><h3>Meer informatie</h3>
			<p><a href="over_pellegrina.php">Over La Pellegrina</a></p>
			<p><a href="contact.php">Contact</a></p>
			</div>
        </div>
	</div>
</div>
</div>
</div>
</div>
<div class="onzichtbaar">Nog enkele plaatsen beschikbaar</div>
<?php
require_once( $_SERVER[ 'DOCUMENT_ROOT' ] . '/includes/footer.php' );
?>

<!-- begin olark code --> 
<script data-cfasync="false" type='text/javascript'>
		/*<![CDATA[*/
		window.olark || ( function ( c ) {
			var f = window,
				d = document,
				l = f.location.protocol == "https:" ? "https:" : "http:",
				z = c.name,
				r = "load";
			var nt = function () {
				f[ z ] = function () {
					( a.s = a.s || [] ).push( arguments )
				};
				var a = f[ z ]._ = {},
					q = c.methods.length;
				while ( q-- ) {
					( function ( n ) {
						f[ z ][ n ] = function () {
							f[ z ]( "call", n, arguments )
						}
					} )( c.methods[ q ] )
				}
				a.l = c.loader;
				a.i = nt;
				a.p = {
					0: +new Date
				};
				a.P = function ( u ) {
					a.p[ u ] = new Date - a.p[ 0 ]
				};

				function s() {
					a.P( r );
					f[ z ]( r )
				}
				f.addEventListener ? f.addEventListener( r, s, false ) : f.attachEvent( "on" + r, s );
				var ld = function () {
					function p( hd ) {
						hd = "head";
						return [ "<", hd, "></", hd, "><", i, ' onl' + 'oad="var d=', g, ";d.getElementsByTagName('head')[0].", j, "(d.", h, "('script')).", k, "='", l, "//", a.l, "'", '"', "></", i, ">" ].join( "" )
					}
					var i = "body",
						m = d[ i ];
					if ( !m ) {
						return setTimeout( ld, 100 )
					}
					a.P( 1 );
					var j = "appendChild",
						h = "createElement",
						k = "src",
						n = d[ h ]( "div" ),
						v = n[ j ]( d[ h ]( z ) ),
						b = d[ h ]( "iframe" ),
						g = "document",
						e = "domain",
						o;
					n.style.display = "none";
					m.insertBefore( n, m.firstChild ).id = z;
					b.frameBorder = "0";
					b.id = z + "-loader";
					if ( /MSIE[ ]+6/.test( navigator.userAgent ) ) {
						b.src = "javascript:false"
					}
					b.allowTransparency = "true";
					v[ j ]( b );
					try {
						b.contentWindow[ g ].open()
					} catch ( w ) {
						c[ e ] = d[ e ];
						o = "javascript:var d=" + g + ".open();d.domain='" + d.domain + "';";
						b[ k ] = o + "void(0);"
					}
					try {
						var t = b.contentWindow[ g ];
						t.write( p() );
						t.close()
					} catch ( x ) {
						b[ k ] = o + 'd.write("' + p().replace( /"/g, String.fromCharCode( 92 ) + '"' ) + '");d.close();'
					}
					a.P( 2 )
				};
				ld()
			};
			nt()
		} )( {
			loader: "static.olark.com/jsclient/loader0.js",
			name: "olark",
			methods: [ "configure", "extend", "declare", "identify" ]
		} );
		/* custom configuration goes here (www.olark.com/documentation) */
		olark.identify( '5575-684-10-1480' ); /*]]>*/
	</script>
<noscript>
<a href="https://www.olark.com/site/5575-684-10-1480/contact" title="Contact us" target="_blank">Questions? Feedback?</a> powered by <a href="http://www.olark.com?welcome" title="Olark live chat software">Olark live chat software</a>
</noscript>

<!-- end olark code -->
</body>
</html>
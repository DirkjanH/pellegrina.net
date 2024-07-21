<?php
// stel php in dat deze fouten weergeeft
//ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once $_SERVER["DOCUMENT_ROOT"] . '/vendor/autoload.php';

use function PHP81_BC\strftime;

Kint::$enabled_mode = false;

require_once($_SERVER['DOCUMENT_ROOT'] . '/includes/includes2024.php');

function getisp($ip = '')
{

	if ($ip == '') $ip = $_SERVER['REMOTE_ADDR'];
	$longisp = @gethostbyaddr($ip);
	$isp = explode('.', $longisp);
	$isp = array_reverse($isp);
	$tmp = $isp[1];
	if (preg_match("/\<(org?|com?|net)\>/i", $tmp)) {
		$myisp = $isp[2] . '.' . $isp[1] . '.' . $isp[0];
	} else {
		$myisp = $isp[1] . '.' . $isp[0];
	}
	preg_match("/[0-9]{1,3}\.[0-9]{1,3}/", $myisp);
	return $myisp;
}
?>
<!DOCTYPE html>
<html>
<meta name="viewport" content="width=device-width, initial-scale=1">

<head>
	<title>La Pellegrina Music Summer Schools</title>
	<meta name="Description" content="Musical Summer Schools for advanced musical amateurs, chamber music and orchestra">
	<meta name="Keywords" content="Barokmuziek, klassieke muziek, zingen, muziekmaken, Kamermuziek, Kleine ensembles, Koorzang, Muziekcursus, Muziekliefhebbers, Muziekvakantie, Solozang, Tsjechië muziek, Vocaal ensemble, Workshop, Zomercursus, 
        Chamber Music, Choir, singing, classical, Course, Baroque, Czech music, Czech Republic, music abroad, Music making, Orchestra chamber music, Romantic music, Singers, Solo singing, Students music, Summer school abroad, 
        klassische Musik, Junggesellen Musik, Kammermusik, Laienmusik, Barock, Musikliebhaber, Romantische Musik, Sologesang, Sommerkurs, Studenten Musik, Tschechien, Tschechische Musik ">
	<meta charset="utf-8">
	<meta name="verify-v1" content="CNpSvvR+TC1YnI2of9XUZf1olPLIrNYnXNIraar7VLI=" />

	<link rel="apple-touch-icon" sizes="180x180" href="https://pellegrina.net/Images/Logos/apple-touch-icon.png">
	<link rel="icon" type="image/png" sizes="32x32" href="https://pellegrina.net/Images/Logos/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="16x16" href="https://pellegrina.net/Images/Logos/favicon-16x16.png">
	<link rel="manifest" href="https://www.pellegrina.net/Images/Logos/site.webmanifest">
	<link rel="shortcut icon" href="https://pellegrina.net/Images/Logos/favicon.ico">
	<meta name="msapplication-TileColor" content="#da532c">
	<meta name="msapplication-config" content="https://pellegrina.net/Images/Logos/browserconfig.xml">
	<meta name="theme-color" content="#ffffff">

	<link href="css/pellegrina_stijlen.css" rel="stylesheet" type="text/css">
	<link href="css/banner.css" rel="stylesheet" type="text/css">

	<style type="text/css">
		<!--
		body,
		td,
		th {
			background-color: #CCC;
			text-align: center;
			color: #000000;
			font: 700 normal 24px;
			font-family: 'Alegreya Sans', Verdana, sans-serif;
			background-color: lightskyblue;
		}

		h1 {
			font-size: 18px;
			color: #35191C;
			margin-top: 2.0em;
		}

		h2 {
			color: #901324;
			text-align: left;
		}

		h3 {
			color: #739D44;
			font-size: 22px;
		}

		h4 {
			color: #07A900;
			font-size: 18px;
		}

		h5 {
			font-size: 110%;
			color: #569442;
			text-align: center;
		}

		h6 {
			font-size: 110%;
			color: black;
			margin-bottom: -10px;
		}

		p {
			font-size: 18px;
		}

		a:link,
		a:visited {
			color: #000000;
			text-decoration: none;
			font-weight: bold;
		}

		img {
			border-style: none;
		}

		a:hover,
		a:active {
			text-decoration: none;
			color: #990033;
			font-weight: bolder;
		}

		div#home {
			border: thin;
		}

		div#carroussel {
			display: flex;
			justify-content: center;
		}

		div#envelop {
			position: relative;
			clear: both !important;
			margin: 0px;
			border-style: none;
		}

		img.mySlides {
			box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19) !important;
		}

		#teller {
			font: italic 50%;
			color: #999999;
			text-align: center;
		}
		-->
	</style>

	<!--[if gte IE 9]>
  <style type="text/css">
    .gradient {
       filter: none;
    }
  </style>
<![endif]-->

	<meta name="google-site-verification" content="BOrB5tEMjKF9O0X8Ow1Gjl2z7Q-Su6aCqce0dbJZeVE" />
	<meta name="verify-v1" content="vR6h4zMZYm0o19dhXiI5yeZrVu5fueMcCb/+Hsp+g4g=" />
	<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/GA_code.php'; ?>
	<!-- Facebook Pixel Code -->
	<script>
		! function(f, b, e, v, n, t, s) {
			if (f.fbq) return;
			n = f.fbq = function() {
				n.callMethod ?
					n.callMethod.apply(n, arguments) : n.queue.push(arguments)
			};
			if (!f._fbq) f._fbq = n;
			n.push = n;
			n.loaded = !0;
			n.version = '2.0';
			n.queue = [];
			t = b.createElement(e);
			t.async = !0;
			t.src = v;
			s = b.getElementsByTagName(e)[0];
			s.parentNode.insertBefore(t, s)
		}(window, document, 'script',
			'https://connect.facebook.net/en_US/fbevents.js');
		fbq('init', '537749209897328');
		fbq('track', 'PageView');
	</script>
	<noscript><img height="1" width="1" style="display:none" src="https://www.facebook.com/tr?id=537749209897328&ev=PageView&noscript=1" /></noscript>
	<!-- End Facebook Pixel Code -->
</head>

<body>
	<div id="inhoud" class="w3-content">
		<div id="envelop" class="w3-hide-small w3-hide-medium">
			<div id="banner">
				<div id="" class="bannergeel onzichtbaar" style="font-size: 75%;">
					<div class="onzichtbaar">Data zomer 2024 bekend; inschrijving start 1 december!</div>
					<div class="onzichtbaar">Dates summer 2024 are known; registration starts December 1!</div>
				</div>
				<div id="" class="onzichtbaar">
					<div>Inschrijving voor zomer 2024 is gestart!</div>
					<div>Registration for summer 2024 has started!</div>
				</div>
				<div id="" class="banneroranje onzichtbaar">
					<div class="">Nog enkele plaatsen beschikbaar...</div>
					<div class="">A few last places available...</div>
				</div>
				<div id="bannerteksten" class="bannerrood">
					<div class="">De cursussen in 2024 zijn helemaal vol</div>
					<div class="">The 2024 courses are fully booked</div>
				</div>
				<div id="" class="onzichtbaar">
					<div>Wie zich vóór 1 maart aanmeldt, krijgt € 50 korting</div>
					<div>Who registers before 1 March, receives a EUR 50 red.</div>
				</div>
			</div>
		</div>
		<div id="home" class="w3-container w3-card-4 w3-margin-top w3-white w3-content" style="max-width:1200px">
			<div class="w3-center w3-container"><img src="Images/Logos/LP_nieuw.png" alt="La Pellegrina" style="max-width:600px;width:100%"></div>
			<div id="fb-root"></div>
			<script>
				(function(d, s, id) {
					var js, fjs = d.getElementsByTagName(s)[0];
					if (d.getElementById(id)) return;
					js = d.createElement(s);
					js.id = id;
					js.src = "//connect.facebook.net/nl_NL/all.js#xfbml=1";
					fjs.parentNode.insertBefore(js, fjs);
				}(document, 'script', 'facebook-jssdk'));
			</script>

			<div class="w3-card-2">
				<div class="w3-row-padding w3-light-grey">
					<div class="w3-card-4 w3-white w3-margin-top w3-quarter">
						<h1><a href="NL" target="_self"><img src="Images/Logos/Vlag_NL.jpg" alt="Nederlands" width="34" height="24" hspace="10" border="0" align="absmiddle">Cursusprogramma <?php echo $jaar ?></a></h1>
						<p><a href="NL">Twee zomercursussen voor gevorderde amateurmusici en professionals</a></p>
					</div>
					<div id="carroussel" class="w3-panel w3-section w3-half">
						<img src="Images/slideshow/dvorak_tutors.jpg" alt="" class="mySlides" />
						<img src="Images/slideshow/oboeband.jpg" alt="" class="mySlides" />
						<img src="Images/slideshow/druivenkas.jpg" alt="" class="mySlides" />
						<img src="Images/slideshow/blazers_buiten.jpg" alt="" class="mySlides" />
						<img src="Images/slideshow/tevreden_pianokwartet.jpg" alt="" class="mySlides" />
						<img src="Images/slideshow/twee_zangers.jpg" alt="" class="mySlides" />
						<img src="Images/slideshow/kamerkoor.jpg" alt="" class="mySlides" />
						<img src="Images/slideshow/trio_met_bas.jpg" alt="" class="mySlides" />
						<img src="Images/slideshow/orkestrepetitie.jpg" alt="" class="mySlides" />
						<img src="Images/slideshow/zangers.jpg" alt="" class="mySlides" />
						<img src="Images/slideshow/celli.jpg" alt="" class="mySlides" />
						<script>
							var myIndex = 0;
							carousel();

							function carousel() {
								var i;
								var x = document.getElementsByClassName("mySlides");
								for (i = 0; i < x.length; i++) {
									x[i].style.display = "none";
								}
								myIndex++;
								if (myIndex > x.length) {
									myIndex = 1
								}
								x[myIndex - 1].style.display = "block";
								setTimeout(carousel, 3000);
							}
						</script>
					</div>
					<div class="w3-card-4 w3-section w3-white w3-margin-top w3-quarter">
						<h1><a href="EN" target="_self"><img src="Images/Logos/Vlag_UK.jpg" alt="English" width="34" height="24" hspace="10" align="absmiddle">Course Programme <?php echo $jaar ?></a></h1>
						<p><a href="EN">Two summer schools for accomplished amateur musicians and professionals</a></p>
					</div>
				</div>
			</div>
			<div class="w3-section w3-white"><strong><a href="japan.php"><img src="Images/Logos/Vlag_Japan.jpg" alt="Japan" width="34" height="24" align="baseline">&nbsp;コース案内(概要</a>) </strong>&nbsp;|&nbsp;&nbsp;&nbsp;<a href="CZ_info.php"><img src="Images/Logos/CZ-vlag.jpg" width="34" height="23" alt="" />&nbsp;Čeští účastníci vítáni</a></div>
			<p class="w3-center w3-panel">This program has been made possible, in part, with support from <br>
				<a href="http://www.acmp.net" target="_blank"><img src="/Images/Logos/ACMP_CMYK.jpg" width="200" height="104" alt="" /></a>
			</p><a href="http://www.facebook.com/pages/La-Pellegrina/443675859011335" title="La Pellegrina on Facebook" target="_blank"><img src="/Images/Logos/facebook_logo.png" alt="Facebook" width="25" height="25" class="geenlijn" /></a><br>
			<div class="fb-like" data-href="http://www.facebook.com/pages/La-Pellegrina/443675859011335?ref=hl" data-send="true" data-layout="box_count" data-width="450" data-show-faces="true" data-font="verdana"></div>
			<script src="https://code.jquery.com/jquery-latest.js"></script>
			<script type="text/javascript">
				$(window).load(function() {
					var pages = $("div#bannerteksten div"),
						current = 0;
					var currentPage, nextPage;
					var timeoutID;

					var handler = function() {
						currentPage = pages.eq(current);
						if (current >= pages.length - 1)
							current = 0;
						else
							current = current + 1;
						nextPage = pages.eq(current);
						currentPage.fadeOut('quick', function() {
							nextPage.fadeIn('quick', function() {
								nextPage.css("opacity", 1);
								currentPage.hide();
								currentPage.css("opacity", 0);
								$('div.banner div').bind('', handler);
							});
						});
						timeoutID = setTimeout(function() {
							handler();
						}, 4000);
					}

					timeoutID = setTimeout(function() {
						handler();
					}, 0);

				});
			</script>
			<script>
				$(window).load(function() {
					var pages = $('#container li'),
						current = 0;
					var currentPage, nextPage;
					var timeoutID;
					var buttonClicked = 0;

					var handler1 = function() {
						buttonClicked = 1;
						$('#container .button').unbind('click');
						currentPage = pages.eq(current);
						if ($(this).hasClass('prevButton')) {
							if (current <= 0)
								current = pages.length - 1;
							else
								current = current - 1;
						} else {

							if (current >= pages.length - 1)
								current = 0;
							else
								current = current + 1;
						}
						nextPage = pages.eq(current);
						currentPage.fadeTo('slow', 0.3, function() {
							nextPage.fadeIn('slow', function() {
								nextPage.css("opacity", 1);
								currentPage.hide();
								currentPage.css("opacity", 1);
								$('#container .button').bind('click', handler1);
							});
						});
					}

					var handler2 = function() {
						if (buttonClicked == 0) {
							$('#container .button').unbind('click');
							currentPage = pages.eq(current);
							if (current >= pages.length - 1)
								current = 0;
							else
								current = current + 1;
							nextPage = pages.eq(current);
							currentPage.fadeTo('slow', 0.5, function() {
								nextPage.fadeIn('slow', function() {
									nextPage.css("opacity", 1);
									currentPage.hide();
									currentPage.css("opacity", 1);
									$('#container .button').bind('click', handler1);
								});
							});
							timeoutID = setTimeout(function() {
								handler2();
							}, 5000);
						}
					}

					$('#container .button').click(function() {
						clearTimeout(timeoutID);
						handler1();
					});

					timeoutID = setTimeout(function() {
						handler2();
					}, 3500);

				});
			</script>
		</div>
	</div>
	</div>

	<!-- begin olark code -->
	<script data-cfasync="false" type='text/javascript'>
		/*<![CDATA[*/
		window.olark || (function(c) {
			var f = window,
				d = document,
				l = f.location.protocol == "https:" ? "https:" : "http:",
				z = c.name,
				r = "load";
			var nt = function() {
				f[z] = function() {
					(a.s = a.s || []).push(arguments)
				};
				var a = f[z]._ = {},
					q = c.methods.length;
				while (q--) {
					(function(n) {
						f[z][n] = function() {
							f[z]("call", n, arguments)
						}
					})(c.methods[q])
				}
				a.l = c.loader;
				a.i = nt;
				a.p = {
					0: +new Date
				};
				a.P = function(u) {
					a.p[u] = new Date - a.p[0]
				};

				function s() {
					a.P(r);
					f[z](r)
				}
				f.addEventListener ? f.addEventListener(r, s, false) : f.attachEvent("on" + r, s);
				var ld = function() {
					function p(hd) {
						hd = "head";
						return ["<", hd, "></", hd, "><", i, ' onl' + 'oad="var d=', g, ";d.getElementsByTagName('head')[0].", j, "(d.", h, "('script')).", k, "='", l, "//", a.l, "'", '"', "></", i, ">"].join("")
					}
					var i = "body",
						m = d[i];
					if (!m) {
						return setTimeout(ld, 100)
					}
					a.P(1);
					var j = "appendChild",
						h = "createElement",
						k = "src",
						n = d[h]("div"),
						v = n[j](d[h](z)),
						b = d[h]("iframe"),
						g = "document",
						e = "domain",
						o;
					n.style.display = "none";
					m.insertBefore(n, m.firstChild).id = z;
					b.frameBorder = "0";
					b.id = z + "-loader";
					if (/MSIE[ ]+6/.test(navigator.userAgent)) {
						b.src = "javascript:false"
					}
					b.allowTransparency = "true";
					v[j](b);
					try {
						b.contentWindow[g].open()
					} catch (w) {
						c[e] = d[e];
						o = "javascript:var d=" + g + ".open();d.domain='" + d.domain + "';";
						b[k] = o + "void(0);"
					}
					try {
						var t = b.contentWindow[g];
						t.write(p());
						t.close()
					} catch (x) {
						b[k] = o + 'd.write("' + p().replace(/"/g, String.fromCharCode(92) + '"') + '");d.close();'
					}
					a.P(2)
				};
				ld()
			};
			nt()
		})({
			loader: "static.olark.com/jsclient/loader0.js",
			name: "olark",
			methods: ["configure", "extend", "declare", "identify"]
		});
		/* custom configuration goes here (www.olark.com/documentation) */
		olark.identify('5575-684-10-1480'); /*]]>*/
	</script>
	<noscript>
		<a href="https://www.olark.com/site/5575-684-10-1480/contact" title="Contact us" target="_blank">Questions? Feedback?</a> powered by <a href="http://www.olark.com?welcome" title="Olark live chat software">Olark live chat software</a>
	</noscript>
	<!-- end olark code -->
	<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'; ?>
</body>

</html>
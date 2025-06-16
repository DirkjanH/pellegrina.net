<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/includes/includes2025.php');
?>

<!DOCTYPE HTML>
<html>

<head>
	<title>La Pellegrina&nbsp;
		<?php echo $jaar ?>
	</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="/css/w3.css">
	<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/metatags+javascript.NL.php'; ?>
	<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/GA_code.php'; ?>
	<script type="text/javascript">
		function klapdiensten(id) {
			if (document.getElementById(id)) {
				var cont = document.getElementById(id).style;
				if (cont.display == "block") {
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
	<link href="/css/pellegrina_stijlen.css" rel="stylesheet" type="text/css">
	<link href="/css/openingspagina.css" rel="stylesheet" type="text/css">
	<link href="/css/banner.css" rel="stylesheet" type="text/css">
	<!--[if gte IE 9]>
  <style type="text/css">
    .gradient {
       filter: none;
    }
  </style>
<![endif]-->
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

	<div id="inhoud">
		<div id="envelop" class="w3-hide-small w3-hide-medium">
			<div id="banner" class="onzichtbaar">
				<div class="bannergroen">Registration for summer 2025 has started!</div>
			</div>
			<div id="banner" class="onzichtbaar">
				<div class="bannergeel onzichtbaar" style="font-size: 75%;">Dates summer 2025 are known; registration starts December 1!</div>
			</div>
			<div id="banner" class="onzichtbaar">
				<div class="bannergeel">Who registers before March 1, receives a EUR 50 red.</div>
			</div>
			<div id="banner" class="">
				<div class="banneroranje">Last places available...</div>
			</div>
			<div id="banner" class="onzichtbaar">
				<div class="bannerrood">The 2025 courses are fully booked</div>
			</div>
		</div>
		<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/header.EN.php'; ?>

		<div id="main" class="w3-row-padding">
			<div class="w3-card-2 w3-padding w3-margin-bottom w3-half">
				<h2 class="LP_colour">Music projects for every musician with a professional attitude</h2>
				<p>The
					<?php echo $jaar ?> summer courses: two projects where you can immerse yourself in a warm bath of beautiful music, with first-class teachers and like-minded souls. The
					<?php echo $jaar ?> projects are open to experienced musicians. Whether you are an amateur or a professional, a professional attitude is paramount at La Pellegrina. Of course you come well prepared to a course, of course you like it when others do so too. Does this appeal to you? Then please continue reading...</p>
				<p>This page gives an overview of the courses in
					<?php echo $jaar ?>. The baroque course takes place in the former monastery Nieuw Sion in the woods of Salland near Deventer. The course around Haydn and Mozart will take place in the Czech Republic, Europe's most musical country. The venue is the conservatoire of České Budějovice, 120 km south of Prague.</p>
				<p>Click on the course titles for more information. <b>From 1 December, all information will be complete and registration will be open again</b>.</p>
				<p>Please don't hesitate to contact Dirkjan Horringa in case you have any questions, by mail (<a href="mailto:info@pellegrina.net">info@pellegrina.net</a>) or by phone (+31 619 224 758).</p>
				<p class="w3-center w3-panel">In cooperation with<br>
					<a href="http://www.acmp.net" target="_blank"><img src="../Images/Logos/ACMP_CMYK.jpg" width="200" height="104" alt="" /></a>
				</p>
				<div class="w3-content w3-center">
					<p><a href="/NL/index.php"><img src="/Images/Logos/Vlag_NL.jpg" alt="Ga naar de Nederlandstalige site" width="34" height="24" border="0" class="w3-image" /></a>
					</p>
					<div class="fb-like" data-href="http://www.facebook.com/pages/La-Pellegrina/443675859011335?ref=hl" data-send="true" data-width="300" data-show-faces="false" data-action="recommend" data-font="verdana">
					</div>
				</div>
			</div>
			<div class="w3-half">
				<div class="w3-card-2 w3-padding w3-margin-bottom">
					<h3><a href="romantic/index.php"><span class="romantic">Haydn's Missa in Tempore Belli and Dvořák's Golden Spinning Wheel, for orchestra, choir and soloists</span></a></h3>
					<p>for instrumentalists &amp; (choir &amp; solo) singers, with chamber music and chamber choir<br>
					</p>
					<ul>
						<li>České Budějovice (Czechia), 24 July - 3 August <?php echo $jaar ?>
						</li>
					</ul>
					<p class="plaatsvoor">The choir has a few places in all voice groups, in particular for sopranos and basses</p>
					<p class="volvoor">The course is full for all instruments</p>
					<p class="onzichtbaar">*: Speciální výhodná cena pro české houslisty a violisty: kurs 2 nebo 3 včetně (dvoulůžkové) ubytování a stravování za Kč 4.000. Jenom napište &quot;ANKST&quot; na přihlášce v poli &quot;Remarks and additional information</p>
				</div>
				<div class="w3-card-2 w3-padding w3-margin-bottom">
					<h3><a href="baroque/index.php"><span class="baroque">Baroque music in 415 Hz: Purcell's Odes for St. Cecilia's Day & Handel's Utrecht Te Deum</span></a></h3>
					<p>for singers &amp; period instruments</p>
					<ul>
						<li>Priory Nieuw Sion, Diepenveen (Netherlands), 10 - 16 August <?php echo $jaar ?>
						</li>
					</ul>
					<p class="plaatsvoor">Still place for two continuo players (organ/harpsichord/theorbo), who can play from figured bass</p>
					<p class="volvoor">The course is full for all voice types, as well as for all instruments, except continuo</p>
				</div>
				<div class="w3-card-2 w3-padding w3-margin-bottom">
					<h3><a href="https://pellegrina.kinskytrio.cz/" target="_blank"><span class="chamber">Extra: Play chamber music with the Kinsky Trio Prague & Friends</span></a></h3>
					<p>play with a professional chamber musician in a group </p>
					<ul>
						<li>České Budějovice (Czechia), 12 - 20 July <?php echo $jaar ?>
						</li>
					</ul>
					<p class="nadruk">N.B. This course is organized by and under the responsibility of the Kinsky Trio Prague, in collaboration with <em>La Pellegrina</em>
					</p>
				</div>
				<div class="w3-card-2 w3-padding w3-margin-bottom">
					<h3>More information</h3>
					<p><a href="over_pellegrina.php">About La Pellegrina</a></p>
					<p><a href="contact.php">Contact</a></p>
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
				<p><a href="https://www.olark.com/site/5575-684-10-1480/contact" title="Contact us" target="_blank">Questions? Feedback? Use this chat app. Please send in your registration only via the form on the website</a></p>
			</noscript>

			<!-- end olark code -->
		</div>
	</div>
	<?php
	require_once($_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php');
	?>
</body>

</html>
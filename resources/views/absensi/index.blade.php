<!DOCTYPE HTML>
<!--
	Landed by HTML5 UP
	html5up.net | @ajlkn
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->

<html>
	<head>
		<title>Dashboard</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="assets/css/main.css" />
		<link rel="preconnect" href="https://fonts.googleapis.com">
		<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
		<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
		<noscript><link rel="stylesheet" href="assets/css/noscript.css" /></noscript>
		<style>
			body {
				font-family: 'Poppins', sans-serif;
			}
			h1, h2, h3 {
				font-weight: 600;
			}
			p, a, button {
				font-weight: 400;
			}

			#banner {
				display: flex;
				align-items: center;
				justify-content: flex-start; /* Posisi kiri */
				padding: 50px;
			}
			.content header h2 {
				text-align: left; /* Teks rata kiri */
				max-width: 600px;
			}
			
			
			.content header p {
				text-align: left;
			}

			.content img {
				display: block;
				margin-bottom: 20px;
			}
			.button-container {
				display: flex;
				gap: 10px;
				justify-content: flex-start; /* Posisi tombol ke kiri */
				margin-top: 20px;
			}
			.btn {
				padding: 10px 20px;
				font-size: 16px;
				font-weight: bold;
				border-radius: 20px;
				cursor: pointer;
				transition: 0.3s;
				border: none;
				text-decoration: none;
				text-align: center;
				display: inline-block;
				color: white;
			}
			.btn-login {
				background: #00ff99;
			}
			.btn-login:hover {
				background: #00cc77;
			}
			.btn-register {
				background: #ffffff;
				color: #000;
				border: 2px solid #ccc;
			}
			.btn-register:hover {
				background: #f0f0f0;
			}
		</style>
	</head>
	<body class="is-preload landing">
		<div id="page-wrapper">
			<header id="header">
				<h1 id="logo"><a href="{{ url('/index') }}">SMKN 1 SUBANG</a></h1>
				<nav id="nav">  
					<ul>
						<li><a href="{{ url('/index') }}">HOME</a></li>
						<li><a href="{{ url('/tentangkami') }}">TENTANG KAMI</a></li>
						<li><a href="#contact" class="scrolly">KONTAK</a></li>
					</ul>
				</nav>
			</header>

			<section id="banner">
				<div class="content">
					<img src="images/u.png" alt="Logo SMKN 1 Subang" />
					<header><br>
						<h2>Absensi Online - Praktik Kerja Lapangan (PKL)</h2>
						<p>Kami menyediakan akses bagi siswa untuk mendaftar Magang/Praktik Kerja Lapangan(PKL) di berbagai perusahaan mitra.</p>
					</header>
					<div class="button-container">
						<a href="{{ url('/login') }}" class="btn btn-login">Login</a>
					</div>
				</div>
			</section>

			<!-- Four -->
			<section id="four" class="wrapper style1 special fade-up">
				<div class="box alt">
					<div class="row gtr-uniform">
						<section class="col-4 col-6-medium col-12-xsmall">
							<span class="icon solid alt major fa-check"></span>
							<h3>Absen Harian</h3>
							<p>Memudahkan siswa PKL dalam mencatat kehadiran secara digital serta membantu guru dalam merekap absensi dengan lebih efisien dan akurat.</p>
						</section>
						<section class="col-4 col-6-medium col-12-xsmall">
							<span class="icon solid alt major fa-file"></span>
							<h3>Management Tugas</h3>
							<p>Memudahkan siswa PKL dalam management tugas secara digital tanpa perlu menulis manual, sehingga lebih praktis dan efisien.</p>
						</section>
						<section class="col-4 col-6-medium col-12-xsmall">
							<span class="icon solid alt major fa-print"></span>
							<h3>Cetak Rekap</h3>
							<p>Memudahkan pencetakan rekap absensi dan jurnal secara otomatis tanpa perlu menghitung secara manual, sehingga lebih cepat dan akurat.</p>
						</section>
					</div>
				</div>
			</div>
		</section>
		
		<section id="contact" class="wrapper style2 special fade">
			<div class="container">
				<header>
					<h2>Hubungi Kami</h2>
					<p>Silakan isi formulir di bawah untuk menghubungi kami</p>
				</header>
				<form method="post" action="#" class="cta">
					<div class="row gtr-uniform gtr-50">
						<div class="col-6 col-12-xsmall"><input type="text" name="name" id="name" placeholder="Nama Anda" required /></div>
						<div class="col-6 col-12-xsmall"><input type="email" name="email" id="email" placeholder="Alamat Email" required /></div>
						<div class="col-12"><textarea name="message" id="message" placeholder="Pesan Anda" rows="4" required></textarea></div>
						<div class="col-12"><input type="submit" value="Kirim Pesan" class="fit primary" /></div>
					</div>
				</form>
			</div>
		</section>
			<footer id="footer">
				<ul class="icons">
					<li><a href="https://www.tiktok.com/@nesasofficial?_t=ZS-8wVHHLRIbsf&_r=1" class="icon brands alt fa-tiktok"><span class="label">TikTok</span></a></li>				
					<li><a href="https://youtube.com/@nesasceren?si=g22qqpOl365lYpfo" class="icon brands alt fa-youtube"><span class="label">Youtube</span></a></li>
					<li><a href="https://www.facebook.com/share/19qyo1W1i1/" class="icon brands alt fa-facebook-f"><span class="label">Facebook</span></a></li>
					<li><a href="https://www.instagram.com/officialsmkn1subang?utm_source=ig_web_button_share_sheet&igsh=ZDNlZDc0MzIxNw==" class="icon brands alt fa-instagram"><span class="label">Instagram</span></a></li>
				</ul>
				<ul class="copyright">
					<li>&copy; SMK Negeri 1 Subang. All rights reserved.</li><li>Design: <a href="http://html5up.net">HTML5 UP</a></li>
				</ul>
			</footer>
		</div>

		<script src="assets/js/jquery.min.js"></script>
		<script src="assets/js/jquery.scrolly.min.js"></script>
		<script src="assets/js/jquery.dropotron.min.js"></script>
		<script src="assets/js/jquery.scrollex.min.js"></script>
		<script src="assets/js/browser.min.js"></script>
		<script src="assets/js/breakpoints.min.js"></script>
		<script src="assets/js/util.js"></script>
		<script src="assets/js/main.js"></script>

	</body>
</html>

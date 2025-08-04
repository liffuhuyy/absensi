@extends('siswa.layout.siswa_layout')
@section('content')
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: sans-serif;
            margin: 0;
            padding: 0;
            background: #f0f0f0;
        }

        #contact {
            background-color: #fff;
            padding: 50px 20px;
            max-width: 800px;
            margin: 50px auto;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }

        #contact header h2 {
            margin-bottom: 10px;
            font-size: 2em;
        }

        #contact header p {
            margin-bottom: 30px;
            color: #666;
        }

        .row {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }

        .col-6 {
            flex: 1 1 48%;
        }

        .col-12 {
            flex: 1 1 100%;
        }

        input,
        textarea {
            width: 100%;
            padding: 12px;
            font-size: 1em;
            border: 1px solid #ccc;
            border-radius: 6px;
            box-sizing: border-box;
        }

        textarea {
            resize: vertical;
        }

        input[type="submit"] {
            background-color: #000000;
            color: white;
            cursor: pointer;
            border: none;
            transition: background-color 0.3s ease;
        }

        input[type="submit"]:hover {
            background-color: #172a46;
        }

        #alert-success {
            margin-top: 15px;
            color: #2e7d32;
            background-color: #d0f0c0;
            border: 1px solid #a5d6a7;
            padding: 10px;
            border-radius: 5px;
            display: none;
        }

        #footer {
            background: #222;
            color: #ccc;
            padding: 40px 20px;
            text-align: center;
            font-size: 0.95em;
        }

        #footer .icons {
            list-style: none;
            padding: 0;
            margin-bottom: 20px;
            display: flex;
            justify-content: center;
            gap: 15px;
        }

        #footer .icons li a {
            color: #ccc;
            font-size: 1.4em;
            display: inline-block;
            transition: color 0.3s ease;
        }

        #footer .icons li a:hover {
            color: #ffffff;
        }

        #footer .copyright {
            list-style: none;
            padding: 0;
            margin: 0;
            color: #999;
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            gap: 10px;
        }

        #footer .copyright a {
            color: #aaa;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        #footer .copyright a:hover {
            color: #fff;
        }
    </style>
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
</head>
<body>
    <!-- Contact Section -->
    <section id="contact" class="wrapper style2 special fade">
        <div class="container">
            <header>
                <h2>Hubungi Kami</h2>
                <p>Silakan isi formulir di bawah untuk menghubungi kami</p>
            </header>
            <form method="post" action="#" class="cta">
=======
=======
>>>>>>> 44734077802f2dac236b168425133a99aa31d034
    <section id="contact" class="wrapper style2 special fade">
        <div class="container">
            <header>
                <h2 class="text-center">Kontak</h2>
                <p>Silakan isi formulir di bawah untuk menghubungi kami jika kamu mengalami kendala</p>
            </header>
            <form method="post" action="{{ route('admin.notif') }}" class="cta">
                @csrf
<<<<<<< HEAD
>>>>>>> d7390f319b47b889a80ef08f85da0dc72aacab79
=======
>>>>>>> 44734077802f2dac236b168425133a99aa31d034
                <div class="row gtr-uniform gtr-50">
                    <div class="col-6 col-12-xsmall">
                        <input type="text" name="name" id="name" placeholder="Nama Anda" required />
                    </div>
                    <div class="col-6 col-12-xsmall">
                        <input type="email" name="email" id="email" placeholder="Alamat Email" required />
                    </div>
                    <div class="col-12">
                        <textarea name="message" id="message" placeholder="Pesan Anda" rows="4" required></textarea>
                    </div>
                    <div class="col-12">
                        <input type="submit" value="Kirim Pesan" class="fit primary" />
                    </div>
                </div>
<<<<<<< HEAD
<<<<<<< HEAD
                <br />
                <button type="button" class="back-button" onclick="window.location.href='beranda.php'">Kembali</button>
            </form>
        </div>
    </section>

    <!-- Footer -->
    <footer id="footer">
        <ul class="icons">
            <li><a href="#" class="icon brands alt fa-twitter"><span class="label">Twitter</span></a></li>
            <li><a href="https://www.facebook.com/share/19qyo1W1i1/" class="icon brands alt fa-facebook-f"><span class="label">Facebook</span></a></li>
            <li><a href="#" class="icon brands alt fa-linkedin-in"><span class="label">LinkedIn</span></a></li>
            <li><a href="https://www.instagram.com/officialsmkn1subang?utm_source=ig_web_button_share_sheet&igsh=ZDNlZDc0MzIxNw==" class="icon brands alt fa-instagram"><span class="label">Instagram</span></a></li>
            <li><a href="#" class="icon brands alt fa-github"><span class="label">GitHub</span></a></li>
        </ul>
        <ul class="copyright">
            <li>&copy; SMK Negeri 1 Subang. All rights reserved.</li>
            <li>Design: <a href="http://html5up.net">HTML5 UP</a></li>
        </ul>
    </footer>
</body>
</html>
=======
=======
>>>>>>> 609387950bd37071a356c5d6c67352d34da61e06
    			   <!-- Contact Section -->
			   <section id="contact" class="wrapper style2 special fade">
				<div class="container">
                
					<header>
						<h2>Hubungi Kami</h2>
<<<<<<< HEAD
						<p>Silakan isi formulir di bawah untuk menghubungi kami</p>
=======
						<p>Silakan isi formulir di bawah untuk menghubungi kami jika kamu mengalami kendala</p>
>>>>>>> 609387950bd37071a356c5d6c67352d34da61e06
					</header>
         <form method="post" action="{{ route('admin.notif') }}" class="cta">
    @csrf
    <div class="row gtr-uniform gtr-50">
        <div class="col-6 col-12-xsmall">
            <input type="text" name="name" id="name" placeholder="Nama Anda" required />
        </div>
        <div class="col-6 col-12-xsmall">
            <input type="email" name="email" id="email" placeholder="Alamat Email" required />
        </div>
        <div class="col-12">
            <textarea name="message" id="message" placeholder="Pesan Anda" rows="4" required></textarea>
        </div>
        <div class="col-12">
            <input type="submit" value="Kirim Pesan" class="fit primary" />
        </div>
    </div>
    <br>
<<<<<<< HEAD
<<<<<<< HEAD
    <button class="back-button" onclick="window.location.href='beranda.php'">Kembali</button>
=======
    <button class="back-button" onclick="window.location.href='{{ url('/beranda') }}'">Kembali</button>
>>>>>>> 609387950bd37071a356c5d6c67352d34da61e06
=======
    <a href="{{ url('/beranda') }}" class="btn-back">Kembali</a>
>>>>>>> 817f91c4efa9020bd08c08355f13d82491af875c
</form>
      </div>
			</section>
            			<!-- Footer -->
			<footer id="footer">
				<ul class="icons">
<<<<<<< HEAD
					<li><a href="#" class="icon brands alt fa-twitter"><span class="label">Twitter</span></a></li>
					<li><a href="https://www.facebook.com/share/19qyo1W1i1/" class="icon brands alt fa-facebook-f"><span class="label">Facebook</span></a></li>
					<li><a href="#" class="icon brands alt fa-linkedin-in"><span class="label">LinkedIn</span></a></li>
					<li><a href="https://www.instagram.com/officialsmkn1subang?utm_source=ig_web_button_share_sheet&igsh=ZDNlZDc0MzIxNw==" class="icon brands alt fa-instagram"><span class="label">Instagram</span></a></li>
					<li><a href="#" class="icon brands alt fa-github"><span class="label">GitHub</span></a></li>
=======
					<li><a href="https://www.tiktok.com/@nesasofficial?_t=ZS-8wVHHLRIbsf&_r=1" class="icon brands alt fa-tiktok"><span class="label">TikTok</span></a></li>				
					<li><a href="https://youtube.com/@nesasceren?si=g22qqpOl365lYpfo" class="icon brands alt fa-youtube"><span class="label">Youtube</span></a></li>
					<li><a href="https://www.facebook.com/share/19qyo1W1i1/" class="icon brands alt fa-facebook-f"><span class="label">Facebook</span></a></li>
					<li><a href="https://www.instagram.com/officialsmkn1subang?utm_source=ig_web_button_share_sheet&igsh=ZDNlZDc0MzIxNw==" class="icon brands alt fa-instagram"><span class="label">Instagram</span></a></li>
>>>>>>> 609387950bd37071a356c5d6c67352d34da61e06
				</ul>
				<ul class="copyright">
					<li>&copy; SMK Negeri 1 Subang. All rights reserved.</li><li>Design: <a href="http://html5up.net">HTML5 UP</a></li>
				</ul>
			</footer>
        
                
            </body>
            </html>
<<<<<<< HEAD
>>>>>>> 9efacede5cf82b2f0e797a68fb66b0d148dfb85d
=======
>>>>>>> 609387950bd37071a356c5d6c67352d34da61e06
=======
=======
>>>>>>> 44734077802f2dac236b168425133a99aa31d034
                <br>
            </form>
        </div>
    </section>
    <!-- Footer -->
    <footer id="footer">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

        <ul class="icons">
            <li>
                <a href="https://www.tiktok.com/@nesasofficial?_t=ZS-8wVHHLRIbsf&_r=1" target="_blank" title="TikTok">
                    <i class="fab fa-tiktok"></i>
                </a>
            </li>
            <li>
                <a href="https://youtube.com/@nesasceren?si=g22qqpOl365lYpfo" target="_blank" title="YouTube">
                    <i class="fab fa-youtube"></i>
                </a>
            </li>
            <li>
                <a href="https://www.facebook.com/share/19qyo1W1i1/" target="_blank" title="Facebook">
                    <i class="fab fa-facebook-f"></i>
                </a>
            </li>
            <li>
                <a href="https://www.instagram.com/officialsmkn1subang" target="_blank" title="Instagram">
                    <i class="fab fa-instagram"></i>
                </a>
            </li>
        </ul>
        <ul class="copyright">
            <li>&copy; SMK Negeri 1 Subang. All rights reserved.</li>
        </ul>
    </footer>
@endsection
<<<<<<< HEAD
>>>>>>> d7390f319b47b889a80ef08f85da0dc72aacab79
=======
>>>>>>> 44734077802f2dac236b168425133a99aa31d034

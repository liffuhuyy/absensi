<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
    <link rel="stylesheet" href="assets/css/main.css" />
    <noscript><link rel="stylesheet" href="assets/css/noscript.css" /></noscript>
    <style>
        /* Gaya umum */
        body {
            background-color: rgba(19, 19, 37, 0.69) !important;
            color: rgb(255, 255, 255) !important;
        }

        /* Section Contact */
        #contact {
            background-color: white;
            color: black;
            padding: 50px 20px;
            text-align: center;
        }

        #contact header {
            margin-bottom: 20px;
        }

        #contact h2,
        #contact p,
        #contact label {
            color: black !important;
        }

        #contact h2 {
            font-size: 2em;
            margin-bottom: 10px;
        }

        #contact p {
            font-size: 1.1em;
        }

        #contact .cta {
            max-width: 600px;
            margin: 0 auto;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        /* Input dan Textarea */
        #contact input[type="text"],
        #contact input[type="email"],
        #contact textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 20px;
            font-size: 1em;
            background-color: #f0f0f0 !important;
            color: black !important;
            font-weight: bold !important;
        }

        #contact textarea {
            resize: none;
        }

        #contact label {
            font-weight: bold;
        }

        /* Placeholder warna gelap */
        #contact input::placeholder,
        #contact textarea::placeholder {
            color: #333 !important;
        }

        /* Tombol Submit dan Kembali */
        #contact input[type="submit"],
        .back-button {
            background: black !important;
            color: white !important;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            font-size: 1.1em;
            border-radius: 20px;
            transition: background 0.3s ease;
        }

        #contact input[type="submit"]:hover,
        .back-button:hover {
            background: black !important;
        }

        .back-button {
            display: inline-block;
            padding: 0.8rem 1.5rem;
            border: none;
            border-radius: 20px;
            font-weight: 600;
            cursor: pointer;
            transition: background-color 0.3s, transform 0.2s;
            text-decoration: none;
            text-align: center;
            background: linear-gradient(#ffffff, #ffffff);
            color: rgb(244, 156, 156);
            margin-bottom: 1.5rem;
            border-bottom: dotted 2px;
        }

        .back-button:hover {
            transform: translateY(-2px);
            background: linear-gradient(#e44c65, #e44c65);
        }
    </style>
    			   <!-- Contact Section -->
			   <section id="contact" class="wrapper style2 special fade">
				<div class="container">
                
					<header>
						<h2>Hubungi Kami</h2>
						<p>Silakan isi formulir di bawah untuk menghubungi kami jika kamu mengalami kendala</p>
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
    <button class="back-button" onclick="window.location.href='{{ url('/beranda') }}'">Kembali</button>
</form>
      </div>
			</section>
            			<!-- Footer -->
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
        
                
            </body>
            </html>

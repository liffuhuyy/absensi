<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background-color: #f0f2f5;
        }
        
        .container {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
            width: 300px;
            transition: transform 0.3s ease;
        }

        .container:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
        }

        .profile-photo {
            width: 100px;
            height: 100px;
            background-color: #e0e0e0;
            border-radius: 50%;
            margin: 0 auto 15px;
            display: flex;
            justify-content: center;
            align-items: center;
            overflow: hidden;
            cursor: pointer;
            transition: transform 0.3s ease;
            position: relative;
        }

        .profile-photo:hover {
            transform: scale(1.05);
        }

        .profile-photo img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .change-photo {
            color: #007bff;
            background: none;
            border: none;
            font-weight: bold;
            cursor: pointer;
            margin-bottom: 20px;
            transition: color 0.3s;
        }

        .change-photo:hover {
            color: #0056b3;
            text-decoration: underline;
        }

        .form-group {
            margin-bottom: 15px;
            text-align: left;
            position: relative;
        }

        .form-group input {
            width: 100%;
            padding: 10px;
            border: 1px solid #7a6f6f;
            border-radius: 20px;
            font-size: 14px;
            transition: border-color 0.3s, box-shadow 0.3s;
        }

        .form-group input:focus {
            border-color: #0f172a;
            box-shadow: 0 0 0 2px rgba(15, 23, 42, 0.2);
            outline: none;
        }

        .submit-btn {
            width: 70%;
            padding: 12px;
            background-color: #0f172a;
            color: white;
            border: none;
            border-radius: 20px;
            cursor: pointer;
            font-weight: bold;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .submit-btn:hover {
            background-color: #1e293b;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .submit-btn:active {
            transform: translateY(0);
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        }

        .submit-btn.loading {
            pointer-events: none;
            opacity: 0.8;
        }

        .submit-btn.loading::after {
            content: "";
            position: absolute;
            width: 16px;
            height: 16px;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            margin: auto;
            border: 3px solid transparent;
            border-top-color: #ffffff;
            border-radius: 50%;
            animation: button-loading-spinner 1s ease infinite;
        }

        @keyframes button-loading-spinner {
            from {
                transform: rotate(0turn);
            }
            to {
                transform: rotate(1turn);
            }
        }

        .change-password {
            display: block;
            margin-top: 15px;
            color: #007bff;
            text-decoration: none;
            font-size: 12px;
            transition: color 0.3s;
        }

        .change-password:hover {
            color: #0056b3;
            text-decoration: underline;
        }

        /* Modal styling */
        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.8);
            justify-content: center;
            align-items: center;
            animation: fadeIn 0.3s;
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        .modal img {
            max-width: 90%;
            max-height: 90%;
            border-radius: 10px;
            animation: zoomIn 0.3s;
        }

        @keyframes zoomIn {
            from { transform: scale(0.8); }
            to { transform: scale(1); }
        }

        /* Toast notification */
        .toast {
            position: fixed;
            bottom: 20px;
            left: 50%;
            transform: translateX(-50%);
            background-color: #333;
            color: white;
            padding: 12px 24px;
            border-radius: 4px;
            z-index: 1000;
            opacity: 0;
            transition: opacity 0.3s;
        }

        .toast.show {
            opacity: 1;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="profile-photo" onclick="showModal()">
            <img id="profileImage" src="default-avatar.png" alt="Profile Photo">
        </div>
        
        <input type="file" id="fileInput" accept="image/*" style="display: none;">
        <button class="change-photo" onclick="document.getElementById('fileInput').click()">Ubah foto profil</button>
        
        <form id="editProfileForm">
            <div class="form-group">
                <input type="text" id="nama" placeholder="Nama Lengkap" required>
            </div>
            
            <div class="form-group">
                <input type="email" id="email" placeholder="Email" required 
                pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" 
                title="Masukkan email yang valid">
            </div>
            
            <button type="submit" class="submit-btn" id="submitBtn">Simpan Perubahan</button>
        </form>
        
        <a href="{{ url('/ubahkatasandi') }}" class="change-password">Ubah Kata Sandi</a><br>
    </div>

    <!-- Modal untuk Zoom Image -->
    <div class="modal" id="modal" onclick="hideModal()">
        <img id="modalImage" src="" alt="Profile Preview">
    </div>

    <!-- Toast Notification -->
    <div class="toast" id="toast"></div>

    <script>
        // Load saved data from localStorage when page loads
        document.addEventListener('DOMContentLoaded', function() {
            const savedData = JSON.parse(localStorage.getItem('profileData')) || {};
            
            if (savedData.profileImage) {
                document.getElementById('profileImage').src = savedData.profileImage;
            }
            
            if (savedData.nama) {
                document.getElementById('nama').value = savedData.nama;
            }
            
            if (savedData.email) {
                document.getElementById('email').value = savedData.email;
            }
        });

        // Handle profile photo change
        document.getElementById('fileInput').addEventListener('change', function(event) {
            const file = event.target.files[0];
            if (file) {
                // Validate file type
                if (!file.type.match('image.*')) {
                    showToast('Hanya file gambar yang diperbolehkan');
                    return;
                }
                
                // Validate file size (max 2MB)
                if (file.size > 2 * 1024 * 1024) {
                    showToast('Ukuran file terlalu besar. Maksimal 2MB');
                    return;
                }
                
                const reader = new FileReader();
                reader.onload = function(e) {
                    const profileImage = document.getElementById('profileImage');
                    profileImage.src = e.target.result;
                    
                    // Save to localStorage
                    const currentData = JSON.parse(localStorage.getItem('profileData')) || {};
                    currentData.profileImage = e.target.result;
                    localStorage.setItem('profileData', JSON.stringify(currentData));
                    
                    showToast('Foto profil berhasil diubah');
                };
                reader.readAsDataURL(file);
            }
        });

        // Handle form submission
        document.getElementById('editProfileForm').addEventListener('submit', function(event) {
            event.preventDefault();
            
            if (this.checkValidity()) {
                const submitBtn = document.getElementById('submitBtn');
                submitBtn.classList.add('loading');
                submitBtn.disabled = true;
                
                // Simulate API call delay
                setTimeout(() => {
                    // Get form values
                    const nama = document.getElementById('nama').value;
                    const email = document.getElementById('email').value;
                    const profileImage = document.getElementById('profileImage').src;
                    
                    // Save to localStorage
                    const profileData = {
                        nama: nama,
                        email: email,
                        profileImage: profileImage
                    };
                    localStorage.setItem('profileData', JSON.stringify(profileData));
                    
                    // Show success message
                    showToast('Perubahan berhasil disimpan');
                    
                    submitBtn.classList.remove('loading');
                    submitBtn.disabled = false;
                    
                    // Optional: Redirect after saving
                    // window.location.href = "profil.html";
                }, 1000);
            } else {
                this.reportValidity();
            }
        });

        // Show modal with enlarged image
        function showModal() {
            const profileImage = document.getElementById('profileImage').src;
            if (profileImage.includes('default-avatar.png')) return;
            
            document.getElementById('modalImage').src = profileImage;
            document.getElementById('modal').style.display = 'flex';
            document.body.style.overflow = 'hidden';
        }

        // Hide modal
        function hideModal() {
            document.getElementById('modal').style.display = 'none';
            document.body.style.overflow = 'auto';
        }

        // Show toast notification
        function showToast(message) {
            const toast = document.getElementById('toast');
            toast.textContent = message;
            toast.classList.add('show');
            
            setTimeout(() => {
                toast.classList.remove('show');
            }, 3000);
        }

        // Close modal when pressing ESC key
        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                hideModal();
            }
        });

        // Add ripple effect to buttons
        document.querySelectorAll('.submit-btn, .change-photo').forEach(button => {
            button.addEventListener('click', function(e) {
                const rect = this.getBoundingClientRect();
                const x = e.clientX - rect.left;
                const y = e.clientY - rect.top;
                
                const ripple = document.createElement('span');
                ripple.style.left = `${x}px`;
                ripple.style.top = `${y}px`;
                ripple.classList.add('ripple-effect');
                
                this.appendChild(ripple);
                
                setTimeout(() => {
                    ripple.remove();
                }, 600);
            });
        });

        // Add ripple effect styles dynamically
        const style = document.createElement('style');
        style.textContent = `
            .ripple-effect {
                position: absolute;
                border-radius: 50%;
                background-color: rgba(255, 255, 255, 0.7);
                transform: scale(0);
                animation: ripple 0.6s linear;
                pointer-events: none;
            }
            
            @keyframes ripple {
                to {
                    transform: scale(4);
                    opacity: 0;
                }
            }
        `;
        document.head.appendChild(style);
    </script>
</body>
</html>
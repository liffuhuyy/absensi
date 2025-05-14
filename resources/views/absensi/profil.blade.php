<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Pengguna</title>
    <style>
        :root {
            --primary: #0f172a;
            --secondary: #1e3a8a;
            --success: #10b981;
            --danger: #ef4444;
            --gray: #64748b;
            --light-gray: #e2e8f0;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f0f2f5;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            padding: 20px;
            transition: background-color 0.3s ease;
        }
        
        .container {
            background: white;
            border-radius: 15px;
            padding: 25px;
            width: 100%;
            max-width: 320px;
            text-align: center;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08);
            transform: translateY(0);
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }
        
        .container:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.12);
        }
        
        .profile-pic-container {
            position: relative;
            display: inline-block;
            margin-bottom: 15px;
        }
        
        .profile-pic {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            background: linear-gradient(45deg, var(--primary), var(--secondary));
            display: inline-block;
            overflow: hidden;
            transition: all 0.3s ease;
            object-fit: cover;
            cursor: pointer;
            border: 3px solid white;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.1);
        }
        
        .profile-pic:hover {
            transform: scale(1.05);
            box-shadow: 0 5px 15px rgba(15, 23, 42, 0.3);
        }
        
        .profile-pic-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            opacity: 0;
            transition: opacity 0.3s ease;
            color: white;
            font-size: 12px;
            text-align: center;
            pointer-events: none;
        }
        
        .profile-pic-container:hover .profile-pic-overlay {
            opacity: 1;
        }
        
        .profile-info {
            margin-bottom: 25px;
        }
        
        .profile-info h3 {
            margin: 10px 0 5px;
            color: var(--primary);
            font-size: 1.4rem;
            font-weight: 600;
        }
        
        .profile-info p {
            color: var(--gray);
            margin: 0;
            font-size: 0.9rem;
        }
        
        .profile-detail {
            display: flex;
            align-items: center;
            margin: 8px 0;
            text-align: left;
        }
        
        .profile-detail i {
            width: 24px;
            color: var(--gray);
            font-size: 16px;
            margin-right: 10px;
            text-align: center;
        }
        
        .profile-detail span {
            flex: 1;
            color: var(--primary);
            font-size: 0.95rem;
        }
        
        .button-container {
            display: flex;
            flex-direction: column;
            gap: 12px;
            margin: 25px 0;
        }
        
        .button {
            width: 100%;
            padding: 12px;
            background: var(--primary);
            color: white;
            border: none;
            border-radius: 25px;
            cursor: pointer;
            font-size: 14px;
            font-weight: 600;
            box-sizing: border-box;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .button:hover {
            background: var(--secondary);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(15, 23, 42, 0.3);
        }
        
        .button:active {
            transform: translateY(0);
        }
        
        .button.secondary {
            background: var(--gray);
        }
        
        .button.secondary:hover {
            background: #475569;
        }
        
        .button.success {
            background: var(--success);
        }
        
        .button i {
            margin-right: 8px;
        }
        
        .logout-link {
            text-decoration: none;
            color: var(--gray);
            font-size: 0.9rem;
            transition: all 0.3s ease;
            display: inline-block;
            padding: 8px 15px;
            border-radius: 5px;
        }
        
        .logout-link:hover {
            color: var(--danger);
            background-color: rgba(239, 68, 68, 0.1);
        }
        
        .edit-container {
            display: none;
            animation: fadeIn 0.4s ease-out;
        }
        
        .form-group {
            margin-bottom: 15px;
            text-align: left;
        }
        
        .form-group label {
            display: block;
            margin-bottom: 5px;
            color: var(--primary);
            font-size: 0.9rem;
            font-weight: 500;
        }
        
        .form-control {
            width: 100%;
            padding: 10px 12px;
            border: 1px solid var(--light-gray);
            border-radius: 8px;
            transition: all 0.3s ease;
            font-size: 14px;
            box-sizing: border-box;
        }
        
        .form-control:focus {
            border-color: var(--secondary);
            box-shadow: 0 0 0 3px rgba(30, 58, 138, 0.1);
            outline: none;
        }
        
        .password-toggle {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: var(--gray);
        }
        
        .password-input-container {
            position: relative;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .fade-out {
            animation: fadeOut 0.3s ease-out forwards;
        }
        
        @keyframes fadeOut {
            from { opacity: 1; transform: translateY(0); }
            to { opacity: 0; transform: translateY(-10px); }
        }
        
        #fileInput, #editFileInput {
            display: none;
        }
        
        .material-icons {
            font-family: 'Material Icons';
            font-weight: normal;
            font-style: normal;
            font-size: 24px;
            line-height: 1;
            letter-spacing: normal;
            text-transform: none;
            display: inline-block;
            white-space: nowrap;
            word-wrap: normal;
            direction: ltr;
            -webkit-font-feature-settings: 'liga';
            -webkit-font-smoothing: antialiased;
        }
    </style>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>
<body>
    <!-- Kontainer Profil Pengguna -->
    <div class="container" id="profileContainer">
        <div class="profile-pic-container">
            <img id="profileImage" class="profile-pic" src="https://via.placeholder.com/100" alt="Profile Picture">
            <div class="profile-pic-overlay">
                <span class="material-icons">photo_camera</span>
            </div>
        </div>
        <input type="file" id="fileInput" accept="image/*">
        
        <div class="profile-info">
            <h3 id="userName">Nama Siswa</h3>
            <p id="userEmail">siswa@email.com</p>
        </div>
        
        <div class="profile-detail">
            <i class="material-icons">mail</i>
            <span id="displayEmail">siswa@email.com</span>
        </div>
        <div class="profile-detail">
            <i class="material-icons">phone</i>
            <span id="displayPhone">08575467890</span>
        </div>
        
        <div class="button-container">
            <button class="button" id="editProfileBtn">
                <i class="material-icons">edit</i> Edit Profil
            </button>
            <a href="{{ url('/biodata') }}" class="button">
                <i class="material-icons">assignment_ind</i> Biodata
            </a>
        </div>
        
        <p><a href="javascript:void(0)" class="logout-link" id="logoutBtn">
            <i class="material-icons">logout</i> Logout
        </a></p>
    </div>

    <!-- Edit Profile Container (hidden by default) -->
    <div class="container edit-container" id="editProfile">
        <h3>Edit Profil</h3>
        
        <div class="profile-pic-container">
            <img id="editProfileImage" class="profile-pic" src="https://via.placeholder.com/100" alt="Profile Picture">
            <div class="profile-pic-overlay">
                <span class="material-icons">photo_camera</span>
            </div>
        </div>
        <input type="file" id="editFileInput" accept="image/*">
        
        <form id="profileForm">
            <div class="form-group">
                <label for="editName">Nama Lengkap</label>
                <input type="text" id="editName" class="form-control" placeholder="Nama Lengkap" value="Nama Siswa">
            </div>
            
            <div class="form-group">
                <label for="editEmail">Email</label>
                <input type="email" id="editEmail" class="form-control" placeholder="Email" value="siswa@email.com">
            </div>
            
            <div class="form-group">
                <label for="editPhone">Nomor HP</label>
                <input type="tel" id="editPhone" class="form-control" placeholder="Nomor Telepon" value="08575467890">
            </div>
            
            <div class="form-group">
                <label for="editPassword">Password Baru (Kosongkan jika tidak ingin mengubah)</label>
                <div class="password-input-container">
                    <input type="password" id="editPassword" class="form-control" placeholder="Password Baru">
                    <span class="material-icons password-toggle" id="togglePassword">visibility</span>
                </div>
            </div>
            
            <div class="form-group">
                <label for="editConfirmPassword">Konfirmasi Password Baru</label>
                <div class="password-input-container">
                    <input type="password" id="editConfirmPassword" class="form-control" placeholder="Konfirmasi Password">
                    <span class="material-icons password-toggle" id="toggleConfirmPassword">visibility</span>
                </div>
            </div>
            
            <div class="button-container">
                <button type="submit" class="button success" id="saveProfileBtn">
                    <i class="material-icons">save</i> Simpan Perubahan
                </button>
                <button type="button" class="button secondary" id="cancelEditBtn">
                    <i class="material-icons">cancel</i> Batal
                </button>
            </div>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // DOM Elements
            const profileContainer = document.getElementById('profileContainer');
            const editProfile = document.getElementById('editProfile');
            const editProfileBtn = document.getElementById('editProfileBtn');
            const saveProfileBtn = document.getElementById('saveProfileBtn');
            const cancelEditBtn = document.getElementById('cancelEditBtn');
            const logoutBtn = document.getElementById('logoutBtn');
            
            // Profile Info Elements
            const userName = document.getElementById('userName');
            const userEmail = document.getElementById('userEmail');
            const displayEmail = document.getElementById('displayEmail');
            const displayPhone = document.getElementById('displayPhone');
            
            // Edit Form Elements
            const editName = document.getElementById('editName');
            const editEmail = document.getElementById('editEmail');
            const editPhone = document.getElementById('editPhone');
            const editPassword = document.getElementById('editPassword');
            const editConfirmPassword = document.getElementById('editConfirmPassword');
            
            // Profile Image Elements
            const profileImage = document.getElementById('profileImage');
            const editProfileImage = document.getElementById('editProfileImage');
            const fileInput = document.getElementById('fileInput');
            const editFileInput = document.getElementById('editFileInput');
            const profilePicContainer = document.querySelector('.profile-pic-container');
            const editProfilePicContainer = document.querySelector('#editProfile .profile-pic-container');
            
            // Password Toggle Elements
            const togglePassword = document.getElementById('togglePassword');
            const toggleConfirmPassword = document.getElementById('toggleConfirmPassword');
            
            // Load profile data from localStorage
            let profileData = JSON.parse(localStorage.getItem('profileData')) || {
                name: 'Nama Siswa',
                email: 'siswa@email.com',
                phone: '08575467890',
                photo: 'https://via.placeholder.com/100'
            };
            
            // Initialize profile
            function initProfile() {
                userName.textContent = profileData.name;
                userEmail.textContent = profileData.email;
                displayEmail.textContent = profileData.email;
                displayPhone.textContent = profileData.phone;
                profileImage.src = profileData.photo;
                editProfileImage.src = profileData.photo;
                
                // Set edit form values
                editName.value = profileData.name;
                editEmail.value = profileData.email;
                editPhone.value = profileData.phone;
            }
            
            // Display image preview
            function displayImage(input, imgElement) {
                if (input.files && input.files[0]) {
                    const reader = new FileReader();
                    
                    reader.onload = function(e) {
                        imgElement.src = e.target.result;
                        
                        // Animation when image changes
                        imgElement.style.transform = 'scale(0.95)';
                        setTimeout(() => {
                            imgElement.style.transform = 'scale(1)';
                        }, 200);
                        
                        // If changing profile image in main view
                        if (imgElement === profileImage) {
                            profileData.photo = e.target.result;
                            localStorage.setItem('profileData', JSON.stringify(profileData));
                        }
                    }
                    
                    reader.readAsDataURL(input.files[0]);
                }
            }
            
            // Toggle password visibility
            function togglePasswordVisibility(input, toggleIcon) {
                if (input.type === 'password') {
                    input.type = 'text';
                    toggleIcon.textContent = 'visibility_off';
                } else {
                    input.type = 'password';
                    toggleIcon.textContent = 'visibility';
                }
            }
            
            // Event Listeners
            profilePicContainer.addEventListener('click', function() {
                fileInput.click();
            });
            
            editProfilePicContainer.addEventListener('click', function() {
                editFileInput.click();
            });
            
            fileInput.addEventListener('change', function() {
                displayImage(this, profileImage);
            });
            
            editFileInput.addEventListener('change', function() {
                displayImage(this, editProfileImage);
            });
            
            togglePassword.addEventListener('click', function() {
                togglePasswordVisibility(editPassword, togglePassword);
            });
            
            toggleConfirmPassword.addEventListener('click', function() {
                togglePasswordVisibility(editConfirmPassword, toggleConfirmPassword);
            });
            
            editProfileBtn.addEventListener('click', function(e) {
                e.preventDefault();
                profileContainer.classList.add('fade-out');
                
                setTimeout(() => {
                    profileContainer.style.display = 'none';
                    editProfile.style.display = 'block';
                }, 300);
            });
            
            cancelEditBtn.addEventListener('click', function() {
                editProfile.classList.add('fade-out');
                
                setTimeout(() => {
                    editProfile.style.display = 'none';
                    profileContainer.style.display = 'block';
                    profileContainer.classList.remove('fade-out');
                    
                    // Reset form to original values
                    editName.value = profileData.name;
                    editEmail.value = profileData.email;
                    editPhone.value = profileData.phone;
                    editPassword.value = '';
                    editConfirmPassword.value = '';
                    editProfileImage.src = profileData.photo;
                }, 300);
            });
            
            document.getElementById('profileForm').addEventListener('submit', function(e) {
                e.preventDefault();
                
                // Validate form
                if (!editName.value.trim()) {
                    alert('Nama lengkap tidak boleh kosong');
                    return;
                }
                
                if (!editEmail.value.trim()) {
                    alert('Email tidak boleh kosong');
                    return;
                }
                
                if (!editPhone.value.trim()) {
                    alert('Nomor HP tidak boleh kosong');
                    return;
                }
                
                if (editPassword.value !== editConfirmPassword.value) {
                    alert('Password baru dan konfirmasi password tidak sama');
                    return;
                }
                
                // Update profile data
                profileData.name = editName.value;
                profileData.email = editEmail.value;
                profileData.phone = editPhone.value;
                profileData.photo = editProfileImage.src;
                
                // If password changed
                if (editPassword.value.trim()) {
                    // In a real app, you would hash the password here
                    alert('Password berhasil diubah!');
                }
                
                // Save to localStorage
                localStorage.setItem('profileData', JSON.stringify(profileData));
                
                // Update profile display
                initProfile();
                
                // Show success feedback
                saveProfileBtn.innerHTML = '<i class="material-icons">check</i> Berhasil Disimpan';
                
                setTimeout(() => {
                    saveProfileBtn.innerHTML = '<i class="material-icons">save</i> Simpan Perubahan';
                    
                    // Return to profile view
                    editProfile.classList.add('fade-out');
                    
                    setTimeout(() => {
                        editProfile.style.display = 'none';
                        profileContainer.style.display = 'block';
                        profileContainer.classList.remove('fade-out');
                        
                        // Reset password fields
                        editPassword.value = '';
                        editConfirmPassword.value = '';
                    }, 300);
                }, 1500);
            });
            
            logoutBtn.addEventListener('click', function(e) {
                e.preventDefault();
                
                const confirmed = confirm('Apakah Anda yakin ingin logout?');
                if (confirmed) {
                    document.body.style.backgroundColor = 'var(--primary)';
                    document.querySelector('.container').classList.add('fade-out');
                    
                    setTimeout(() => {
                        window.location.href = "{{ url('/index') }}";
                    }, 500);
                }
            });
            
            // Button hover effects
            const buttons = document.querySelectorAll('.button');
            buttons.forEach(button => {
                button.addEventListener('mouseenter', function() {
                    this.style.transform = 'translateY(-2px)';
                });
                button.addEventListener('mouseleave', function() {
                    this.style.transform = 'translateY(0)';
                });
                button.addEventListener('mousedown', function() {
                    this.style.transform = 'translateY(1px)';
                });
                button.addEventListener('mouseup', function() {
                    this.style.transform = 'translateY(-2px)';
                });
            });
            
            // Initialize the profile
            initProfile();
        });
    </script>
</body>
</html>
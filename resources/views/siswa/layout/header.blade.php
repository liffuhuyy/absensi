   <div class="header">
       <div class="menu-toggle" id="menuToggle">
           <span></span>
           <span></span>
           <span></span>
       </div>
       <h3>SMKN 1 SUBANG</h3>

       <div class="profile-icon">
           <a href="{{ url('/profil') }}">
               <img src="{{ Auth::user()->biodata && Auth::user()->biodata->foto
                   ? asset('storage/' . Auth::user()->biodata->foto)
                   : asset('default-avatar.png') }}"
                   alt="Foto Profil" style="width: 40px; height: 40px; border-radius: 50%; object-fit: cover;">
           </a>
       </div>

   </div>

   <div class="header">
       <div class="menu-toggle" id="menuToggle">
           <span></span>
           <span></span>
           <span></span>
       </div>
       <h4>SMKN 1 SUBANG</h4>

       <div class="profile-icon">
           <a href="{{ url('/profil') }}">
               <img src="{{ Auth::user()->biodata && Auth::user()->biodata->foto
                   ? asset('storage/' . Auth::user()->biodata->foto)
                   : 'https://ui-avatars.com/api/?name=' . Auth::user()->nama . '&background=random' }}"
                   alt="Foto Profil" style="width: 40px; height: 40px; border-radius: 50%; object-fit: cover;">
           </a>
       </div>

   </div>

   <header class="nav">
       <div class="container">
           <div class="nav-inner">
               <a class="brand" href="{{ url('/') }}">
                   <img src="{{ asset('image/logo-nav.png') }}" alt="Logo-RoomKos" class="logo-nav">
               </a>

               {{-- Desktop --}}
               <nav class="nav-links" aria-label="Navigasi">
                   <a href="#rekomendasi">Rekomendasi</a>
                   <a href="#kenapa">Kenapa</a>
                   <a href="#cara">Cara Kerja</a>
               </nav>

               <div class="nav-actions">
                   <a class="btn btn-ghost" href="{{ route('mahasiswa.login') }}">
                       <span><i class="fa-solid fa-right-to-bracket"></i></span> Masuk
                   </a>

                   <a class="btn btn-primary" href="{{ route('mahasiswa.register') }}">
                       <span><i class="fa-solid fa-user-plus"></i></span> Daftar
                   </a>
               </div>

               {{-- Mobile toggle --}}
               <label class="icon-btn" for="navToggle" aria-label="Buka menu">
                   <span class="hamburger" aria-hidden="true">
                       <span></span><span></span><span></span>
                   </span>
                   <span class="sr-only">Menu</span>
               </label>
           </div>

           <input id="navToggle" type="checkbox" aria-hidden="true">

           {{-- Mobile menu --}}
           <div class="mobile-menu">
               <div class="mobile-links">
                   <a href="#rekomendasi" onclick="document.getElementById('navToggle').checked=false">Rekomendasi</a>
                   <a href="#kenapa" onclick="document.getElementById('navToggle').checked=false">Kenapa RoomKos</a>
                   <a href="#cara" onclick="document.getElementById('navToggle').checked=false">Cara Kerja</a>
               </div>
               <div class="mobile-actions">
                   <a class="btn btn-ghost" href="{{ route('mahasiswa.login') }}">Masuk</a>
                   <a class="btn btn-primary" href="{{ route('mahasiswa.register') }}">Daftar</a>
               </div>
           </div>
       </div>
   </header>

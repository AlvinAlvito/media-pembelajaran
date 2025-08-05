<nav>
    <div class="logo-name">
        <div class="logo-image">
            <img src="/images/logo.jpg"  alt="">
        </div>

        <span class="logo_name">Pembelajaran Biologi</span>
    </div>

    <div class="menu-items">
        <ul class="nav-links">
            <li >
                <a href="/admin" class="{{ Request::is('/admin') ? 'active' : '' }}">
                    <i class="uil uil-estate"></i>
                    <span class="link-name">Beranda</span>
                </a>
            </li>
             <li >
                <a href="/admin/data-materi" class="{{ Request::is('/admin/data-materi') ? 'active' : '' }}">
                    <i class="uil uil-chart"></i>
                    <span class="link-name">Data Materi</span>
                </a>
            </li>
            <li >
                <a href="/admin/data-soal" class="{{ Request::is('/admin/data-soal') ? 'active' : '' }}">
                    <i class="uil uil-files-landscapes"></i>
                    <span class="link-name">Data Quiz</span>
                </a>
            </li>
             <li >
                <a href="/admin/data-siswa" class="{{ Request::is('/admin/data-siswa') ? 'active' : '' }}">
                    <i class="uil uil-files-landscapes"></i>
                    <span class="link-name">Data Siswa</span>
                </a>
            </li>
           
        </ul>
        

        <ul class="logout-mode">
            <li><a href="/">
                    <i class="uil uil-signout"></i>
                    <span class="link-name">Logout</span>
                </a></li>

            <li class="mode">
                <a href="#">
                    <i class="uil uil-moon"></i>
                    <span class="link-name">Dark Mode</span>
                </a>

                <div class="mode-toggle">
                    <span class="switch"></span>
                </div>
            </li>
        </ul>
    </div>
</nav>

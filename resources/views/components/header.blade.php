<header class="header">
    <div class="header-title">
        <span class="highlight">
            Selamat Datang {{ Auth::user()->nama ?? 'User' }}
        </span>
    </div>
    <div class="header-search">
        <input type="text" placeholder="Tuliskan tipe kos yang anda cari" />
        <span class="search-icon">&#128269;</span>
    </div>
</header>
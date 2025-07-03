<aside class="sidebar">
    <nav>
        <ul>
            <li>
                <a href="{{ route('dashboard') }}" title="Dashboard">
                    <span>&#128202;</span>
                </a>
            </li>
            <li>
                <a href="{{ route('kontrak.saya') }}" title="Kontrak Saya">
                    <span>&#128221;</span>
                </a>
            </li>
            <li>
                <a href="{{ route('riwayat.pembayaran') }}" title="Riwayat Pembayaran">
                    <span>&#128184;</span>
                </a>
            </li>

            <li>
                <a href="{{ route('keluhan.index') }}" title="Keluhan">
                    <span>&#8505;</span>
                </a>
            </li>
            <li>
                <a href="{{ route('notifikasi.index') }}" title="Notifikasi">
                    <span>&#128276;</span>
                </a>
            </li>
            <li>
                <a href="{{ route('profile.show') }}" title="Profile">
                    <span>&#128100;</span>
                </a>
            </li>
        </ul>
    </nav>
    <form method="POST" action="{{ route('logout') }}" class="logout-form">
        @csrf
        <button type="submit" class="logout-btn" title="Logout">
            <span style="font-size: 28px;">&#9099;</span>
        </button>
    </form>
</aside>
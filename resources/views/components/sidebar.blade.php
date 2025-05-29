<aside class="sidebar">
    <nav>
        <ul>
            <li>
                <a href="{{ route('dashboard') }}" title="Dashboard">
                    <span>&#8962;</span>
                </a>
            </li>
            <li>
                <a href="{{ route('notifikasi.index') }}" title="Notifikasi">
                    <span>&#9776;</span>
                </a>
            </li>
            <li>
                <a href="{{ route('pemesanan.index') }}" title="Pemesanan">
                    <span>&#128179;</span>
                </a>
            </li>
            <li>
                <a href="{{ route('keluhan.index') }}" title="Keluhan">
                    <span>&#128188;</span>
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
            <span style="font-size: 28px;">&#128682;</span>
        </button>
    </form>
</aside>
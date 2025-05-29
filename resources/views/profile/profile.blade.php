<x-app-layout>
    <div class="dashboard-container">
        <x-sidebar />
        <main class="main-content">
            <section class="profile-section">
                <h2 class="profile-title">Profile</h2>
                <div class="profile-avatar-wrapper">
                    <img src="{{ $user->foto_profile 
                        ? asset('storage/' . $user->foto_profile) 
                        : asset('images/default-avatar.png') }}" 
                        alt="Profile Photo" class="profile-avatar">
                </div>
                <form class="profile-form">
                    <div class="profile-form-group">
                        <label>Full Name</label>
                        <input type="text" value="{{ $user->nama }}" readonly>
                    </div>
                    <div class="profile-form-group">
                        <label>Email</label>
                        <input type="email" value="{{ $user->email }}" readonly>
                    </div>
                    <div class="profile-form-group">
                        <label>Mobile Phone Number</label>
                        <input type="text" value="{{ $user->no_hp ?? '' }}" readonly>
                    </div>
                    <div class="profile-form-group">
                        <label>Gender</label>
                        <input type="text" value="{{ $user->gender == 'L' ? 'Male' : ($user->gender == 'P' ? 'Female' : '') }}" readonly>
                    </div>
                    <div class="profile-form-actions">
                        <a href="{{ url()->previous() }}" class="profile-btn-back">Back</a>
                        <a href="{{ route('profile.edit') }}" class="profile-btn-edit">Edit Profile</a>
                    </div>
                </form>
            </section>
        </main>
    </div>
    @vite([
        'resources/css/profile.css',
        'resources/js/profile.js',
        'resources/css/dashboard.css',
        'resources/js/dashboard.js'
    ])
</x-app-layout>
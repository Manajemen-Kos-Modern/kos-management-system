<x-app-layout>
    <div class="dashboard-container">
        <x-sidebar />
        <main class="main-content">
            <section class="profile-section">
                <h2 class="profile-title">Edit Profile</h2>
                <form class="profile-form" method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    <div class="profile-avatar-wrapper" style="text-align:center;">
                        <img id="preview-foto" src="{{ $user->foto_profile 
                            ? asset('storage/' . $user->foto_profile) 
                            : asset('images/default-avatar.png') }}" 
                            alt="Profile Photo" class="profile-avatar" style="width:100px;height:100px;object-fit:cover;border-radius:50%;border:3px solid #ffe082;">
                        <input type="file" name="foto_profile" id="foto_profile" accept="image/*" style="margin-top:10px;">
                        @error('foto_profile')
                            <div class="error" style="color:red;">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="profile-form-group">
                        <label for="nama">Full Name</label>
                        <input type="text" id="nama" name="nama" value="{{ old('nama', $user->nama) }}" required>
                        @error('nama') <div class="error" style="color:red;">{{ $message }}</div> @enderror
                    </div>
                    <div class="profile-form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" required>
                        @error('email') <div class="error" style="color:red;">{{ $message }}</div> @enderror
                    </div>
                    <div class="profile-form-group">
                        <label for="no_hp">Mobile Phone Number</label>
                        <input type="text" id="no_hp" name="no_hp" value="{{ old('no_hp', $user->no_hp) }}">
                        @error('no_hp') <div class="error" style="color:red;">{{ $message }}</div> @enderror
                    </div>
                    <div class="profile-form-group">
                        <label for="gender">Gender</label>
                        <select id="gender" name="gender" required>
                            <option value="">Select</option>
                            <option value="L" {{ old('gender', $user->gender) == 'L' ? 'selected' : '' }}>Male</option>
                            <option value="P" {{ old('gender', $user->gender) == 'P' ? 'selected' : '' }}>Female</option>
                        </select>
                        @error('gender') <div class="error" style="color:red;">{{ $message }}</div> @enderror
                    </div>
                    <div class="profile-form-actions" style="margin-top:20px;">
                        <a href="{{ route('profile.show') }}" class="profile-btn-back" style="background:#ffe082;color:#333;padding:8px 20px;border-radius:6px;text-decoration:none;">Back</a>
                        <button type="submit" class="profile-btn-edit" style="background:#ffd600;color:#222;padding:8px 20px;border-radius:6px;border:none;">Save</button>
                    </div>
                    @if (session('status') === 'profile-updated')
                        <div style="color:green;margin-top:10px;">Profile updated successfully.</div>
                    @endif
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
    <script>
        // Preview foto sebelum upload
        document.getElementById('foto_profile').addEventListener('change', function(e) {
            const [file] = e.target.files;
            if (file) {
                document.getElementById('preview-foto').src = URL.createObjectURL(file);
            }
        });
    </script>
</x-app-layout>
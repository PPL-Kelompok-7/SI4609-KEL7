@extends('layouts.app')

@section('content')
<div class="container my-4" style="padding-top: 110px; padding-bottom: 100px;">
    <div class="row justify-content-center">
        <div class="col-12 col-md-8">
            <div class="card" style="background-color: #4728f0; border: none; border-radius: 15px;">
                <div class="card-body p-4">
                    <div class="text-center mb-4">
                        <h2 class="text-white mb-2">Perbarui Profil Anda</h2>
                        <p class="text-white-50">Lengkapi data diri Anda untuk pengalaman yang lebih baik</p>
                    </div>

                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" class="mt-4">
                        @csrf
                        @method('PUT')

                        <div class="text-center mb-5">
                            <div class="position-relative d-inline-block">
                                <div class="rounded-circle overflow-hidden" style="width: 160px; height: 160px; background: rgba(255, 255, 255, 0.1); border: 2px solid rgba(255, 255, 255, 0.2);">
                                    <img id="profile-preview" src="{{ (!empty($user->profile_photo) && file_exists(public_path('storage/' . $user->profile_photo))) ? Storage::url($user->profile_photo) : asset('profile2.png') }}"
                                         alt="Profile Photo" 
                                         style="width: 100%; height: 100%; object-fit: cover; display: block;" dusk="profile-preview">
                                </div>
                                <label for="profile_photo" class="position-absolute bottom-0 end-0 bg-white rounded-circle p-2 d-flex align-items-center justify-content-center" 
                                       style="width: 40px; height: 40px; cursor: pointer; box-shadow: 0 2px 8px rgba(0,0,0,0.2);">
                                    <i class="fas fa-camera text-primary"></i>
                                </label>
                                <input type="file" id="profile_photo" name="profile_photo" class="d-none" accept="image/*" dusk="profile_photo">
                            </div>
                            @error('profile_photo')
                                <span class="text-danger d-block mt-2">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="row g-4">
                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <label class="text-white-50 mb-2">Nama Depan <span style="color: #ff6b6b;">*</span></label>
                                    <input type="text" class="form-control bg-transparent text-white @error('first_name') is-invalid @enderror" 
                                           name="first_name" value="{{ old('first_name', $user->first_name) }}"
                                           style="border: 1px solid rgba(255,255,255,0.2);" required dusk="first_name">
                                    @error('first_name')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <label class="text-white-50 mb-2">Nama Belakang <span style="color: #ff6b6b;">*</span></label>
                                    <input type="text" class="form-control bg-transparent text-white @error('last_name') is-invalid @enderror" 
                                           name="last_name" value="{{ old('last_name', $user->last_name) }}"
                                           style="border: 1px solid rgba(255,255,255,0.2);" required dusk="last_name">
                                    @error('last_name')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <label class="text-white-50 mb-2">Email <span style="color: #ff6b6b;">*</span></label>
                                    <input type="email" class="form-control bg-transparent text-white @error('email') is-invalid @enderror" 
                                           name="email" value="{{ old('email', $user->email) }}"
                                           style="border: 1px solid rgba(255,255,255,0.2);" disabled required>
                                    @error('email')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <label class="text-white-50 mb-2">Mobile Phone</label>
                                    <input type="text" class="form-control bg-transparent text-white @error('mobile_phone') is-invalid @enderror" 
                                           name="mobile_phone" value="{{ old('mobile_phone', $user->mobile_phone) }}"
                                           style="border: 1px solid rgba(255,255,255,0.2);" dusk="mobile_phone">
                                    @error('mobile_phone')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <label class="text-white-50 mb-2">Profesi <span style="color: #ff6b6b;">*</span></label>
                                    <input type="text" class="form-control bg-transparent text-white @error('profession') is-invalid @enderror" 
                                           name="profession" value="{{ old('profession', $user->profession) }}"
                                           style="border: 1px solid rgba(255,255,255,0.2);" required dusk="profession">
                                    @error('profession')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <label class="text-white-50 mb-2">Domisili <span style="color: #ff6b6b;">*</span></label>
                                    <input type="text" class="form-control bg-transparent text-white @error('domicile') is-invalid @enderror" 
                                           name="domicile" value="{{ old('domicile', $user->domicile) }}"
                                           style="border: 1px solid rgba(255,255,255,0.2);" required dusk="domicile">
                                    @error('domicile')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="d-flex flex-column flex-md-row justify-content-between gap-3 mt-5">
                            <a href="{{ route('profile') }}" class="btn btn-light px-4 order-2 order-md-1">Batal</a>
                            <button type="submit" class="btn btn-success px-4 order-1 order-md-2" dusk="save-profile-btn">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
console.log('Profile edit script loaded');

// Fungsi untuk preview foto
function previewImage(input) {
    console.log('previewImage function called', input);
    
    if (!input) {
        console.error('Input is null or undefined');
        return;
    }
    
    console.log('Input files:', input.files);
    
    if (input.files && input.files[0]) {
        const file = input.files[0];
        
        // Debug log
        console.log('File selected:', {
            name: file.name,
            type: file.type,
            size: file.size,
            lastModified: file.lastModified
        });
        
        // Validasi tipe file
        const allowedTypes = ['image/jpeg', 'image/png', 'image/jpg'];
        if (!allowedTypes.includes(file.type)) {
            console.warn('Invalid file type:', file.type);
            alert('Hanya file JPG, JPEG, dan PNG yang diperbolehkan');
            input.value = '';
            return;
        }
        
        // Validasi ukuran file (max 2MB)
        if (file.size > 2 * 1024 * 1024) {
            console.warn('File too large:', file.size);
            alert('Ukuran file maksimal 2MB');
            input.value = '';
            return;
        }

        const reader = new FileReader();
        
        reader.onload = function(e) {
            console.log('FileReader onload triggered');
            const preview = document.getElementById('profile-preview');
            console.log('Preview element:', preview);
            
            if (preview) {
                // Sembunyikan gambar saat sedang dimuat
                preview.style.opacity = '0';
                preview.src = e.target.result;
                
                // Tampilkan gambar dengan fade in effect
                preview.onload = function() {
                    preview.style.transition = 'opacity 0.3s ease-in-out';
                    preview.style.opacity = '1';
                };
            } else {
                console.error('Preview element not found');
            }
        };

        reader.onprogress = function(e) {
            if (e.lengthComputable) {
                console.log(`Read progress: ${Math.round((e.loaded / e.total) * 100)}%`);
            }
        };

        reader.onerror = function(e) {
            console.error('FileReader error:', e, reader.error);
            alert('Terjadi kesalahan saat membaca file');
        };

        try {
            console.log('Starting to read file...');
            reader.readAsDataURL(file);
        } catch (error) {
            console.error('Error starting file read:', error);
        }
    } else {
        console.log('No file selected or files property not supported');
    }
}

// Event listener untuk perubahan file menggunakan jQuery
$(document).ready(function() {
    console.log('Document ready');
    
    const fileInput = $('#profile_photo');
    console.log('File input element:', fileInput.length ? 'Found' : 'Not found');
    
    fileInput.on('change', function(e) {
        console.log('File input change event triggered', e);
        previewImage(this);
    });
});

// Tambahkan placeholder text putih untuk input
document.querySelectorAll('.form-control').forEach(input => {
    input.style.color = 'white';
    input.style.placeholder = 'white';
});
</script>

<style>
.rounded-circle {
    position: relative;
    overflow: hidden;
}

#profile-preview {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
    transition: opacity 0.3s ease-in-out;
}

.fa-camera {
    font-size: 1.2rem;
}
</style>
@endpush 
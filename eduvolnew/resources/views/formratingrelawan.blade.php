<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Rating Relawan</title>
    <link rel="stylesheet" href="{{ asset('css/formrating.css') }}">
</head>
<body>
    <div class="form-container">
        <!-- Left Section -->
        <div class="left-section">
            <h1 class="form-title">
                Berikan Rating Anda<br>
                untuk "<strong>{{ $relawan->first_name }}</strong>" !
            </h1>
            
            <div class="profile-section">
                @if ($relawan->profile_photo)
                    <img src="{{ asset('storage/' . $relawan->profile_photo) }}" class="profile-photo" alt="{{ $relawan->first_name }}">
                @else
                    <div class="profile-photo no-photo">
                        No Photo
                    </div>
                @endif
                
        <div class="profile-info">
            {{ $event->title }}<br>
            {{ $event->deskripsi ?? '' }}
        </div>


            </div>
        </div>

        <!-- Right Section -->
        <div class="right-section">
            @if (isset($success))
                <div class="success-message">{{ $success }}</div>
                <a href="{{ route('ratingrelawan') }}" class="btn btn-submit" style="background-color: #5137b7; text-align: center; display: block; margin-top: 20px;">Kembali ke Halaman Rating</a>
            @else
                <div class="section-title">
                    Silahkan isi penilaian anda, harap diisi dengan bijak!
                </div>

                <form method="POST" action="{{ route('formrating.store') }}">
                    @csrf
                    <input type="hidden" name="relawan_id" value="{{ $relawan->id }}">
                    <input type="hidden" name="event_id" value="{{ $event_id }}">
                    
                    <div class="rating-section">
                        <h2 class="rating-title">Rating 1-10</h2>
                        <div class="rating-input-container">
                            <input type="number" name="rating_score" id="rating_score" class="rating-input" 
                                   value="1" min="1" max="10" required>
                            <div class="rating-buttons">
                                <button type="button" class="rating-btn" onclick="decreaseRating()">−</button>
                                <button type="button" class="rating-btn" onclick="increaseRating()">+</button>
                            </div>
                        </div>
                    </div>

                    <div class="feedback-section">
                        <label class="feedback-label">
                            Berikan Feedback untuk Relawan (Maks. 300 Kata)
                        </label>
                        <textarea name="rating_description" id="rating_description" 
                                  class="feedback-textarea" 
                                  placeholder="Tulis feedback Anda di sini..."
                                  maxlength="300" rows="5" required></textarea>
                    </div>

                    <div class="button-section">
                        <a href="{{ route('ratingrelawan') }}" class="btn btn-cancel">Batal</a>
                        <button type="submit" class="btn btn-submit">Submit Rating Relawan</button>
                    </div>
                </form>
            @endif
        </div>
    </div>

    <script>
        function increaseRating() {
            const input = document.getElementById('rating_score');
            const currentValue = parseInt(input.value) || 1;
            if (currentValue < 10) {
                input.value = currentValue + 1;
            }
        }

        function decreaseRating() {
            const input = document.getElementById('rating_score');
            const currentValue = parseInt(input.value) || 1;
            if (currentValue > 1) {
                input.value = currentValue - 1;
            }
        }

        // Auto-resize textarea and character feedback
        const textarea = document.querySelector('.feedback-textarea');
        if (textarea) {
            textarea.addEventListener('input', function() {
                const remaining = 300 - this.value.length;
                if (remaining < 50) {
                    this.style.borderColor = remaining < 0 ? '#ff4444' : '#ffaa00';
                } else {
                    this.style.borderColor = '#ddd';
                }
            });
        }
    </script>
</body>
</html>
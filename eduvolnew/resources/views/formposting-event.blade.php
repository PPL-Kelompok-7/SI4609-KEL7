<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftarkan Event Anda</title>
    <link rel="stylesheet" href="{{ asset('css/formposting-event.css') }}">
</head>
<body>
    <div class="container">
        <form class="form-card">
            <h1>Daftarkan Event Anda!</h1>
            <p>Silahkan isi data untuk kegiatan volunteer Anda</p>

            <label>Nama Event :</label>
            <input type="text" name="nama_event" required>

            <div class="date-group">
                <label for="tanggal_event">Tanggal Event:</label>
                <input type="date" id="tanggal_event" name="tanggal_event" required>
            </div>

            <div class="time-group">
                <div>
                    <label>Jam Mulai :</label>
                    <input type="time" name="jam_mulai" required>
                </div>
                <div>
                    <label>Jam Berakhir :</label>
                    <input type="time" name="jam_berakhir" required>
                </div>
            </div>

            <div class="volunteer-group">
                <label for="kebutuhan_volunteer">Kebutuhan Volunteer (Orang):</label>
                <div class="volunteer-need">
                    <input type="number" id="kebutuhan_volunteer" name="kebutuhan_volunteer" min="0" value="0" required>
                    <button type="button" class="decrement">-</button>
                    <button type="button" class="increment">+</button>
                </div>
            </div>

            <label>Deskripsi Event</label>
            <textarea name="deskripsi_event" rows="4" required></textarea>

            <label>Nominal Tiket Volunteer 
                <span class="note">(Jika berbayar, jika tidak kosongkan)</span>
            </label>
            <div class="ticket-input">
                </label>
                 <div class="ticket-field">
                    <span>Rp</span>
                    <input type="number" id="nominal_tiket" name="nominal_tiket">
                </div>
            </div>

            <label class="upload-btn">
                + Pilih Foto Thumbnail Event (jpg max.10mb)
                <input type="file" name="thumbnail" accept="image/jpeg" hidden>
            </label>

            <div class="checkbox-group">
                <input type="checkbox" id="agreement" required>
                <label for="agreement">
                    Saya sudah membaca dan menyetujui 
                    <a href="#">syarat dan ketentuan</a> untuk mendaftarkan event di platform EduVolunteer.
                </label>
            </div>

            <div class="button-group">
                <button type="button" class="cancel-btn">Batal</button>
                <button type="submit" class="submit-btn">Daftarkan Event</button>
            </div>
        </form>
    </div>
</body>
</html>


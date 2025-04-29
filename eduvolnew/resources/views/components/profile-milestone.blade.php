<div class="milestone-card d-flex align-items-start">
  {{-- Circular Progress --}}
  <div class="progress-circle" style="--percent: 75%">
    <div class="percentage">75%</div>
  </div>

  <div class="milestone-details">
    {{-- Header: Badge Saat Ini --}}
    <div class="milestone-header">
      <img src="{{ asset('goldbadge.png') }}" alt="Gold Badge" class="badge-icon">
      <div>
        <div class="badge-label">Gold</div>
        <small class="text-white-50">Badge Saat Ini</small>
      </div>
    </div>

    {{-- Linear Progress Bar Menuju Badge Berikutnya --}}
    <div class="milestone-progress">
      <h6 class="text-white mb-2">Progress ke Platinum</h6>
      <div class="progress">
        <div class="progress-bar" role="progressbar"
             style="width: 75%;" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100">
        </div>
      </div>
      <div class="d-flex justify-content-between small text-white-50 mt-1">
        <span>75 sesi</span>
        <span>100 sesi</span>
      </div>
    </div>

    {{-- Ringkasan Kuantitatif --}}
    <div class="milestone-stats">
      <div><strong>45 sesi</strong> selesai</div>
      <div><strong>120 jam</strong> total</div>
    </div>

    {{-- Target Selanjutnya --}}
    <div class="milestone-target">
      5 sesi lagi untuk mencapai <strong>Platinum</strong>
    </div>

    {{-- Link Detail Milestone --}}
    <a href="{{ url('/milestone') }}" class="btn-milestone-detail">
      Lihat Detail Milestone
    </a>
  </div>
</div>
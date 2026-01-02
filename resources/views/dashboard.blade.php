<x-app-layout>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('services.midtrans.client_key') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;800&display=swap');
        
        :root {
            --bs-primary: #0061ff;
            --bs-primary-rgb: 0, 97, 255;
        }

        body { 
            background-color: #f8f9fc; 
            font-family: 'Inter', sans-serif; 
            color: #2d3436;
        }

        /* Hero Styling */
        .hero-section {
            background: linear-gradient(135deg, #0061ff 0%, #60efff 100%);
            border-radius: 2rem;
            padding: 3rem;
            color: white;
            margin-bottom: 2.5rem;
            position: relative;
            overflow: hidden;
        }

        .hero-img {
            width: 280px;
            filter: drop-shadow(0 20px 30px rgba(0,0,0,0.15));
        }

        /* Card Styling */
        .card-custom {
            border: none;
            border-radius: 1.5rem;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.04);
            transition: transform 0.3s ease;
        }

        .card-custom:hover {
            transform: translateY(-5px);
        }

        .stats-card {
            background: #ffffff;
            border-left: 5px solid var(--bs-primary);
        }

        /* Table Styling */
        .table-container {
            background: white;
            border-radius: 1.5rem;
            padding: 1.5rem;
        }

        .btn-modern {
            border-radius: 0.8rem;
            padding: 0.7rem 1.5rem;
            font-weight: 600;
            transition: all 0.2s;
        }

        .glass-modal {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(15px);
            border: 1px solid rgba(255, 255, 255, 0.3);
        }
        
        .badge-status {
            padding: 0.5rem 1rem;
            border-radius: 50rem;
            font-size: 0.75rem;
            font-weight: 700;
        }
    </style>

    <div class="container py-5">
        
        @if (session('success'))
            <div class="alert alert-success border-0 shadow-sm rounded-4 mb-4" role="alert">
                <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
            </div>
        @endif

        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h4 class="fw-800 text-dark mb-1">Dashboard Overview</h4>
                <p class="text-muted small">Selamat datang kembali, <strong>{{ Auth::user()->name }}</strong></p>
            </div>
            <div class="text-end">
                <span class="badge bg-white text-dark shadow-sm py-2 px-3 rounded-pill">
                    <i class="bi bi-calendar3 me-2 text-primary"></i> {{ date('d M Y') }}
                </span>
            </div>
        </div>

        @php $umkm = Auth::user()->umkm; @endphp

        @if (!$umkm)
            <div class="card card-custom p-5 text-center">
                <img src="https://illustrations.popsy.co/blue/rocket-launch.svg" style="height: 200px;" class="mx-auto mb-4">
                <h3 class="fw-800">Mulai Perjalanan Bisnis Anda</h3>
                <p class="text-muted mx-auto mb-4" style="max-width: 500px;">Profil UMKM Anda belum lengkap. Lengkapi data sekarang untuk membuka akses fitur pendanaan dan manajemen produk unggulan.</p>
                <a href="{{ route('umkm.input') }}" class="btn btn-primary btn-modern shadow-lg">
                    Lengkapi Profil Usaha <i class="bi bi-arrow-right ms-2"></i>
                </a>
            </div>
        @else
            <div class="hero-section shadow-lg">
                <div class="row align-items-center">
                    <div class="col-lg-7">
                        <span class="badge bg-white bg-opacity-25 mb-3">ID Mitra: #UMKM-{{ $umkm->id }}</span>
                        <h1 class="display-5 fw-800 mb-3">Tingkatkan Kapasitas <br> Produksi {{ $umkm->nama_usaha }}</h1>
                        <p class="lead opacity-75 mb-4">Kelola permodalan paylater secara transparan dan kembangkan pasar produk unggulan Anda.</p>
                        <div class="d-flex gap-3">
                            <button onclick="document.getElementById('modalPinjam').classList.remove('d-none')" class="btn btn-light btn-modern text-primary shadow">
                                <i class="bi bi-plus-circle-fill me-2"></i>Ajukan Modal
                            </button>
                            <a href="{{ route('umkm.edit') }}" class="btn btn-outline-light btn-modern border-2">
                                <i class="bi bi-pencil-square me-2"></i>Pengaturan Toko
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-5 d-none d-lg-block text-center">
                        <img src="https://illustrations.popsy.co/blue/manager.svg" class="hero-img">
                    </div>
                </div>
            </div>

            <div class="row g-4 mb-5">
                <div class="col-md-4">
                    <div class="card card-custom stats-card p-4">
                        <small class="text-muted fw-bold text-uppercase">Limit Tersedia</small>
                        <h2 class="fw-800 mt-2">Rp {{ number_format($umkm->limit_pinjaman - $umkm->saldo_pinjaman, 0, ',', '.') }}</h2>
                        <div class="progress mt-3" style="height: 6px;">
                            <div class="progress-bar" role="progressbar" style="width: 70%"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card card-custom p-4 border-left-warning" style="border-left: 5px solid #ffc107;">
                        <small class="text-muted fw-bold text-uppercase">Tagihan Berjalan</small>
                        <h2 class="fw-800 mt-2 text-warning">Rp {{ number_format($umkm->saldo_pinjaman, 0, ',', '.') }}</h2>
                        <p class="small text-muted mb-0 mt-3"><i class="bi bi-info-circle me-1"></i> Dibayar via Midtrans</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card card-custom p-4 border-left-success" style="border-left: 5px solid #198754;">
                        <small class="text-muted fw-bold text-uppercase">Status Akun</small>
                        <div class="mt-2">
                            <span class="badge-status {{ $umkm->status == 'aktif' ? 'bg-success-subtle text-success' : 'bg-primary-subtle text-primary' }}">
                                <i class="bi bi-patch-check-fill me-1"></i> {{ strtoupper($umkm->status) }}
                            </span>
                        </div>
                        <p class="small text-muted mb-0 mt-3">Mitra Terverifikasi</p>
                    </div>
                </div>
            </div>

            <div class="row g-4 mb-5">
                <div class="col-lg-8">
                    <div class="table-container shadow-sm h-100">
                        <h5 class="fw-800 mb-4">Katalog Produk Unggulan</h5>
                        <div class="row g-3">
                            @forelse($umkm->portfolio_produk ?? [] as $produk)
                                <div class="col-md-4">
                                    <div class="card border-0 bg-light rounded-4 h-100">
                                        @if(isset($produk['foto']))
                                            <img src="{{ asset('storage/' . $produk['foto']) }}" class="card-img-top rounded-top-4" style="height: 120px; object-fit: cover;">
                                        @else
                                            <div class="bg-secondary-subtle rounded-top-4 d-flex align-items-center justify-content-center" style="height: 120px;">
                                                <i class="bi bi-image text-muted fs-2"></i>
                                            </div>
                                        @endif
                                        <div class="p-3">
                                            <h6 class="fw-bold mb-1 text-truncate">{{ $produk['nama'] }}</h6>
                                            <p class="small text-muted mb-0 line-clamp-2" style="font-size: 0.7rem;">{{ $produk['detail'] }}</p>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="col-12 text-center py-4">
                                    <p class="text-muted italic">Belum ada produk unggulan.</p>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card card-custom p-4 h-100">
                        <h5 class="fw-800 mb-4">Distribusi Limit</h5>
                        <div style="height: 250px;">
                            <canvas id="chartLimit"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <div class="table-container shadow-sm mb-5">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h5 class="fw-800 mb-0">Riwayat Pencairan Modal</h5>
                    <button class="btn btn-sm btn-light border rounded-pill px-3">View All</button>
                </div>
                <div class="table-responsive">
                    <table class="table align-middle">
                        <thead class="table-light">
                            <tr class="small text-muted">
                                <th class="border-0">NOMINAL</th>
                                <th class="border-0">TANGGAL</th>
                                <th class="border-0 text-center">STATUS</th>
                                <th class="border-0 text-end">AKSI</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($pinjamanModal as $pinjam)
                                <tr>
                                    <td><span class="fw-bold text-dark">Rp {{ number_format($pinjam->jumlah_pinjaman, 0, ',', '.') }}</span></td>
                                    <td class="text-muted small">
                                        <i class="bi bi-calendar-event me-1"></i>
                                        {{ $pinjam->tanggal_pinjam ? \Carbon\Carbon::parse($pinjam->tanggal_pinjam)->format('d M Y') : '-' }}
                                    </td>
                                    <td class="text-center">
                                        @if($pinjam->status_pelunasan == 'lunas')
                                            <span class="badge bg-success-subtle text-success rounded-pill px-3">Lunas</span>
                                        @else
                                            <span class="badge bg-warning-subtle text-warning rounded-pill px-3">Aktif</span>
                                        @endif
                                    </td>
                                    <td class="text-end">
                                        @if($pinjam->status_pelunasan != 'lunas')
                                            <button onclick="bayarTagihan('{{ $pinjam->id }}')" class="btn btn-primary btn-sm btn-modern">Bayar Tagihan</button>
                                        @else
                                            <a href="{{ route('umkm.cetak-bukti', $pinjam->id) }}" target="_blank" class="btn btn-outline-secondary btn-sm rounded-circle">
                                                <i class="bi bi-printer"></i>
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center py-5 text-muted">Belum ada riwayat transaksi.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        @endif
    </div>

    @if(isset($umkm) && $umkm)
    <div id="modalPinjam" class="d-none position-fixed inset-0 w-100 h-100 d-flex align-items-center justify-content-center px-3" style="background: rgba(0,0,0,0.5); z-index: 9999; top: 0; left: 0;">
        <div class="card card-custom glass-modal p-4 shadow-2xl w-100" style="max-width: 450px;">
            <div class="d-flex justify-content-between align-items-start mb-4">
                <div>
                    <h4 class="fw-800 text-dark mb-1">Ajukan Pencairan</h4>
                    <p class="text-muted small">Maksimal limit tersedia: <strong>Rp {{ number_format($umkm->limit_pinjaman - $umkm->saldo_pinjaman, 0, ',', '.') }}</strong></p>
                </div>
                <button onclick="document.getElementById('modalPinjam').classList.add('d-none')" class="btn-close"></button>
            </div>
            
            <form action="{{ route('umkm.ajukan-pinjaman') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label class="form-label small fw-bold">Nominal Pencairan</label>
                    <div class="input-group">
                        <span class="input-group-text bg-white border-end-0 rounded-start-4">Rp</span>
                        <input type="number" name="jumlah_modal" max="{{ $umkm->limit_pinjaman - $umkm->saldo_pinjaman }}" class="form-control border-start-0 rounded-end-4 py-3" placeholder="0" required>
                    </div>
                    <div class="mt-2 text-primary small">
                        <i class="bi bi-info-circle me-1"></i> Dana akan diproses dalam 1x24 jam.
                    </div>
                </div>
                <button type="submit" class="btn btn-primary btn-modern w-100 py-3 shadow-lg">Konfirmasi & Cairkan</button>
            </form>
        </div>
    </div>

    <script>
        // Data logic tetap sama sesuai instruksi (tidak mengubah variabel backend)
        const ctxLimit = document.getElementById('chartLimit').getContext('2d');
        new Chart(ctxLimit, {
            type: 'doughnut',
            data: {
                labels: ['Terpakai', 'Sisa'],
                datasets: [{
                    data: [{{ $umkm->saldo_pinjaman }}, {{ $umkm->limit_pinjaman - $umkm->saldo_pinjaman }}],
                    backgroundColor: ['#f87171', '#0061ff'],
                    borderWidth: 0,
                    hoverOffset: 10
                }]
            },
            options: {
                cutout: '80%',
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { position: 'bottom', labels: { usePointStyle: true, font: { size: 11, weight: 'bold' } } }
                }
            }
        });

        function bayarTagihan(id) {
            if (typeof window.snap === 'undefined') {
                alert("Sistem pembayaran sedang loading..."); return;
            }
            fetch('/umkm/bayar/' + id, {
                method: 'GET',
                headers: { 'X-Requested-With': 'XMLHttpRequest', 'Accept': 'application/json' }
            })
            .then(response => response.json())
            .then(data => {
                if (data.snap_token) {
                    window.snap.pay(data.snap_token, {
                        onSuccess: (result) => { window.location.reload(); },
                        onPending: (result) => { alert("Menunggu pembayaran..."); },
                        onError: (result) => { alert("Pembayaran gagal!"); }
                    });
                } else { alert(data.error || "Gagal mengambil data pembayaran."); }
            })
            .catch(() => alert("Terjadi kesalahan koneksi."));
        }
    </script>
    @endif

</x-app-layout>
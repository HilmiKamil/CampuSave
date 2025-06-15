@include('components.head-user')

<body class="bg-light">
    @include('components.navbar-user')

    <style>
        .savings-container {
            padding: 30px 0;
        }
        
        .savings-card {
            background: linear-gradient(135deg, #38a169 0%, #2f855a 100%);
            color: white;
            border-radius: 16px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.15);
            overflow: hidden;
            margin-bottom: 30px;
        }
        
        .savings-header {
            padding: 25px;
            text-align: center;
        }
        
        .savings-icon {
            font-size: 3rem;
            margin-bottom: 15px;
        }
        
        .savings-amount {
            font-size: 2.5rem;
            font-weight: 700;
            margin: 10px 0;
        }
        
        .savings-stats {
            background: rgba(255,255,255,0.15);
            padding: 20px;
            border-radius: 12px;
        }
        
        .stat-card {
            background: rgba(255,255,255,0.2);
            border-radius: 10px;
            padding: 15px;
            text-align: center;
            margin-bottom: 15px;
        }
        
        .action-card {
            background: white;
            border-radius: 12px;
            padding: 20px;
            text-align: center;
            box-shadow: 0 4px 10px rgba(0,0,0,0.05);
            transition: all 0.3s ease;
            height: 100%;
        }
        
        .action-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 15px rgba(0,0,0,0.1);
        }
        
        .history-item {
            padding: 15px;
            border-bottom: 1px solid #e2e8f0;
        }
        
        .history-item:last-child {
            border-bottom: none;
        }
    </style>

    <main class="container py-5 ">
        <div class="container savings-container py-5 ">
            <div class="row justify-content-center">
                <div class="col-md-10">
                    <!-- Savings Card -->
                    <div class="savings-card">
                        <div class="savings-header">
                            <div class="savings-icon">
                                <i class="fas fa-piggy-bank"></i>
                            </div>
                            <h2>Total Tabungan</h2>
                            <div class="savings-amount">Rp {{ number_format($totalSavings, 0, ',', '.') }}</div>
                        </div>
                        
                        <div class="savings-stats">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="stat-card">
                                        <p class="mb-1">Tabungan Bulan Ini</p>
                                        <h4 class="mb-0">Rp {{ number_format($monthlySavings, 0, ',', '.') }}</h4>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="stat-card">
                                        <p class="mb-1">Jumlah Transaksi</p>
                                        <h4 class="mb-0">{{ $transactionCount }}</h4>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="stat-card">
                                        <p class="mb-1">Rata-rata/Bulan</p>
                                        <h4 class="mb-0">Rp {{ number_format($averageMonthly, 0, ',', '.') }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Action Cards -->
                    <div class="row mt-4">
                        <div class="col-md-6 mb-3">
                            <div class="action-card">
                                <i class="fas fa-plus-circle fa-2x text-primary mb-3"></i>
                                <h4>Tambah Tabungan</h4>
                                <p class="text-muted small">Tambahkan dana ke tabungan Anda</p>
                                <button class="btn btn-primary mt-2" 
                                        data-bs-toggle="modal" 
                                        data-bs-target="#addSavingModal">
                                    <i class="fas fa-plus me-1"></i> Tambah
                                </button>
                            </div>
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <div class="action-card">
                                <i class="fas fa-history fa-2x text-primary mb-3"></i>
                                <h4>Riwayat Tabungan</h4>
                                <p class="text-muted small">Lihat semua riwayat tabungan</p>
                                <a href="{{ route('mahasiswa.saving.history') }}" class="btn btn-outline-primary mt-2">
                                    <i class="fas fa-list me-1"></i> Lihat
                                </a>
                            </div>
                        </div>
                        
                    </div>
                    
                    <!-- Recent History -->
                    <div class="card mt-4">
                        <div class="card-header">
                            <div class="d-flex justify-content-between align-items-center">
                                <h4 class="mb-0">Riwayat Tabungan Terbaru</h4>
                                <a href="{{ route('mahasiswa.saving.history') }}" class="btn btn-sm btn-outline-primary">
                                    Lihat Semua <i class="fas fa-arrow-right ms-1"></i>
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            @if($savingsHistory->count() > 0)
                                <div class="list-group">
                                    @foreach($savingsHistory as $saving)
                                    <div class="list-group-item history-item">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div>
                                                <h5 class="mb-1">+ Rp {{ number_format($saving->amount, 0, ',', '.') }}</h5>
                                                <small class="text-muted">
                                                    {{ \Carbon\Carbon::parse($saving->saved_at)->format('d M Y') }}
                                                </small>
                                                @if($saving->description)
                                                    <p class="mb-0 mt-1">{{ $saving->description }}</p>
                                                @endif
                                            </div>
                                            <span class="badge bg-success rounded-pill">
                                                <i class="fas fa-plus"></i>
                                            </span>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            @else
                                <div class="text-center py-4">
                                    <i class="fas fa-piggy-bank fa-3x text-muted mb-3"></i>
                                    <p class="text-muted">Belum ada riwayat tabungan</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Add Saving Modal -->
    <div class="modal fade" id="addSavingModal" tabindex="-1" aria-labelledby="addSavingModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="addSavingModalLabel">Tambah Tabungan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('mahasiswa.saving.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        @if($errors->any())
                            <div class="alert alert-danger alert-dismissible fade show">
                                <strong>Terjadi kesalahan:</strong>
                                <ul class="mb-0">
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif
                        
                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show">
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif
                        
                        <div class="mb-3">
                            <label for="amount" class="form-label">Jumlah Tabungan</label>
                            <div class="input-group">
                                <span class="input-group-text">Rp</span>
                                <input type="number" 
                                    class="form-control" 
                                    id="amount" 
                                    name="amount" 
                                    placeholder="Masukkan jumlah" 
                                    required
                                    min="1000"
                                    step="1000">
                            </div>
                            <div class="form-text">Minimal Rp 1.000</div>
                        </div>
                        
                        <div class="mb-3">
                            <label for="saved_at" class="form-label">Tanggal</label>
                            <input type="date" 
                                class="form-control" 
                                id="saved_at" 
                                name="saved_at" 
                                value="{{ date('Y-m-d') }}" 
                                required>
                        </div>
                        
                        <div class="mb-3">
                            <label for="description" class="form-label">Keterangan (Opsional)</label>
                            <textarea class="form-control" 
                                    id="description" 
                                    name="description" 
                                    rows="3" 
                                    placeholder="Contoh: Tabungan dari gaji bulanan"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan Tabungan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @include('components.footer-user')
    <script src="{{ asset('user/landing/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const today = new Date().toISOString().split('T')[0];
            document.getElementById('saved_at').value = today;
            
            const addSavingModal = document.getElementById('addSavingModal');
            if (addSavingModal) {
                addSavingModal.addEventListener('show.bs.modal', function () {
                    const form = this.querySelector('form');
                    form.reset();
                    document.getElementById('saved_at').value = today;
                    
                    const alerts = form.querySelectorAll('.alert');
                    alerts.forEach(alert => alert.remove());
                });
            }
            
            const amountInput = document.getElementById('amount');
            if (amountInput) {
                amountInput.addEventListener('input', function() {
                    this.value = this.value.replace(/[^0-9]/g, '');
                });
            }
        });
    </script>
</body>
</html>
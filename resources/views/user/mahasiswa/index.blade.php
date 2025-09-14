@include('components.head-user')

<body class="bg-light">
  @include('components.navbar-user')

  <style>
    .financial-card {
      background: linear-gradient(135deg, #38a169 0%, #2f855a 100%);
      border-radius: 16px;
      box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
      color: white;
      overflow: hidden;
      position: relative;
    }

    .financial-card::before {
      content: "";
      position: absolute;
      top: -50%;
      left: -50%;
      width: 200%;
      height: 200%;
      background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, rgba(255,255,255,0) 70%);
      transform: rotate(30deg);
    }

    .metric-card {
      background: rgba(255, 255, 255, 0.15);
      backdrop-filter: blur(10px);
      border-radius: 12px;
      transition: transform 0.3s ease;
    }

    .metric-card:hover {
      transform: translateY(-5px);
    }

    .action-card {
      border: none;
      border-radius: 16px;
      overflow: hidden;
      box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
      transition: all 0.3s ease;
    }

    .action-card:hover {
      transform: translateY(-8px);
      box-shadow: 0 8px 25px rgba(0, 0, 0, 0.12);
    }

    .expense-card {
      background: linear-gradient(135deg, #fff1f2 0%, #ffe4e6 100%);
    }

    .income-card {
      background: linear-gradient(135deg, #f0fdf4 0%, #dcfce7 100%);
    }

    .btn-toggle {
      background: rgba(255, 255, 255, 0.2);
      border: none;
      border-radius: 50%;
      width: 36px;
      height: 36px;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .btn-toggle:hover {
      background: rgba(255, 255, 255, 0.3);
    }

    .history-panel {
      background: white;
      border-radius: 16px;
      box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
      transition: all 0.3s ease;
    }

    .history-panel:hover {
      box-shadow: 0 8px 25px rgba(0, 0, 0, 0.12);
    }

    .modal-header {
      background: linear-gradient(135deg, #38a169 0%, #2f855a 100%);
      color: white;
    }

    .bg-green-custom {
      background: linear-gradient(135deg, #38a169 0%, #2f855a 100%);
      overflow: hidden;
    }

    .text-white-70 {
      color: rgba(255, 255, 255, 0.7);
    }

    .transaction-list {
      max-height: 350px;
      overflow-y: auto;
    }

    .transaction-list::-webkit-scrollbar {
      width: 6px;
    }

    .transaction-list::-webkit-scrollbar-track {
      background: #f1f1f1;
      border-radius: 10px;
    }

    .transaction-list::-webkit-scrollbar-thumb {
      background: #c1c1c1;
      border-radius: 10px;
    }

    .transaction-list::-webkit-scrollbar-thumb:hover {
      background: #a8a8a8;
    }
  </style>

  <main class="container py-5">
    <div class="text-center mb-5">
      <h1 class="fw-bold display-5 mb-3">Financial Dashboard</h1>
    </div>

    <!-- Card Utama Saldo -->
    <div class="p-4 bg-green-custom rounded text-white shadow-lg w-100" style="border-radius: 16px;">
      <div class="d-flex justify-content-between align-items-center mb-3">
        <div class="d-flex align-items-center gap-2">
          <h2 class="h5 fw-semibold mb-0">Total Saldo</h2>
          <button onclick="toggleVisibility()" class="btn btn-sm btn-link text-white p-0">
            <svg id="icon-visible" xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
            </svg>
            <svg id="icon-hidden" xmlns="http://www.w3.org/2000/svg" class="d-none" width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7a9.956 9.956 0 012.422-3.64M6.53 6.53a10.05 10.05 0 015.47-1.53c4.478 0 8.268 2.943 9.542 7a9.956 9.956 0 01-1.671 2.76M3 3l18 18" />
            </svg>
          </button>
        </div>
        <div class="position-relative">
          <input type="date" id="date-picker" class="form-control form-control-sm text-white border-0" style="background-color: rgba(0,0,0,0.2); max-width: 150px;" value="{{ date('Y-m-d') }}">
          <i class="fas fa-calendar-alt position-absolute end-0 top-50 translate-middle-y me-2 text-white text-opacity-75"></i>
        </div>
      </div>

      <h2 class="fw-bold display-4 mb-3 text-white" id="total-saldo">Rp {{ number_format($totalTabungan, 0, ',', '.') }}</h2>
      <p class="mb-4">Pengeluaran Hari Ini: <span class="fw-medium" id="pengeluaran-hari-ini">Rp {{ number_format($pengeluaranHariIni, 0, ',', '.') }}</span></p>
      
      <div id="detail-section">
        <div class="row g-2 mb-2">
          <div class="col-md-6">
            <div class="bg-success p-3 rounded">
              <p class="small mb-1">Total Pendapatan</p>
              <p class="h4 fw-semibold mb-0" id="pendapatan">Rp {{ number_format($totalPemasukan, 0, ',', '.') }}</p>
            </div>
          </div>
          <div class="col-md-6">
            <div class="bg-success p-3 rounded">
              <p class="small mb-1">Total Pengeluaran</p>
              <p class="h4 fw-semibold mb-0" id="pengeluaran">Rp {{ number_format($totalPengeluaran, 0, ',', '.') }}</p>
            </div>
          </div>
        </div>
        <div class="bg-success p-3 rounded mb-2">
          <p class="small mb-1">Rata-rata Pengeluaran Harian</p>
          <p class="h4 fw-semibold mb-0" id="rata-rata">Rp {{ number_format($rataRataPengeluaran ?? 0, 0, ',', '.') }}</p>
        </div>
      </div>

      <div class="text-center mt-2">
        <button onclick="toggleDetails()" id="detail-btn" class="btn btn-link btn-sm text-white p-0">
          Sembunyikan Detail ▲
        </button>
      </div>
    </div>

    <br><br>

    <!-- Grid Dua Kolom untuk Riwayat dan Financial Record -->
    <div class="row g-5">
      <!-- Kolom Riwayat Transaksi -->
      <div class="col-lg-6">
        <div class="history-panel p-4 h-100">
          <div class="d-flex align-items-center justify-content-between mb-4">
            <div class="d-flex align-items-center">
              <div class="bg-light rounded-circle p-2 me-3">
                <i class="fas fa-history fa-2x text-success"></i>
              </div>
              <div>
                <h3 class="h5 fw-bold mb-0">Riwayat Transaksi</h3>
                <p class="small text-muted mb-0">Aktivitas keuangan terbaru</p>
              </div>
            </div>
            <a href="{{ route('user.riwayat') }}" class="btn btn-sm btn-outline-success">
              Lihat Semua <i class="fas fa-arrow-right ms-1"></i>
            </a>
          </div>

          @if($recentTransactions->count() > 0)
            <div class="transaction-list">
              @foreach($recentTransactions as $transaksi)
                <div class="border-bottom pb-3 mb-3">
                  <div class="d-flex justify-content-between align-items-center">
                    <div>
                      <h6 class="mb-1 fw-semibold">{{ $transaksi->budgetCategory->name ?? $transaksi->category }}</h6>
                      <small class="text-muted">{{ \Carbon\Carbon::parse($transaksi->date)->isoFormat('D MMMM Y') }}</small>
                    </div>
                    <div class="{{ $transaksi->type === 'pengeluaran' ? 'text-danger' : 'text-success' }}">
                      <span class="fw-bold">{{ $transaksi->type === 'pengeluaran' ? '-' : '+' }}Rp {{ number_format($transaksi->amount, 0, ',', '.') }}</span>
                    </div>
                  </div>
                  @if($transaksi->description)
                    <p class="mt-2 mb-0 small text-muted">{{ $transaksi->description }}</p>
                  @endif
                </div>
              @endforeach
            </div>
          @else
            <div class="text-center py-4">
              <i class="fas fa-receipt fa-3x text-muted mb-3"></i>
              <p class="text-muted">Riwayat transaksi Anda akan muncul di sini</p>
            </div>
          @endif

          <div class="text-center mt-2">
            <a href="{{ route('user.riwayat') }}" class="btn btn-success">Lihat Riwayat Lengkap</a>
          </div>
        </div>
      </div>

      <!-- Kolom Financial Record -->
      <div class="col-lg-6">
        <div class="mb-4">
          <h3 class="h5 fw-bold">Financial Record</h3>
          <p class="text-muted">Catat pemasukan dan pengeluaran keuangan</p>
        </div>

        <div class="row g-4">
          <div class="col-md-6">
            <div class="action-card expense-card h-100">
              <div class="card-body p-4">
                <div class="text-center mb-4">
                  <div class="bg-danger bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center p-3">
                    <i class="fa-solid fa-money-bill-wave fa-2x text-danger"></i>
                  </div>
                </div>
                <h5 class="text-center text-danger fw-semibold mb-3">Pengeluaran</h5>
                <p class="text-center text-muted small mb-4">Catat pengeluaran harian Anda</p>
                <button class="btn btn-danger w-100 fw-bold" data-bs-toggle="modal" data-bs-target="#addExpenseModal">
                  <i class="fa-solid fa-plus me-1"></i>Tambah Pengeluaran
                </button>
              </div>
            </div>
          </div>

          <div class="col-md-6">
            <div class="action-card income-card h-100">
              <div class="card-body p-4">
                <div class="text-center mb-4">
                  <div class="bg-success bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center p-3">
                    <i class="fa-solid fa-sack-dollar fa-2x text-success"></i>
                  </div>
                </div>
                <h5 class="text-center text-success fw-semibold mb-3">Pemasukan</h5>
                <p class="text-center text-muted small mb-4">Catat sumber pemasukan Anda</p>
                <button class="btn btn-success w-100 fw-bold" data-bs-toggle="modal" data-bs-target="#addIncomeModal">
                  <i class="fa-solid fa-plus me-1"></i>Tambah Pemasukan
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>

  <!-- Modals -->
  <!-- Add Expense Modal -->
  <div class="modal fade" id="addExpenseModal" tabindex="-1" aria-labelledby="addExpenseModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <form method="POST" action="{{ route('user.transaksi.store') }}">
        @csrf
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Add Expense</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            @if (session('success'))
              <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
            @endif

            @if ($errors->any())
              <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Terjadi kesalahan:</strong>
                <ul class="mb-0">
                  @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                  @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
            @endif

            <input type="hidden" name="type" value="pengeluaran">

            <div class="mb-3">
              <label for="expense-amount" class="form-label">Amount</label>
              <input type="number" name="amount" class="form-control" id="expense-amount" placeholder="Enter amount" required>
            </div>

            <div class="mb-3">
              <label for="expense-category" class="form-label">Kategori</label>
              <select name="budget_category_id" class="form-select" id="expense-category" required>
                <option value="">Pilih Kategori</option>
                @foreach($categories as $category)
                  <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
              </select>
            </div>

            <div class="mb-3">
              <label for="expense-description" class="form-label">Description</label>
              <textarea name="description" class="form-control" id="expense-description" rows="3" placeholder="Enter description" required></textarea>
            </div>

            <div class="mb-3">
              <label for="expense-date" class="form-label">Date</label>
              <input type="date" name="date" class="form-control" id="expense-date" value="{{ date('Y-m-d') }}" required>
            </div>
          </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-danger">Save Expense</button>
          </div>
        </div>
      </form>
    </div>
  </div>

<!-- Add Income Modal -->
<div class="modal fade" id="addIncomeModal" tabindex="-1" aria-labelledby="addIncomeModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form method="POST" action="{{ route('user.transaksi.store') }}">
      @csrf
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Add Income</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
          @endif

          @if ($errors->any())
            <div class="alert alert-danger">
              <strong>Terjadi kesalahan:</strong>
              <ul>
                @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
              </ul>
            </div>
          @endif
          <input type="hidden" name="type" value="pemasukan">

          <div class="mb-3">
            <label for="income-amount" class="form-label">Amount</label>
            <input type="number" name="amount" class="form-control" id="income-amount" placeholder="Enter amount" required>
          </div>

          <div class="mb-3">
            <label for="income-description" class="form-label">Description</label>
            <textarea name="description" class="form-control" id="income-description" rows="3" placeholder="Enter description" required></textarea>
          </div>

          <div class="mb-3">
            <label for="income-date" class="form-label">Date</label>
            <input type="date" name="date" class="form-control" id="income-date" value="{{ date('Y-m-d') }}" required>
          </div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-success">Save Income</button>
        </div>
      </div>
    </form>
  </div>
</div>

  @include('components.footer-user')

  <script src="{{ asset('user/landing/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

  <script>
    const fields = ["total-saldo", "pengeluaran-hari-ini", "pendapatan", "pengeluaran", "rata-rata"];
    const originalTexts = {};
    let isHidden = false;
    let isDetailShown = true;

    fields.forEach(id => {
      const el = document.getElementById(id);
      if (el) originalTexts[id] = el.textContent;
    });

    function toggleVisibility() {
      isHidden = !isHidden;
      fields.forEach(id => {
        const el = document.getElementById(id);
        if (el) el.textContent = isHidden ? "Rp *****" : originalTexts[id];
      });
      document.getElementById("icon-visible").classList.toggle("d-none", isHidden);
      document.getElementById("icon-hidden").classList.toggle("d-none", !isHidden);
    }

    function toggleDetails() {
      const detailSection = document.getElementById("detail-section");
      const detailBtn = document.getElementById("detail-btn");
      isDetailShown = !isDetailShown;
      detailSection.style.display = isDetailShown ? "block" : "none";
      detailBtn.innerHTML = isDetailShown 
        ? 'Sembunyikan Detail ▲'
        : 'Tampilkan Detail ▼';
    }
  </script>
</body>
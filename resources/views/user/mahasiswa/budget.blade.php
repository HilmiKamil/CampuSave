@include('components.head-user')

<body class="bg-light">
  @include('components.navbar-user')

  <style>
    /* ... (kode CSS tetap sama) ... */
  </style>

  <main class="container py-5">
    
    <div class="container my-5">
      <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
          <h2 class="fw-bold mb-1">Budget Tracker</h2>
          <p class="text-muted mb-0">Kelola budget bulanan Anda dengan mudah</p>
        </div>
      </div>

      <!-- Month Selector -->
      <div class="month-selector">
        <div class="d-flex justify-content-between align-items-center">
          <div>
            <h4 class="fw-bold mb-0">{{ $currentDate->format('F Y') }}</h4>
            <span class="text-muted small">Periode anggaran</span>
          </div>
        </div>
      </div>

      @if($currentBudget)
      <!-- Status Budget -->
      <div class="card summary-card">
        <div class="card-header bg-green-custom">
          <h5 class="mb-0">Status Budget</h5>
        </div>
        <div class="card-body">
          <div class="d-flex justify-content-between align-items-center mb-3">
            <div>
              <h3 class="fw-bold">{{ number_format($expensePercentage, 0) }}% terpakai</h3>
              <p class="mb-0">Sisa Rp {{ number_format(($currentBudget->expense_limit - $pengeluaranBulanIni), 0, ',', '.') }}</p>
            </div>
            <div class="text-end">
              @if($expensePercentage >= 90)
                <span class="status-badge danger-badge">Budget hampir habis!</span>
              @elseif($expensePercentage >= 70)
                <span class="status-badge warning-badge">Budget perlu perhatian</span>
              @else
                <span class="status-badge success-badge">Budget masih aman</span>
              @endif
            </div>
          </div>
          
          <div class="progress progress-bar-custom">
            <div class="progress-bar @if($expensePercentage >= 90) bg-danger @elseif($expensePercentage >= 70) bg-warning @else bg-blue-custom @endif" 
                 role="progressbar" style="width: {{ min($expensePercentage, 100) }}%"></div>
          </div>
          
          <div class="mt-3 text-end text-muted small">
            Data terakhir diperbarui: {{ now()->format('H:i') }}
          </div>
        </div>
      </div>

      <!-- Overview Budget -->
      <div class="row mt-4">
        <div class="col-md-4 mb-3">
          <div class="card summary-card">
            <div class="card-body text-center">
              <p class="mb-1">Sisa Budget</p>
              <h3 class="fw-bold text-success">Rp {{ number_format(($currentBudget->expense_limit - $pengeluaranBulanIni), 0, ',', '.') }}</h3>
            </div>
          </div>
        </div>
        <div class="col-md-4 mb-3">
          <div class="card summary-card">
            <div class="card-body text-center">
              <p class="mb-1">Total Budget</p>
              <h3 class="fw-bold">Rp {{ number_format($currentBudget->expense_limit, 0, ',', '.') }}</h3>
            </div>
          </div>
        </div>
        <div class="col-md-4 mb-3">
          <div class="card summary-card">
            <div class="card-body text-center">
              <p class="mb-1">Total Pengeluaran</p>
              <h3 class="fw-bold text-danger">Rp {{ number_format($pengeluaranBulanIni, 0, ',', '.') }}</h3>
            </div>
          </div>
        </div>
      </div>

      <!-- Budget per Kategori -->
      <div class="card summary-card mt-4">
        <div class="card-header d-flex justify-content-between align-items-center">
          <h5 class="mb-0">Budget per Kategori</h5>
          <div>
            <button class="btn btn-sm btn-outline-primary me-2" data-bs-toggle="modal" data-bs-target="#editBudgetModal">
              <i class="fas fa-edit me-1"></i> Edit Budget Utama
            </button>
            <button class="btn btn-sm btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#manageCategoriesModal">
              <i class="fas fa-cog me-1"></i> Kelola Kategori
            </button>
          </div>
        </div>
        <div class="card-body">
          @if(count($categories) > 0)
            @foreach($categories as $category)
            <div class="category-card">
              <div class="d-flex justify-content-between align-items-center mb-2">
                <h6 class="fw-bold mb-0">{{ $category['name'] }}</h6>
                <span class="badge bg-primary">
                  Rp {{ number_format($category['spent'], 0, ',', '.') }} / 
                  Rp {{ number_format($category['limit'], 0, ',', '.') }}
                </span>
              </div>
              <div class="d-flex justify-content-between align-items-center mb-2">
                <div class="small">{{ number_format($category['percentage'], 0) }}% terpakai</div>
                <div class="small">Sisa Rp {{ number_format($category['remaining'], 0, ',', '.') }}</div>
              </div>
              <div class="progress category-progress">
                <div class="progress-bar 
                  @if($category['percentage'] >= 90) bg-danger 
                  @elseif($category['percentage'] >= 70) bg-warning 
                  @else bg-success @endif" 
                  role="progressbar" style="width: {{ min($category['percentage'], 100) }}%"></div>
              </div>
            </div>
            @endforeach
          @else
            <div class="alert alert-info">
              <p class="mb-0">Belum ada kategori anggaran. Tambahkan kategori untuk memulai melacak pengeluaran.</p>
            </div>
          @endif
          
          <div class="text-center mt-4">
            <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#addCategoryModal">
              <i class="fas fa-plus me-1"></i> Tambah Kategori Baru
            </button>
          </div>
        </div>
      </div>
      
      <!-- Rekomendasi Budget -->
      <div class="card summary-card mt-4">
        <div class="card-header">
          <h5 class="mb-0">Rekomendasi Pengelolaan Budget</h5>
        </div>
        <div class="card-body">
          @if($expensePercentage > 80)
            <div class="alert alert-warning">
              <p class="mb-0"><i class="fas fa-exclamation-triangle me-2"></i> Pengeluaran Anda sudah mencapai {{ number_format($expensePercentage, 0) }}% dari anggaran. Disarankan untuk mengurangi pengeluaran non-esensial.</p>
            </div>
          @else
            <div class="alert alert-success">
              <p class="mb-0"><i class="fas fa-check-circle me-2"></i> Pengelolaan budget Anda baik. Anda masih memiliki ruang Rp {{ number_format(($currentBudget->expense_limit - $pengeluaranBulanIni), 0, ',', '.' )}} untuk pengeluaran.</p>
            </div>
          @endif
          
          <div class="mt-3">
            <h6>Tips Pengelolaan Budget:</h6>
            <ul>
              <li>Prioritaskan pengeluaran untuk kebutuhan pokok</li>
              <li>Review budget mingguan untuk memantau pengeluaran</li>
              <li>Gunakan fitur kategori untuk melacak pengeluaran spesifik</li>
            </ul>
          </div>
        </div>
      </div>
      
      @else
      <!-- Jika belum ada budget -->
      <div class="alert alert-info">
        <div class="d-flex align-items-center">
          <div class="flex-shrink-0">
            <i class="fas fa-info-circle fa-2x"></i>
          </div>
          <div class="flex-grow-1 ms-3">
            <h5>Belum ada anggaran untuk bulan ini</h5>
            <p class="mb-0">Buat anggaran bulan ini untuk mulai melacak keuangan Anda dan mencapai tujuan finansial.</p>
            <div class="mt-3">
              <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addBudgetModal">
                <i class="fas fa-plus me-1"></i> Buat Anggaran Sekarang
              </button>
            </div>
          </div>
        </div>
      </div>
      @endif
    </div>
  </main>

 <!-- Modal Tambah Budget -->
<div class="modal fade" id="addBudgetModal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-green-custom">
        <h5 class="modal-title">Buat Anggaran Baru</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <form action="{{ route('user.budget.store') }}" method="POST">
        @csrf
        <div class="modal-body">
          <div class="mb-3">
            <label class="form-label">Bulan</label>
            <select class="form-select" name="month" required>
              <option value="">Pilih Bulan</option>
              @foreach(range(1, 12) as $month)
              <option value="{{ $month }}" {{ $month == date('n') ? 'selected' : '' }}>
                {{ \DateTime::createFromFormat('!m', $month)->format('F') }}
              </option>
              @endforeach
            </select>
          </div>
          <div class="mb-3">
            <label class="form-label">Tahun</label>
            <input type="number" class="form-control" name="year" value="{{ date('Y') }}" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Batas Pengeluaran (Rp)</label>
            <input type="number" class="form-control" name="expense_limit" required placeholder="Masukkan jumlah">
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
      </form>
    </div>
  </div>
</div>

@if($currentBudget)
  <!-- Modal Edit Budget -->
  <div class="modal fade" id="editBudgetModal" tabindex="-1">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header bg-green-custom">
          <h5 class="modal-title">Edit Anggaran Utama</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <form action="{{ route('user.budget.update', $currentBudget->id) }}" method="POST">
          @csrf
          @method('PUT')
          <div class="modal-body">
            <div class="mb-3">
              <label class="form-label">Bulan</label>
              <input type="text" class="form-control" 
                    value="{{ \DateTime::createFromFormat('!m', $currentBudget->month)->format('F') }}" disabled>
            </div>
            <div class="mb-3">
              <label class="form-label">Tahun</label>
              <input type="text" class="form-control" value="{{ $currentBudget->year }}" disabled>
            </div>
            <div class="mb-3">
              <label class="form-label">Batas Pengeluaran (Rp)</label>
              <input type="number" class="form-control" name="expense_limit" 
                    value="{{ $currentBudget->expense_limit ?? '' }}" required placeholder="Masukkan jumlah">
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- Modal Kelola Kategori -->
  <div class="modal fade" id="manageCategoriesModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header bg-green-custom">
          <h5 class="modal-title">Kelola Kategori Budget</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <form id="categoryForm">
            <div id="categoriesContainer">
              @foreach($categories as $index => $category)
              <div class="category-form-row">
                <div class="row">
                  <div class="col-md-5 mb-2">
                    <input type="hidden" name="categories[{{ $index }}][id]" value="{{ $category['id'] }}">
                    <input type="text" class="form-control" name="categories[{{ $index }}][name]" 
                          value="{{ $category['name'] }}" placeholder="Nama Kategori" required>
                  </div>
                  <div class="col-md-5 mb-2">
                    <input type="number" class="form-control" name="categories[{{ $index }}][limit]" 
                          value="{{ $category['limit'] }}" placeholder="Batas Anggaran" required>
                  </div>
                  <div class="col-md-2 mb-2 d-flex align-items-center">
                    <button type="button" class="btn btn-danger btn-sm w-100 delete-category"
                            data-id="{{ $category['id'] }}">
                        <i class="fas fa-trash"></i> Hapus
                    </button>
                  </div>
                </div>
              </div>
              @endforeach
            </div>
            
            <div class="text-center mt-3">
              <button type="button" id="addCategoryBtn" class="btn btn-outline-primary">
                <i class="fas fa-plus me-1"></i> Tambah Kategori
              </button>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
          <button type="button" id="saveCategoriesBtn" class="btn btn-primary">Simpan Perubahan</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal Tambah Kategori -->
  <div class="modal fade" id="addCategoryModal" tabindex="-1">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header bg-green-custom">
          <h5 class="modal-title">Tambah Kategori Baru</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <form action="{{ route('user.budget.categories.store', $currentBudget->id) }}" method="POST">
          @csrf
          <div class="modal-body">
            <div class="mb-3">
              <label class="form-label">Nama Kategori</label>
              <input type="text" class="form-control" name="name" placeholder="Contoh: Makanan, Transportasi" required>
            </div>
            <div class="mb-3">
              <label class="form-label">Batas Anggaran (Rp)</label>
              <input type="number" class="form-control" name="limit" placeholder="Masukkan jumlah" required>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-primary">Simpan</button>
          </div>
        </form>
      </div>
    </div>
  </div>
@endif

  @include('components.footer-user')

  <script src="{{ asset('user/landing/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  
  @if($currentBudget)
  <script>
    // Script untuk menambahkan kategori baru di modal kelola kategori
    document.getElementById('addCategoryBtn').addEventListener('click', function() {
      const container = document.getElementById('categoriesContainer');
      const index = container.children.length;
      
      const newRow = document.createElement('div');
      newRow.className = 'category-form-row';
      newRow.innerHTML = `
        <div class="row">
          <div class="col-md-5 mb-2">
            <input type="hidden" name="categories[${index}][id]" value="">
            <input type="text" class="form-control" name="categories[${index}][name]" 
                   placeholder="Nama Kategori" required>
          </div>
          <div class="col-md-5 mb-2">
            <input type="number" class="form-control" name="categories[${index}][limit]" 
                   placeholder="Batas Anggaran" required>
          </div>
          <div class="col-md-2 mb-2 d-flex align-items-center">
            <button type="button" class="btn btn-danger btn-sm w-100 remove-category">
              <i class="fas fa-trash"></i> Hapus
            </button>
          </div>
        </div>
      `;
      
      container.appendChild(newRow);
    });

    // Handle delete category
    document.addEventListener('click', async function(e) {
      if (e.target.classList.contains('delete-category')) {
        const categoryId = e.target.dataset.id;
        
        if (confirm('Apakah Anda yakin ingin menghapus kategori ini?')) {
          try {
            const response = await fetch(`/user/budget/categories/${categoryId}?budget_id={{ $currentBudget->id }}`, {
              method: 'DELETE',
              headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json'
              }
            });

            const data = await response.json();
            
            if (data.success) {
              // Hapus elemen dari DOM
              e.target.closest('.category-form-row').remove();
              alert('Kategori berhasil dihapus!');
            } else {
              alert('Gagal menghapus kategori: ' + data.message);
            }
          } catch (error) {
            console.error('Error:', error);
            alert('Terjadi kesalahan saat menghapus kategori');
          }
        }
      }
    });

    // Hapus kategori dari form
    document.addEventListener('click', function(e) {
      if (e.target.classList.contains('remove-category')) {
        const row = e.target.closest('.category-form-row');
        if (row) {
          row.remove();
        }
      }
    });

    // Simpan perubahan kategori dengan AJAX
    document.getElementById('saveCategoriesBtn').addEventListener('click', function() {
      const categories = [];
      
      // Kumpulkan data dari semua baris kategori
      document.querySelectorAll('.category-form-row').forEach((row, index) => {
        const name = row.querySelector('input[name$="[name]"]').value;
        const limit = row.querySelector('input[name$="[limit]"]').value;
        const id = row.querySelector('input[name$="[id]"]').value || null;
        
        categories.push({
          id: id,
          name: name,
          limit: limit
        });
      });

      // Kirim data ke server
      fetch("{{ route('user.budget.categories.bulkUpdate', $currentBudget->id) }}", {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'X-CSRF-TOKEN': '{{ csrf_token() }}',
          'Accept': 'application/json'
        },
        body: JSON.stringify({ categories: categories })
      })
      .then(response => response.json())
      .then(data => {
        if (data.success) {
          alert('Kategori berhasil diperbarui!');
          location.reload();
        } else {
          alert('Terjadi kesalahan: ' + (data.message || 'Tidak dapat menyimpan kategori'));
        }
      })
      .catch(error => {
        alert('Terjadi kesalahan saat menyimpan data');
        console.error('Error:', error);
      });
    });
  </script>
  @endif
</body>
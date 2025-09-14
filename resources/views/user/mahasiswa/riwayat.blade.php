@include('components.head-user')

<body class="bg-light">
  @include('components.navbar-user')

  <style>
    .table-responsive {
      margin-top: 20px;
    }

    .table th, .table td {
      vertical-align: middle;
    }

    .bg-green-custom {
      background-color: #38a169;
    }

    .text-white-70 {
      color: rgba(255, 255, 255, 0.7);
    }
  </style>

  <main class="container py-5">
    <div class="container my-5">
      <h2 class="fw-bold">Riwayat Keuangan</h2>
      <p class="small">Berikut adalah riwayat keuangan Anda, termasuk pemasukan dan pengeluaran.</p>

      <div class="table-responsive">
        <table class="table table-striped table-bordered">
          <thead class="bg-green-custom text-white">
            <tr>
              <th>#</th>
              <th>Tanggal</th>
              <th>Kategori</th>
              <th>Deskripsi</th>
              <th>Jumlah</th>
              <th>Tipe</th>
            </tr>
          </thead>
          <tbody>
            <!-- Tambahkan kolom user jika diperlukan -->
            @foreach ($transaksis as $transaksi)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $transaksi->date->format('d-m-Y') }}</td>
                <td>{{ $transaksi->budgetCategory->name ?? $transaksi->category }}</td>
                <td>{{ $transaksi->description }}</td>
                <td>Rp {{ number_format($transaksi->amount, 2, ',', '.') }}</td>
                <td>{{ ucfirst($transaksi->type) }}</td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>

      <!-- Pagination -->
            <div class="mt-3">
                <nav aria-label="Page navigation">
                    <ul class="pagination justify-content-center">
                        {{ $transaksis->links('vendor.pagination.bootstrap-4') }} <!-- Use Bootstrap 4 pagination -->
                    </ul>
                </nav>
            </div>
    </div>
  </main>

  @include('components.footer-user')

  <script src="{{ asset('user/landing/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
</body>
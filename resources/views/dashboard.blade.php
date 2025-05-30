<!-- filepath: c:\laragon\www\simgudang-bootstrap\resources\views\dashboard.blade.php -->
<x-layout>

  <x-slot:title>{{ $title }}</x-slot:title>
  <x-slot:style>
    <style>
        .sticky-th {
            position: sticky;
            top: 0;
            background: #fff; /* atau warna latar belakang tabel */
            z-index: 2;
        }
    </style>
  </x-slot:style>

  
  <div class="row">
    <div class="col-sm">
        <div class="info-box">
            <span class="info-box-icon bg-success"><i class="fas fa-arrow-down"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Barang Masuk Hari Ini</span>
                <span class="info-box-number">{{ $barangMasukHariIni }}</span>
            </div>
        </div>
    </div>
    <div class="col-sm">
        <div class="info-box">
            <span class="info-box-icon bg-danger"><i class="fas fa-arrow-up"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Barang Keluar Hari Ini</span>
                <span class="info-box-number">{{ $barangKeluarHariIni }}</span>
            </div>
        </div>
    </div>
    <div class="col-sm">
        <div class="info-box">
            <span class="info-box-icon bg-warning"><i class="fas fa-exclamation-triangle"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Stok Menipis</span>
                <span class="info-box-number">{{ $stokMenipis->count() }}</span>
            </div>
        </div>
    </div>
  </div>

  <!-- Tabel Stok Barang Scrollable -->
  <div class="row mt-4">
    <div class="col-12">
      <div class="card card-outline card-primary">
        <div class="card-header">
          <h3 class="card-title">Stok Barang</h3>
        </div>
        <div class="card-body">
          <div style="max-height: 300px; overflow-y: auto;">
            <table class="table table-bordered table-striped mb-0">
              <thead>
                <tr>
                  <th style="width: 3%" class="sticky-th">No</th>
                  <th class="sticky-th">Kode</th>
                  <th class="sticky-th">Nama Barang</th>
                  <th class="sticky-th">Stok</th>
                </tr>
              </thead>
              <tbody>
                @foreach($barangs as $index => $barang)
                  <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $barang->kode }}</td>
                    <td>{{ $barang->nama }}</td>
                    <td>{{ $barang->stok->jumlah ?? 0 }}</td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="row mt-4">
      <div class="col-md-6">
          <div class="card card-outline card-success">
              <div class="card-header">
                  <h3 class="card-title">Transaksi Masuk Hari Ini</h3>
                  <div class="card-tools">
                      <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                  </div>
              </div>
              <div class="card-body">
                  <table class="table table-bordered">
                      <thead>
                          <tr>
                              <th>Kode</th>
                              <th>Nama Barang</th>
                              <th>Jumlah</th>
                              <th>Harga</th>
                          </tr>
                      </thead>
                      <tbody>
                          @forelse($transaksiMasukHariIni as $transaksi)
                          <tr>
                              <td>{{ $transaksi->barang_kode }}</td>
                              <td>{{ $transaksi->barang->nama ?? '-' }}</td>
                              <td>{{ $transaksi->qty }}</td>
                              <td>{{ number_format($transaksi->harga, 2, ',', '.') }}</td>
                          </tr>
                          @empty
                          <tr>
                              <td colspan="4" class="text-center">Belum ada barang masuk hari ini</td>
                          </tr>
                          @endforelse
                      </tbody>
                  </table>
              </div>
          </div>
      </div>

      <div class="col-md-6">
          <div class="card card-outline card-danger">
              <div class="card-header">
                  <h3 class="card-title">Transaksi Keluar Hari Ini</h3>
                  <div class="card-tools">
                      <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                  </div>
              </div>
              <div class="card-body">
                  <table class="table table-bordered">
                      <thead>
                          <tr>
                              <th>Kode</th>
                              <th>Nama Barang</th>
                              <th>Jumlah</th>
                              <th>Harga</th>
                              <th>Tempat</th>
                          </tr>
                      </thead>
                      <tbody>
                        @forelse($transaksiKeluarHariIni as $transaksi)
                          <tr>
                              <td>{{ $transaksi->barang_kode }}</td>
                              <td>{{ $transaksi->barang->nama ?? '-' }}</td>
                              <td>{{ $transaksi->qty }}</td>
                              <td>{{ number_format($transaksi->harga, 2, ',', '.') }}</td>
                              <td>{{ $transaksi->tempat->nama ?? '-' }}</td>
                          </tr>
                          @empty
                          <tr>
                              <td colspan="5" class="text-center">Belum ada barang keluar hari ini</td>
                          </tr>
                          @endforelse
                      </tbody>
                  </table>
              </div>
          </div>
      </div>
  </div>

  <footer class="text-center mt-4" style="max-width: 50%; margin: 0 auto; word-wrap: break-word; white-space: normal;">


  <footer class="text-center mt-4" style="max-width: 50%; margin: 0 auto; word-wrap: break-word; white-space: normal;">
      <p class="text-muted">{{ $quoteText }}</p>
      <p class="text-muted" style="font-style: italic;">{{ $quoteSource }}</p>
  </footer>

</x-layout>
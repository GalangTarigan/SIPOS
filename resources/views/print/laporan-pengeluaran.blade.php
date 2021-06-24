<!DOCTYPE html>
<html>
  
  <head>
    <meta charset="utf-8">
    
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"> <!-- untuk format pdf yang ok -->
    <!--<link type="text/css" href="{{ asset('fonts/font-awesome/css/all.css') }}" rel="stylesheet" />-->
    <link type="text/css" href="{{asset('css/print-laporan-keuangan.css')}}" rel="stylesheet">
    <!-- Load site level scripts -->
    <script type="text/javascript" src="{{ asset('js/jquery-3.4.1.js') }}"></script>
    <script type="text/javascript" src="{{asset('plugins/moment/moment-with-locales.js')}}"></script>
    
    <script type="text/javascript" src="{{asset('demo/demo-print-laporan-pengeluaran.js')}}"></script>
    <link type="text/css" href="{{ asset('fonts/font-awesome/css/all.css') }}" rel="stylesheet" />
</head>

<body>
  <script>
    var bulan = {!! json_encode($judulBulan)!!};  
    var tahun = {!! json_encode($dataTahun)!!};  
    var dataTransaksi = {!! json_encode($data)!!};  
    var totalBiayaKeluar = {!! json_encode($totalBiayaKeluar)!!}
  </script>
    
    <div class="container">
      <h3>Toko Indah Elektronik</h3>
      <h5>Jl. S. Parman No.87 Sigambal</h5>
      <h5>Rantau Prapat - 21461</h5>
      <h5>No Hp. 081312121515</h5>
      <hr>
      <div class="heading" style="text-align: center">
        <h4>Laporan Pengeluaran</h4>
      </div>
      <hr>

      <table  class="table table-borderless">
        <tbody class="tb1">
          <tr></tr>
        </tbody>
      </table>

      <table class="table page-break">
        
      @if(count($data) == 0)
      <thead><th colspan="8">Daftar Transaksi Pengeluaran Tidak Ditemukan</th></thead>      
      </tbody>
      @else    
      <thead><th colspan="8">Daftar Transaksi Pengeluaran</th></thead>
        <thead class="thead-light">
            <tr>
              <th class="width5 text-center" scope="col">#</th>
              <th class="width5 text-center" scope="col">Tanggal Transaksi</th>
              <th class="width20 text-center" scope="col">Keterangan Transaksi</th>
              <th class="width9 text-center" scope="col">Total Biaya</th>
            </tr>
          </thead>
        <tbody class="tb2">
        </tbody>
        @endif
    </table>
    <hr>
    <table  class="table table-borderless">
        <tbody class="tb3">
          <tr></tr>
        </tbody>
      </table>
    <hr>  
    <br><br><br>
  </div>
</body>
<script>
window.print();
</script>
</html>
<!DOCTYPE html>
<html>
  
  <head>
    <meta charset="utf-8">
    
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"> <!-- untuk format pdf yang ok -->
    <!--<link type="text/css" href="{{ asset('fonts/font-awesome/css/all.css') }}" rel="stylesheet" />-->
    <link type="text/css" href="{{asset('css/print.css')}}" rel="stylesheet">
    <!-- Load site level scripts -->
    <script type="text/javascript" src="{{ asset('js/jquery-3.4.1.js') }}"></script>
    <script type="text/javascript" src="{{asset('plugins/moment/moment-with-locales.js')}}"></script>
    
    <script type="text/javascript" src="{{asset('demo/demo-print-transaksi-penjualan.js')}}"></script>
    <link type="text/css" href="{{ asset('fonts/font-awesome/css/all.css') }}" rel="stylesheet" />
</head>

<body>
  <script>
    var dataPelanggan = {!! json_encode($dataPelanggan)!!};  
    var dataBarangBeli = {!! json_encode($dataBarangBeli)!!};  
  </script>
    
    <div class="container">
      <h3>Toko Indah Elektronik</h3>
      <h5>Jl. S. Parman No.87 Sigambal</h5>
      <h5>Rantau Prapat - 21461</h5>
      <h5>No Hp. 081312121515</h5>
      <hr>
      <div class="heading" style="text-align: center">
        <h4>Faktur Penjualan</h4>
      </div>
      <hr>

      <table  class="table table-borderless">
        <tbody class="tb1">
          <tr></tr>
        </tbody>
      </table>
    

    <table class="table page-break">      
      <thead><th colspan="5">Daftar Pembelian Barang</th></thead>
        <thead class="thead-light">
            <tr>
              <th class="width5 text-center" scope="col">#</th>
              <th class="width15 text-center" scope="col">Kategori Barang</th>
              <th class="width15 text-center" scope="col">Merk Barang</th>
              <th class="width15 text-center" scope="col">Tipe Barang</th>
              <th class="width15 text-center" scope="col">Harga Barang</th>
              <th class="width10 text-center" scope="col">Jumlah</th>
              <th class="width15 text-center" scope="col">Total Harga</th>
            </tr>
          </thead>
        <tbody class="tb2">
        </tbody>
    </table>
    <hr>
    <div style="text-align: right">
      <h4>Total Pembelian : <u>Rp.{{$dataPelanggan->total_pembelian}}</u></h4>
    </div>
    <hr>
    
    <p style="font-size:14px;"><br><br>*Barang yang telah dibeli tidak dapat dikembalikan <br> *Untuk melihat daftar garansi barang, kunjungi situs www.blabla.com</p>  
  </div>
</body>
<script>
window.print();
</script>
</html>
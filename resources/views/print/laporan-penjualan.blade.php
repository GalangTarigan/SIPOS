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
    
    <script type="text/javascript" src="{{asset('demo/demo-print-laporan-penjualan.js')}}"></script>
    <link type="text/css" href="{{ asset('fonts/font-awesome/css/all.css') }}" rel="stylesheet" />
</head>

<body>
  <script>
    var mulai = {!! json_encode($tanggal1)!!};  
    var selesai = {!! json_encode($tanggal2)!!};  
    var data = {!! json_encode($result_array)!!};  
    var totalBeli = {!! json_encode($totalBeli)!!};  
    var totalLaba = {!! json_encode($totalLaba)!!};  
    var totalModal = {!! json_encode($totalModal)!!};  
  </script>
    
    <div class="container">
      <h3>Toko Indah Elektronik</h3>
      <h5>Jl. S. Parman No.87 Sigambal</h5>
      <h5>Rantau Prapat - 21461</h5>
      <h5>No Hp. 081312121515</h5>
      <hr>
      <div class="heading" style="text-align: center">
        <h4>Laporan Penjualan</h4>
      </div>
      <hr>

      <table  class="table table-borderless">
        <tbody class="tb1">
          <tr></tr>
        </tbody>
      </table>
    

      <table class="table page-break">
        
      @if(count($result_array) == 0)
      <thead><th colspan="8">Daftar Transaksi Penjualan Tidak Ditemukan</th></thead>      
      </tbody>
      @else    
      <thead><th colspan="8">Daftar Transaksi Penjualan</th></thead>
        <thead class="thead-light">
            <tr>
              <th class="width5 text-center" scope="col">#</th>
              <th class="width10 text-center" scope="col">Kasir</th>
              <th class="width10 text-center" scope="col">No.Invoice</th>
              <th class="width15 text-center" scope="col">Tanggal Beli</th>
              <th class="width15 text-center" scope="col">Nama Pelanggan</th>
              <th class="width10 text-center" scope="col">Total Beli</th>
              <th class="width10 text-center" scope="col">Modal</th>
              <th class="width10 text-center" scope="col">Laba kotor</th>
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
    <table class="table table-borderless ">
      <thead>
        <tr>                
            <th class="width10" >Rekapitulasi Laporan Pendapatan </th>
            <th class="width2" style="text-align:center">:</th>
            <th class="width20">Tanggal {{$tanggal1}} s/d Tanggal  {{$tanggal2}}</th>                                
        </tr>
    </thead> 

      <tbody class="tb4">
          <tr>
                <tr>
                  <th class="width7">Total Seluruh Pendapatan</th>
                  <th class="width2" style="text-align:center">:</th>
                  <th class="width30" id="waktu_mulai_t">Rp.{{$totalBeli}}</th>
                </tr>
                <tr>
                  <th class="width7" >Total Modal Barang</th>
                  <th class="width2" style="text-align:center">:</th>
                  <th class="width30" id="waktu_selesai_t">Rp.{{$totalModal}}</th>
                  </tr>
                  <tr>
                    <th class="width7">Total Laba Kotor</th>
                    <th class="width2" style="text-align:center">:</th>
                    <th class="width30" >Rp.{{$totalLaba}}</th>
                    
                  </tr>
          </tr>
      </tbody>
    </table>
  </div>
</body>
<script>
 window.print();
</script>
</html>
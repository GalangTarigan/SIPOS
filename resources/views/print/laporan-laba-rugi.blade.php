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
    
    <script type="text/javascript" src="{{asset('demo/demo-print-laporan-laba-rugi.js')}}"></script>
    <link type="text/css" href="{{ asset('fonts/font-awesome/css/all.css') }}" rel="stylesheet" />
</head>

<body>
  <script>
    var dataTransaksi = {!! json_encode($data)!!};  
    var namaBulanLengkap = {!! json_encode($judulBulan)!!};  
    var tahun = {!! json_encode($dataTahun)!!};    
    var total_modal = {!! json_encode($modalPerBulan)!!};    
    var total_pemasukan = {!! json_encode($pemasukanPerBulan)!!};    
  </script>
    
    <div class="container">
      <h3>Toko Indah Elektronik</h3>
      <h5>Jl. S. Parman No.87 Sigambal</h5>
      <h5>Rantau Prapat - 21461</h5>
      <h5>No Hp. 081312121515</h5>
      <hr>
      <div class="heading" style="text-align: center">
        <h4>Laporan Laba Rugi</h4>
      </div>
      <hr>

      <table  class="table table-borderless">      
        <tbody class="tb1">
          <tr></tr>
        </tbody>
      </table>

      <table class="table page-break">
        
      @if(count($data) == 0)
      <thead><th colspan="8">Data Laporan Laba Rugi Tidak Ditemukan</th></thead>      
      </tbody>
      @else       
        <thead class="thead-light">
            <tr>
              <th class="width5 text-center" scope="col">#</th>
              <th class="width12 text-center" scope="col">Tgl Transaksi</th>
              <th class="width16 text-center" scope="col">Keterangan Transaksi</th>
              <th class="width8 text-center" scope="col">Pengeluaran</th>
              <th class="width8 text-center" scope="col">Pendapatan</th>
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
    <table class="table table-borderless">  
        <thead>
          <tr>                
              <th class="width10" >Rekapitulasi Laporan Laba Rugi </th>
              <th class="width2" style="text-align:center">:</th>
              <th class="width20">Bulan {{$judulBulan}} Tahun  {{$dataTahun}}</th>                                
          </tr>
      </thead> 
  
        <tbody class="tb4">
            <tr>
                <tr>
                  <th class="width7">Total Seluruh Pendapatan</th>
                  <th class="width2" style="text-align:center">:</th>
                  <th class="width30" id="waktu_mulai_t">Rp.{{$pemasukanPerBulan}}</th>
                </tr>
                <tr>
                  <th class="width7" >Total Pengeluaran & Modal</th>
                  <th class="width2" style="text-align:center">:</th>
                  <th class="width30" id="waktu_selesai_t">Rp.{{$modalPerBulan}}</th>
                </tr>
                <tr>
                    <th class="width7">Laba Bersih</th>
                    <th class="width2" style="text-align:center">:</th>
                    <th class="width30" >Rp.{{$labaPerBulan}}</th>                      
                </tr>
            </tr>
        </tbody>
    </table>
  </div>
  <br><br><br><br><br><br><br>
</body>
<script>
 window.print();
</script>
</html>
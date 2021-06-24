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
    
    <script type="text/javascript" src="{{asset('demo/demo-print-struk-service.js')}}"></script>
    <link type="text/css" href="{{ asset('fonts/font-awesome/css/all.css') }}" rel="stylesheet" />
</head>

<body>
  <script>
    var dataTable = {!! json_encode($dataTable)!!}; 
  </script>
    
    <div class="container">
      <h3>Toko Indah Elektronik</h3>
      <h5>Jl. S. Parman No.87 Sigambal</h5>
      <h5>Rantau Prapat - 21461</h5>
      <h5>No Hp. 081312121515</h5>
      <hr>
      <div class="heading" style="text-align: center">
        <h4>Invoice Service</h4>
      </div>
      <hr>

      <table  class="table table-borderless">      
        <tbody class="tb1">
          {{-- <tr></tr> --}}
        </tbody>
      </table>

      <table class="table page-break">
{{-- <table  class=" table table-striped table-bordered">           --}}
      @if(count($dataTable) == 0)
      <thead><th colspan="8">Data Barang Service</th></thead>      
      </tbody>
      @else       
      <thead><th colspan="5">Daftar Barang Service</th></thead>
        <thead class="thead-light">
            <tr>
              <th class="width5 text-center" scope="col">#</th>
              <th class="width7 text-center" scope="col">Jenis Barang</th>
              <th class="width20 text-center" scope="col">Permasalahan</th>
              <th class="width10 text-center" scope="col">Kelengkapan</th>
              <th class="width7 text-center" scope="col">Status</th>
            </tr>
          </thead>
        <tbody class="tb2">
        </tbody>
        @endif
    </table>
    <hr>
   
  </div>
  <br><br><br><br><br><br><br>
</body>
<script>
 window.print();
</script>
</html>
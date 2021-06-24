var token = $('meta[name="csrf-token"]').attr('content')
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
})
$('#daterangepicker_bulan span').html(bulan + ' - ' + tahun);
$( document ).ready(function() {
    $.ajax({
        url: "/admin/keuangan/list-transaksi-pengeluaran",
        type: 'post',
        data: {
            "_token" : token,   
            month_start: dataBulan,
            year_start: tahun,
            q_status: "fin"           
        },
        dataType: 'json',
        success: function (data) {
            console.log(data)
            $('#spinner').fadeOut(290)
            table = $('#table').DataTable({
                "language": {
                    "lengthMenu": "_MENU_"
                },
                serverSide: false,
                data: data,
                columns: [
                    { data: null},
                    { data: 'tanggal_transaksi_laba_rugi' },
                    { data: 'keterangan' },
                    { data: 'biaya_modal' },
                ], 
                // "lengthChange": false,
                "columnDefs": [                 
                {
                    render: function (data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    },
                    "targets" : 0,
                    "width": "1%",
                },
                {
                    "render": function(data, type, row){
                        if(data !== null) {
                            var date = moment(data, 'YYYY-MM-DD', 'id').format("dddd, D MMMM YYYY"); 
                            return date
                        }else{
                            return '~'
                        }
                    },
                    "targets": 1
                }
            ]                
            })
            $('#table').fadeIn(300)
        }
    });
});


function cetakLaporanKeluar() {

    var table1 = $('#table').DataTable();
          
    if ( ! table1.data().any() ) {
        Swal.fire({
            title: 'Oops...',
            text: 'Tidak ditemukan data, silahkan pilih Bulan lainnya!!',
            width: '400px',
            type: 'info',
            backdrop: `rgba(0,0,123,0.4)`
          })
    }
    else{            
        window.open('/print/laporan-pengeluaran/?month_start=' + dataBulan + "&year_start=" + tahun, 'print', 'scrollbars=yes,status=no,menubar=no,width=800,height=400')
    }
  }


  //untuk menampilkan seluruh barang
// $(function(){
    
//     $('#daterangepicker_bulan').daterangepicker({
//         ranges: {
//             'Bulan Ini': [moment().subtract(0, 'month'), moment()],
//             '1 bulan lalu': [moment().subtract(1, 'month'), moment()],
//             '2 bulan lalu': [moment().subtract(2, 'month'), moment()],
//             '3 bulan lalu': [moment().subtract(3, 'month'), moment()],
//             '4 bulan lalu': [moment().subtract(4, 'month'), moment()],
//             '5 bulan lalu': [moment().subtract(5, 'month'), moment()],
//              },
//             "showCustomRangeLabel": false,
          
//     });

//     $('#daterangepicker_bulan').on('apply.daterangepicker', function (ev, picker) {
//         $('#daterangepicker_bulan span').html(picker.startDate.locale('id').format('MMMM - YYYY') );
//         $('input[name="month_start"]').val(picker.startDate.format('MM'))
//         $('input[name="year_start"]').val(picker.startDate.format('YYYY'))
//         $('#msg-info').html('')
//         $('#spinner').fadeIn()
//         $("#table").css("cursor", "pointer")
//         let bulan = picker.startDate.format('MMMM - YYYY')
//         $.ajax({
//             url: "/admin/keuangan/list-transaksi-pengeluaran",
//             type: 'post',
//             data: {
//                 "_token" : token,   
//                 month_start: $('input[name="month_start"]').val(),
//                 year_start: $('input[name="year_start"]').val(),
//                 q_status: "fin"           
//             },
//             dataType: 'json',
//             success: function (data) {
//                 console.log(data)
//                 $('#spinner').fadeOut(290)
//                 table.destroy(); // untuk menghancurkan inisialisasi dari table sebelumnya

//                 document.getElementById("judul").innerHTML = "Daftar Seluruh Transaksi Keluar Bulan " + bulan;
//                 table = $('#table').DataTable({
//                     "language": {
//                         "lengthMenu": "_MENU_"
//                     },
//                     serverSide: false,
//                     data: data,
//                     columns: [
//                         { data: null},
//                         { data: 'tanggal_transaksi_laba_rugi' },
//                         { data: 'keterangan' },
//                         { data: 'biaya_modal' },
//                     ], 
//                     // "lengthChange": false,
//                     "columnDefs": [                 
//                     {
//                         render: function (data, type, row, meta) {
//                             return meta.row + meta.settings._iDisplayStart + 1;
//                         },
//                         "targets" : 0,
//                         "width": "1%",
//                     },
//                     {
//                         "render": function(data, type, row){
//                             if(data !== null) {
//                                 var date = moment(data, 'YYYY-MM-DD', 'id').format("dddd, D MMMM YYYY"); 
//                                 return date
//                             }else{
//                                 return '~'
//                             }
//                         },
//                         "targets": 1
//                     }
//                 ]                
//                 })
//                 $('#table').fadeIn(300)
//             }
//         });
//     })

// }) 


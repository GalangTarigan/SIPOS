var token = $('meta[name="csrf-token"]').attr('content')
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
})

$('#daterangepicker_bulan span').html(bulan + ' - ' + tahun);
$( document ).ready(function() {
    $.ajax({
        url: "/admin/keuangan/list-laba-rugi",
        type: 'post',
        data: {
            "_token" : token,   
            date_start: dataBulan,
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
                    { data: 'tanggal_transaksi_laba_rugi' },
                    { data: 'keterangan' },
                    { data: 'biaya_modal',"width": "5%", },
                    { data: 'pendapatan', "width": "5%",},
                    // { data: 'laba_transaksi' },
                ], 
                // "lengthChange": false,
                "columnDefs": [                 
                {
                    "render": function(data, type, row){
                        if(data !== null) {
                            var date = moment(data, 'YYYY-MM-DD', 'id').format("dddd, D MMMM YYYY"); 
                            return date
                        }else{
                            return '~'
                        }
                    },
                    "targets": 0,
                    "width": "18%",
                }
            ]                
            })
            $('#table').fadeIn(300)
        }
    });
});

function cetakLaporan() {
    // // alert(dataBulan)
    // alert(tahun)

    var table1 = $('#table').DataTable();
          
    if ( ! table1.data().any() ) {
        Swal.fire({
            title: 'Oops...',
            text: 'Tidak ditemukan data, silahkan pilih Bulan lainnya!!',
            width: '400px',
            type: 'info',
            backdrop: `rgba(0,0,123,0.4)`
          })
    }else{            
        window.open('/print/laporan-laba-rugi/?date_start=' + dataBulan + "&year_start=" + tahun, 'print', 'scrollbars=yes,status=no,menubar=no,width=800,height=400')
    }
  }






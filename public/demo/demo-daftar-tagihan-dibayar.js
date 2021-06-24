var token = $('meta[name="csrf-token"]').attr('content')
$( document ).ready(function() {
console.log(id)
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    })
    $('#spinner').fadeIn()
    $("#table").css("cursor", "pointer")
    var table
    $.ajax({
		url: "/admin/manajemen-sales/data-tagihan-lunas?id=" + id,
		type: 'post',
		data: {
            "_token" : token,              
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
                    { data: 'nama_sales' },
                    { data: 'tanggal_faktur' },
                    { data: 'jatuh_tempo' },
                    { data: 'jumlah_tagihan' },
                    { data: 'status_pembayaran' },
                    { data: 'tanggal_dibayar' },
                    { data: 'metode_pembayaran' },
                    { data: null }
                ], 
                // "lengthChange": false,
                "columnDefs": [ 
                {   "render": function(data, type, row){
                        if(data !== null) {
                            var date = moment(data, 'YYYY-MM-DD', 'id').format("DD MMMM YYYY"); 
                            return date
                        }else{
                            return '~'
                        }
                    },
                    "targets": [-3, 2, 3]
                },
                { 
                    "render": function(data, type, row){
                        let button = "<span type='button' id='editBarang' class='btn btn-primary-alt'>Detail</span>"; 
                        return button;                        
                    },
                  "targets": -1
                },
                {
                    render: function (data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    },
                    "targets" : 0
                }
            ]                
            })
            $('#table').fadeIn(300)
        }
        
    });

    //di klik untuk edit barang
    $('#table tbody').on( 'click', '#editBarang', function (e) {
        e.stopImmediatePropagation(); // stop the row selection when clicking on an icon
        
        let id = table.row( $(this).parents('tbody tr') ).data().id_tagihan;
        // alert("ini data id"+ id)
        // console.log(uuid)        
        window.location.href = '/admin/manajemen-sales/detail-tagihan-lunas?data=' + id;
    });
});

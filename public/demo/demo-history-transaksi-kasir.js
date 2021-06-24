
//untuk menampilkan seluruh barang
$(function(){
    var token = $('meta[name="csrf-token"]').attr('content')
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    })
    $('#spinner').fadeIn()
    $("#table").css("cursor", "pointer")
    var table
    $.ajax({
		url: "/kasir/transaksi-penjualan-kasir/list-transaksi",
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
                    { data: 'no_invoice' },
                    { data: 'tanggal_pembelian' },
                    { data: 'nama_pelanggan' },
                    { data: 'alamat_pembeli' },
                    { data: 'no_telepon_pembeli'},
                    { data: 'total_pembelian' },
                    { data: null }
                ], 
                // "lengthChange": false,
                "columnDefs": [ 
                { 
                    "render": function(data, type, row){
                        let button = "<span type='button' id='detail' class='btn btn-success-alt'>&nbsp<i class='fa fa-info'></i>&nbsp</span> <span type='button' id='printTransaksi' class='btn btn-primary-alt'><i class='fa fa-print'></i></span>"; 
                        return button;                        
                    },
                    "width": "9%",
                  "targets": -1
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
                    "width": "18%",
                    "targets": 2
                },
                {
                    render: function (data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    },
                    "width": "1%",
                    "targets" : 0
                },
                {
                    "width": "11%",
                    "targets": [1, -3]
                },
                {
                    "width": "12%",
                    "targets": -2
                }
            ]                
            })
            $('#table').fadeIn(300)
        }
        
    });

    // di klik untutk print barang
    $('#table tbody').on( 'click', '#printTransaksi', function (e) {
        e.stopImmediatePropagation(); // stop the row selection when clicking on an icon
        let no_invoice = table.row( $(this).parents('tbody tr') ).data().no_invoice;
        console.log(no_invoice)
        // console.log(uuid)        
        // alert('ini print')
         window.open('/print/transaksi-penjualan/?no_invoice=' + no_invoice, 'print', 'scrollbars=yes,status=no,menubar=no,width=800,height=400')
    });

    
    //untuk liat detail transaksi tapi di klik row nya
    $('#table').on('click', 'tbody tr', function () {
        $('#detailTransaksiModal').modal({backdrop: 'static', keyboard: false})  
        $('#detailTransaksiModal').modal('show');
        // alert('ini body')
        let id_transaksi = table.row(this).data().id_transaksi;
         console.log(id_transaksi)
        $.ajax({
            url: "/kasir/transaksi-penjualan-kasir/detail-transaksi/" + id_transaksi,
            type: 'post',
            data: {
                "_token": token,
            },
            dataType: 'json',
            success: function (data) {
                data.forEach(row => {
                    console.log(row.no_invoice)
                    var date = moment(row.tanggal_pembelian, 'YYYY-MM-DD', 'id').format("dddd, D MMMM YYYY"); 
                    
                $("input[name='no_invoice']").val(row.no_invoice);
                $("input[name='kasir']").val(row.nama_lengkap);
                $("input[name='tanggal_beli']").val(date);
                $("input[name='nama_pelanggan']").val(row.nama_pelanggan);
                $("input[name='alamat_pelanggan']").val(row.alamat_pembeli);
                $("input[name='no_telepon']").val(row.no_telepon_pembeli);
                $("input[name='total_pembelian']").val(row.total_pembelian);
                $('#myTable tbody').append(
                    `<tr><td>${row.kategori_barang}</td><td>${row.merk_barang_beli}</td><td>${row.tipe_barang_beli}</td><td>${row.harga_barang_beli}</td><td>${row.jumlah_barang_beli}</td><td>${row.total_harga}</td></tr>`
                );
            })
            
            }
    
        });         
    } );

      

    $('#closeModal').on('click', function (e) {
        $("#myTable tbody tr").remove(); //agar data pada datatable ga ketumpuk
    })

    $('#closeModal2').on('click', function (e) {
        
        $("#myTable tbody tr").remove(); //agar data pada datatable ga ketumpuk
        $('#detailTransaksiModal').modal('hide');
    })
    
    

}) 




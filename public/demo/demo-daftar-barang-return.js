
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
		url: "/admin/barang_return/list-barang-return",
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
                    { data: 'nama_merk', "width": "4%"},
                    { data: 'tipe_barang' },
                    { data: 'nama_kategori' },
                    { data: 'no_seri' },
                    { data: 'kerusakan' },
                    { data: 'jumlah_return', 
                            "width": "4%"
                    },
                    { data: 'nama_sales' },                                        
                    { data: 'status' },
                    { data: 'tanggal_pengambilan' },
                    { data: null,
                        "render": function(data, type, row){
                            // let button = "<span type='button' id='detail' class='btn btn-success-alt'>&nbsp<i class='fa fa-info'></i>&nbsp</span> <span class='btn btn-primary-alt' id='edit'><i class='fa fa-cog'></i></span> <span class='btn btn-danger-alt delete' id='delete'><i class='fa fa-trash'></i></span>"; 
                            let button = "<span type='button' id='editBarang' class='btn btn-primary-alt'><i class='fa fa-cog'></i></span>"; 
                            let button2 = "<span class='btn btn-danger-alt delete' id='delete'><i class='fa fa-trash '></i></span>"; 
    
                            if ( row.status === "Sudah Selesai"){
                                return button2;                        
                            }else{
                                return button;                        
                            }
    
                        },
                        "width": "5%",
                    
                    }
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
                    "targets": [-2]
                },
                {
                    render: function (data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    },
                    "targets" : 0,
                    "width": "1%",
                }
            ]                
            })
            $('#table').fadeIn(300)
        }
        
    });

    //di klik untuk lihat detail barang
    // $('#table').on('click', 'tbody tr', function () {
    //     let id_barang = table.row(this).data().id_barang;
    //     console.log(id_barang)
    //     window.location.href = '/admin/manajemen-barang/detailBarang/' + id_barang;
    // });

    // di klik untuk edit barang
    $('#table tbody').on( 'click', '#editBarang', function (e) {
        e.stopImmediatePropagation(); // stop the row selection when clicking on an icon
        let id_barang_return = table.row( $(this).parents('tbody tr') ).data().id_barang_return;
        console.log(id_barang_return)
        // console.log(uuid)        
        window.location.href = '/admin/barang-return/formEditBarangReturn?barangReturn=' + id_barang_return;
    });

    //untuk delete barang
    $('#table tbody').on( 'click', '#delete', function (e) {
        e.stopImmediatePropagation(); // stop the row selection when clicking on an icon
        var data = table.row( $(this).parents('tbody tr') ).data();
        console.log( table.row( $(this).parents('tbody tr') ).data().id_barang_return);
        let id_barang_return = table.row( $(this).parents('tbody tr') ).data().id_barang_return;
        json = table.row( $(this).parents('tbody tr') ).data();
        Swal.fire({
            title: 'Apakah anda yakin?',
            text: "Anda tidak akan bisa merubah jika setuju!!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!',
            width: '400px'
        }).then((result) => {
            if (result.value) {
                $.post({
                    url: '/admin/barang_return/delete_barang_return?barang_return=' + id_barang_return,
                    // type: 'POST',
                    method: 'POST',
                    data: {
                        _token: token,
                        user: id_barang_return,
                    },
                    success: function (data) {
                        // console.log(data)
                        if (data['status']) {
                            Swal.fire({
                                    type: 'success',
                                    title: 'Berhasil',
                                    text: data['data'],
                                    width: '400px',
                                    showConfirmButton: false,
                                }
                            )                            
                            window.location.href ='/admin/barang-return/delete-barang-return-success';
                        } else {
                            Swal.fire(
                                {
                                    type: 'error',
                                    title: 'Gagal!!!',
                                    text: data['data'],
                                    width: '400px'
                                }
                            )
                        }
                    },
                    error: function (data) {
                        Swal.fire(
                            'Error!',
                            data['responseJSON']['errors'],
                            'error'
                        )
                    }
                })
            }
          })
    } );

    


}) 




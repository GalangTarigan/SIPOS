
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
		url: "/admin/barang-service/list-barang-service",
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
                    { data: 'nama_pelanggan' },
                    { data: 'jenis_barang' },
                    { data: 'permasalahan' },
                    { data: 'status_barang' },
                    { data: 'total_biaya_service',
                        "render": function(data, type, row){
                            if (row.total_biaya_service == null){
                                return "-"
                            }else{
                                return row.total_biaya_service
                            }
                        }
                    
                
                    },
                    { data: 'status_pembayaran',
                    "render": function(data, type, row){
                        if (row.status_pembayaran == null){
                            return "-"
                        }else{
                            return row.status_pembayaran
                        }
                    }                        
                    },

                    { data: 'lokasi_barang' },                                        
                    { data: null,
                        "render": function(data, type, row){
                            // untuk menghapus dibatalkan karena kan ini buat catatan jadi tidak dihapus
                            // <span class='btn btn-danger-alt delete' id='delete'><i class='fa fa-trash '></i></span>

                            let button = "<span type='button' id='print' class='btn btn-inverse-alt'>&nbsp<i class='fa fa-print'></i>&nbsp</span> <span class='btn btn-primary-alt' id='edit'><i class='fa fa-cog '></i></span>";
                            
                            let button2 = "<span type='button' id='detail' class='btn btn-success-alt'>&nbsp<i class='fa fa-info'></i>&nbsp</span>"; 

                            let button3 = "<span type='button' id='detail' class='btn btn-success-alt'>&nbsp<i class='fa fa-info'></i>&nbsp</span> "; 
    
                            if ( row.status_barang === "Selesai"){
                                return button2;                        
                            }else if(row.status_barang === "Tidak dapat diperbaiki"){
                                return button3;                        
                            }
                            else{
                                return button;                        
                            }
    
                        },
                    
                    }                    
                ],   
                "columnDefs": [ 
                {
                    render: function (data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    },
                    "targets" : 0,
                    "width": "1%",
                },         
            ],
            })
            $('#table').fadeIn(300)
        }
        
    });

    //di klik untuk lihat detail barang
    $('#table').on('click', 'tbody tr', function () {
        let id = table.row(this).data().id_service;
        window.location.href = '/admin/barang-service/detail-barang-service?data=' + id;
    });

    // di klik untuk edit barang
    $('#table tbody').on( 'click', '#edit', function (e) {
        e.stopImmediatePropagation(); // stop the row selection when clicking on an icon
        let id = table.row( $(this).parents('tbody tr') ).data().id_service;
        // alert('ini id' + id)
        window.location.href = '/admin/barang-service/edit-barang-service?data=' + id;
    });

    // di klik untuk edit barang
    $('#table tbody').on( 'click', '#print', function (e) {
        e.stopImmediatePropagation(); // stop the row selection when clicking on an icon
        let id = table.row( $(this).parents('tbody tr') ).data().id_service;
        // alert('ini id' + id)
        window.open('/print/struk-service/?id=' + id, 'print', 'scrollbars=yes,status=no,menubar=no,width=800,height=400')
    });

    // di klik untuk edit barang
    $('#table tbody').on( 'click', '#detail', function (e) {
        e.stopImmediatePropagation(); // stop the row selection when clicking on an icon
        let id = table.row( $(this).parents('tbody tr') ).data().id_service;
        // alert('ini id ' + id)
        window.location.href = '/admin/barang-service/detail-barang-service?data=' + id;
    });

    //untuk delete barang
    $('#table tbody').on( 'click', '#delete', function (e) {
        e.stopImmediatePropagation(); // stop the row selection when clicking on an icon
        
        
        let id = table.row( $(this).parents('tbody tr') ).data().id_service;
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
                    url: '/admin/barang-service/delete-barang-service?data=' + id,
                    // type: 'POST',
                    method: 'POST',
                    data: {
                        _token: token,
                        
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
                            window.location.href ='/admin/barang-service/daftar-barang-service-success';
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




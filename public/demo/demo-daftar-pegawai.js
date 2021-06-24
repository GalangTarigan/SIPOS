
//untuk menampilkan seluruh pegawai
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
		url: "/admin/pegawai/list-pegawai",
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
                    { data: 'nama_lengkap' },
                    { data: 'email' },
                    { data: 'no_telepon' },
                    { data: 'alamat' },
                    { data: 'posisi'},
                    { data: null ,
                        "render": function(data, type, row){
                            // let button = "<span type='button' id='detail' class='btn btn-success-alt'>&nbsp<i class='fa fa-info'></i>&nbsp</span> <span class='btn btn-primary-alt' id='edit'><i class='fa fa-cog'></i></span> <span class='btn btn-danger-alt delete' id='delete'><i class='fa fa-trash'></i></span>"; 
                            let button = "<span class='btn btn-primary-alt' id='detail_edit'>&nbsp;&nbsp;Edit&nbsp;&nbsp;</span> <span class='btn btn-danger-alt delete' id='delete'>Hapus</span>"; 
                            let button2 = "<span type='button' id='detail_admin' class='btn btn-success-alt'>Detail</span>"; 
    
                            if ( row.posisi === "Admin"){
                                return button2;                        
                            }else{
                                return button;                        
                            }
    
                        },
                    
                    }
                ], 
                // "lengthChange": false,
                "columnDefs": [ {
                    "targets": -1,
                    "data": null,
                    "defaultContent": "",
                    "width" : 160,
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

    //agar bisa di klik untuk lihat detail admin
    $('#table').on( 'click', '#detail_admin', function () {
        
        let data = table.row( $(this).parents('tbody tr') ).data().id;
        console.log('id detail', name)
        // console.log(uuid)        
        window.location.href = '/admin/pegawai/detail-pegawai-status-admin?name=' + data;
    });

    //agar bisa di klik untuk lihat edit pegawai
    $('#table').on( 'click', '#detail_edit', function () {
        
        let id = table.row( $(this).parents('tbody tr') ).data().id;
        console.log('id edit', id)
        // console.log(uuid)        
        window.location.href = '/admin/pegawai/list-pegawai/detail-edit-pegawai?id=' + id;
    });

    //untuk delete pegawai
    $('#table').on( 'click', '#delete', function () {
        var data = table.row( $(this).parents('tbody tr') ).data();
        console.log( table.row( $(this).parents('tbody tr') ).data().id);
        let id = table.row( $(this).parents('tbody tr') ).data().id;
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
                    url: '/admin/pegawai/delete/' + id,
                    // type: 'POST',
                    method: 'POST',
                    data: {
                        _token: token,
                        user: id,
                    },
                    success: function (data) {
                        console.log(data)
                        if (data['status']) {
                            Swal.fire({
                                    type: 'success',
                                    title: 'Berhasil',
                                    text: data['data'],
                                    width: '400px',
                                    showConfirmButton: false,
                                }
                            )                            
                            window.location.href ='/admin/pegawai/delete-pegawai-success';
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




   	//Focus input if its has value
       $('.input100').each(function () {
        if ($(this).val().trim() != "") {
            $(this).addClass('has-val');
        }
        else {
            $(this).removeClass('has-val');
        }
    })

    /*Form==================================================================
    [ Focus input ]*/
    $('.input100').each(function () {
        $(this).on('blur', function () {
            if ($(this).val().trim() != "") {
                $(this).addClass('has-val');
            }
            else {
                $(this).removeClass('has-val');
            }
        })

    })
    //Remove error message after server validation if input has changed
    $('.input100').each(function () {
        //If focused on particular input, then remove its parent next element
        $(this).on('focus', function () {
            if($(this).parent().next()){
                $(this).parent().next().remove()
            }
        })
    })

    //Focus input if its has value
$('.input100').each(function () {
	if ($(this).val().trim() != "") {
		$(this).addClass('has-val');
	}else {
        $(this).removeClass('has-val');
	}
})


//unutk kategori 
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
		url: "/admin/manajemen-barang/daftar-kategori",
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
                    { data: 'nama_kategori' },                
                    { data: null }
                ], 
                // "lengthChange": false,
                "columnDefs": [ {
                    "targets": -1,
                    "data": null,
                    "defaultContent": "",
                    "width" : 160,
                },
                {
                    "render": function(data, type, row){
                        let button = "<span type='button' id='edit' class='btn btn-success-alt'>&nbsp&nbsp Edit &nbsp&nbsp</span> <span class='btn btn-danger-alt delete' id='delete'>Hapus</span>"; 
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

    $('#table').on( 'click', '#edit', function () {
        var id_kategori = table.row( $(this).parents('tbody tr') ).data().id_kategori;
        var nama = table.row( $(this).parents('tbody tr') ).data().nama_kategori;
        $('input[name="id_kategori"]').val(id_kategori)
        // alert(nama);
        // json = table.row( $(this).parents('tbody tr') ).data();
        $("#editModal").modal();
        document.getElementById('nama_kategori').value = nama;
        $('#submit-update').on('click', function () {
            
            $('#validate-form').parsley().validate();
            $('.modal-body form').submit();
            
     })
    });

    // delete barang
    $('#table').on( 'click', '#delete', function () {
        let id_kategori = table.row( $(this).parents('tbody tr') ).data().id_kategori;
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
                    url: '/admin/manajemen-barang/delete/' + id_kategori,
                    // type: 'POST',
                    method: 'POST',
                    data: {
                        _token: token,
                        user: id_kategori,
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
                            window.location.href ='/admin/manajemen-barang/delete-kategori-barang-success';
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

// untuk merk
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
		url: "/admin/manajemen-barang/data-merk-barang",
		type: 'post',
		data: {
            "_token" : token,              
		},
		dataType: 'json',
		success: function (data) {
            console.log(data)
            $('#spinner').fadeOut(290)
            table = $('#table-merk').DataTable({
                "language": {
                    "lengthMenu": "_MENU_"
                },
                serverSide: false,
                data: data,
                columns: [
                    { data: null},
                    { data: 'nama_merk' },                
                    { data: null }
                ], 
                // "lengthChange": false,
                "columnDefs": [ {
                    "targets": -1,
                    "data": null,
                    "defaultContent": "",
                    "width" : 160,
                },
                {
                    "render": function(data, type, row){
                        let button = "<span type='button' id='edit_merk' class='btn btn-success-alt'>&nbsp&nbsp Edit &nbsp&nbsp</span> <span class='btn btn-danger-alt delete' id='delete_merk'>Hapus</span>"; 
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
            $('#table-merk').fadeIn(300)
		}
    });

    $('#table-merk').on( 'click', '#edit_merk', function () {
        var id_merk = table.row( $(this).parents('tbody tr') ).data().id_merk;
        var nama_merk = table.row( $(this).parents('tbody tr') ).data().nama_merk;
        $('input[name="id_merk"]').val(id_merk)
        // alert(nama);
        // json = table.row( $(this).parents('tbody tr') ).data();
        $("#editModalMerk").modal();
        document.getElementById('nama_merk').value = nama_merk;
        $('#submit-update-merk').on('click', function () {
            
            $('#validate-form').parsley().validate();
            $('.modal-body form').submit();
            
     })
    });


     // delete barang
     $('#table-merk').on( 'click', '#delete_merk', function () {
        let id_merk = table.row( $(this).parents('tbody tr') ).data().id_merk;
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
                    url: '/admin/manajemen-barang/delete-merk/' + id_merk,
                    // type: 'POST',
                    method: 'POST',
                    data: {
                        _token: token,
                        id_merk: id_merk,
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
                            window.location.href ='/admin/manajemen-barang/delete-kategori-barang-success';
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
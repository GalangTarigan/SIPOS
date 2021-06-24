
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
		url: "/admin/manajemen-sales/list-sales",
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
                    { data: 'nama_perusahaan' },
                    { data: 'nama_sales' },
                    { data: 'alamat' },
                    { data: 'no_telepon' },
                    { data: 'nama_no_rekening' },
                    { data: null }
                ], 
                // "lengthChange": false,
                "columnDefs": [ 
                { 
                    "render": function(data, type, row){
                        let button = "<span type='button' id='detail' class='btn btn-success-alt'>&nbsp<i class='fa fa-info'></i>&nbsp</span> <span class='btn btn-primary-alt' id='edit'><i class='fa fa-cog '></i></span> <span class='btn btn-danger-alt delete' id='delete'><i class='fa fa-trash '></i></span>"; 
                        return button;                        
                    },
                  "targets": -1
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
     $('#table').on('click', 'tbody tr', function () {
        let id_sales = table.row(this).data().id_sales;
        window.location.href = '/admin/manajemen-sales/detail-sales?data=' + id_sales;
    });

    // untuk detail sales
    $('#table').on( 'click', '#detail', function () {
        let id_sales = table.row( $(this).parents('tbody tr') ).data().id_sales;
        window.location.href = '/admin/manajemen-sales/detail-sales?data=' + id_sales;
    });


    //agar bisa di klik untuk edit sales
    $('#table').on( 'click', '#edit', function (e) {
        e.stopImmediatePropagation(); // stop the row selection when clicking on an icon
        let id_sales = table.row( $(this).parents('tbody tr') ).data().id_sales;
        // let name = table.row( $(this).parents('tbody tr') ).data().id_sales;
        console.log(id_sales)
        // console.log(uuid)        
        window.location.href = '/admin/manajemen-sales/form-edit-sales/' + id_sales;
    });

    


    // //untuk delete barang
    $('#table').on( 'click', '#delete', function (e) {
        e.stopImmediatePropagation(); // stop the row selection when clicking on an icon
        var data = table.row( $(this).parents('tbody tr') ).data();
        console.log( table.row( $(this).parents('tbody tr') ).data().id_sales);
        let id_sales = table.row( $(this).parents('tbody tr') ).data().id_sales;
        json = table.row( $(this).parents('tbody tr') ).data();
        Swal.fire({
            title: 'Apakah anda yakin?',
            // text: "Anda tidak akan bisa merubah jika setuju!!",
            text: "Pastikan Tagihan Sales, Barang Baru dan Barang Return dari sales tidak ada.",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!',
            width: '400px'
        }).then((result) => {
            if (result.value) {
                $.post({
                    url: '/admin/manajemen-sales/delete/' + id_sales,
                    // type: 'POST',
                    method: 'POST',
                    data: {
                        _token: token,
                        user: id_sales,
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
                            window.location.href ='/admin/manajemen-sales/delete-sales-success';
                        } else {
                            Swal.fire(
                                {
                                    type: 'error',
                                    title: 'Sales gagal dihapus!!!',
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




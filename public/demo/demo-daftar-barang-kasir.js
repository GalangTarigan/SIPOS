
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
		url: "/kasir/manajemen-barang-kasir/list-barang",
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
                    { data: 'nama_merk' },
                    { data: 'tipe_barang' },
                    { data: 'nama_sales' },
                    { data: 'jumlah' },
                    { data: 'modal' },
                    { data: 'jual' },
                    { data: null },
                    { data: null }
                ], 
                // "lengthChange": false,
                "columnDefs": [ 
                { 
                    "render": function(data, type, row){
                        let button = "<span type='button' id='detail' class='btn btn-success-alt'>&nbsp<i class='fa fa-info'></i>&nbsp</span> <span type='button' id='editBarang' class='btn btn-primary-alt'><i class='fa fa-cog'></i></span> <span class='btn btn-danger-alt delete' id='delete'><i class='fa fa-trash '></i></span>"; 
                        return button;                        
                    },
                  "targets": -1
                },
                {
                    "render": function(data, type, row){
                        let button = `<span type='button' id='foto' class='btn btn-success-alt'><i class='fa fa-image'></i></span>`;
                        
                        return button;                        
                    },
                  "targets": -2,
                  "width": "7%",
                },
                {
                    render: function (data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    },
                    "targets" : 0,
                    "width": "1%",
                },
            ]                
            })
            $('#table').fadeIn(300)
        }
        
    });

    // di klik untuk lihat detail barang (row)
    $('#table').on('click', 'tbody tr', function () {
        let id_barang = table.row(this).data().id_barang;
        console.log(id_barang)
        window.location.href = '/kasir/manajemen-barang-kasir/detailBarang/' + id_barang;
    });

    // di klik untuk lihat detail barang (tombol detail)
    $('#table').on( 'click', '#detail', function () {
        let id_barang = table.row( $(this).parents('tbody tr') ).data().id_barang;
        window.location.href = '/admin/manajemen-barang-kasir/detailBarang/' + id_barang;
    });

    let images = [];
    let currentImageIdx = 0;
    let prefix = '/dokumentasi/foto/get-foto/';
     //di klik untuk foto barang
     $('#table tbody').on( 'click', '#foto', function (e) {
        e.stopImmediatePropagation(); // stop the row selection when clicking on an icon
        // $('#fotoBarangModal').modal({backdrop: 'static', keyboard: false})  
        $('#fotoBarangModal').modal('show');

        images = table.row( $(this).parents('tbody tr') ).data().picture_urls;
        currentImageIdx = 0;
        $('#main-foto').attr("src", prefix+''+images[0].nama_file);
        $('#image_slider').empty();
        //untuk thumbnal
        images.forEach((image, idx) => {
            console.log(image);
            $('#image_slider').append(`<img id=image_slider_thumb_${idx} class="img" alt="centered image" src='${prefix + '' + image.nama_file}' />`)
            $('#image_slider_thumb_'+idx).on('click', function (e) {
                currentImageIdx = idx;
                $('#main-foto').attr("src", prefix + '' +images[currentImageIdx].nama_file);
            })
        })
    });
    
    $('#prev_image').on('click', function (e) {
        let newIdx = currentImageIdx - 1;
        if (newIdx < 0) newIdx = images.length - 1;
        currentImageIdx = newIdx;
        $('#main-foto').attr("src", prefix + '' +images[currentImageIdx].nama_file);
    })
    $('#next_image').on('click', function (e) {
        let newIdx = currentImageIdx + 1;
        if (newIdx > images.length - 1) newIdx = 0;
        currentImageIdx = newIdx;
        $('#main-foto').attr("src", prefix + '' +images[currentImageIdx].nama_file);
    })

   

    //di klik untuk edit barang
    $('#table tbody').on( 'click', '#editBarang', function (e) {
        e.stopImmediatePropagation(); // stop the row selection when clicking on an icon
        // let uuid = table.row( $(this).parents('tbody tr') ).data().id_barang;
        let id_barang = table.row( $(this).parents('tbody tr') ).data().id_barang;
        console.log(id_barang)
        // console.log(uuid)        
        window.location.href = '/kasir/manajemen-barang-kasir/formEditBarang?barang=' + id_barang;
    });

    //untuk delete barang
    $('#table tbody').on( 'click', '#delete', function (e) {
        e.stopImmediatePropagation(); // stop the row selection when clicking on an icon
        var data = table.row( $(this).parents('tbody tr') ).data();
        console.log( table.row( $(this).parents('tbody tr') ).data().id_barang);
        let id_barang = table.row( $(this).parents('tbody tr') ).data().id_barang;
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
                    url: '/kasir/manajemen-barang-kasir/delete_barang/' + id_barang,
                    // type: 'POST',
                    method: 'POST',
                    data: {
                        _token: token,
                        user: id_barang,
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
                            window.location.href ='/kasir/manajemen-barang-kasir/delete-barang-success';
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




$( document ).ready(function() {
    //Focus input if its has value
    $('.input100').each(function () {
        if ($(this).val().trim() != "") {
            $(this).addClass('has-val');
        }else {
            $(this).removeClass('has-val');
        }
    })

    var token = $('meta[name="csrf-token"]').attr('content')
    // console.log('id_sales'+id)
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    })
    $('#spinner').fadeIn()
    $("#table").css("cursor", "pointer")
    var table
    $.ajax({
		url: "/admin/manajemen-sales/data-tabel-detail?id=" + id,
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
                    { data: 'no_faktur' },
                    { data: 'tanggal_faktur' },
                    { data: 'jatuh_tempo' },
                    { data: 'jumlah_tagihan' },
                    { data: 'status_pembayaran' },
                    { data: null },
                    { data: null }
                ], 
                // "lengthChange": false,
                "columnDefs": [ 
                { 
                    "render": function(data, type, row){
                        let button = "<span class='btn btn-primary-alt' id='edit'>Bayar Tagihan</span>"; 
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
                {
                    "render": function(data, type, row){
                        if(data !== null) {
                            var date = moment(data, 'YYYY-MM-DD', 'id').format("DD MMMM YYYY"); 
                            return date
                        }else{
                            return '~'
                        }
                    },
                    "targets": [3,4]
                },
            ]                
            })
            $('#table').fadeIn(300)
		}
    });

    $('#table').on( 'click', 'tbody tr', function (e) {        
        let id = table.row(this).data().id_tagihan;
        window.location.href = '/admin/manajemen-sales/detail-tagihan-sales?data=' + id;
    });
 
    $('#table tbody').on( 'click', '#edit', function (e) {
        e.stopImmediatePropagation(); // stop the row selection when clicking on an icon
        let id = table.row( $(this).parents('tbody tr') ).data().id_tagihan;
        window.location.href = '/admin/manajemen-sales/edit-status-tagihan-sales?data=' + id;
            
    });


    let images = [];
    let currentImageIdx = 0;
    let prefix = '/dokumentasi/tagihan/get-foto/';
    $('#table tbody').on( 'click', '#foto', function (e) {
        e.stopImmediatePropagation(); // stop the row selection when clicking on an icon
        // alert('haloo')
        $('#fotoFakturTagihan').modal('show');
        images = table.row( $(this).parents('tbody tr') ).data().picture_urls;
        currentImageIdx = 0;
        $('#main-foto').attr("src", prefix+''+images[0].nama_file_tagihan);
        $('#image_slider').empty();
        //untuk thumbnal
        images.forEach((image, idx) => {
            console.log(image);
            $('#image_slider').append(`<img id=image_slider_thumb_${idx} class="img" alt="centered image" src='${prefix + '' + image.nama_file_tagihan}' />`)
            $('#image_slider_thumb_'+idx).on('click', function (e) {
                currentImageIdx = idx;
                $('#main-foto').attr("src", prefix + '' +images[currentImageIdx].nama_file_tagihan);
            })
        })
        
    })

 
    $('#prev_image').on('click', function (e) {
        let newIdx = currentImageIdx - 1;
        if (newIdx < 0) newIdx = images.length - 1;
        currentImageIdx = newIdx;
        $('#main-foto').attr("src", prefix + '' +images[currentImageIdx].nama_file_tagihan);
    })
    $('#next_image').on('click', function (e) {
        let newIdx = currentImageIdx + 1;
        if (newIdx > images.length - 1) newIdx = 0;
        currentImageIdx = newIdx;
        $('#main-foto').attr("src", prefix + '' +images[currentImageIdx].nama_file_tagihan);
    })
});
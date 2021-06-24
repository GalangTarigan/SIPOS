
//Token_CSRF
var token = $('meta[name="csrf-token"]').attr('content')
$( document ).ready(function() {

	$("#select2_nama_perusahaan").select2({
        width: '100%',
        placeholder: "Pilih Perusahaan & Sales",
        containerCssClass: 'tpx-select2-container select2-container',
        dropdownCssClass: 'tpx-select2-drop',
        // allowClear: true
    });

    $("#select2_no_faktur").select2({
        width: '100%',
        placeholder: "Pilih No.Faktur",
        containerCssClass: 'tpx-select2-container select2-container',
        dropdownCssClass: 'tpx-select2-drop',
        // allowClear: true
    });

    $("#select2_nama_perusahaan").on('change', function () {
        if ($(this).hasClass('is-invalid') && $(this).val() != "") {
            if($("#select2_nama_perusahaan").next().is('span')) $("#select2_nama_perusahaan").next().remove()
        }
    })
    $("#select2_no_faktur").on('change', function () {
        if ($(this).hasClass('is-invalid') && $(this).val() != "") {
            if($("#select2_no_faktur").next().is('span')) $("#select2_no_faktur").next().remove()
        }
    })



    //Initializing options value select2 merk barang
	 $.ajax({
        url: '/admin/keuangan/daftar-sales-belum-lunas/',
        type: 'post',
        data: {
            _token: token
        },
        dataType: 'json',
        success: function (data) {
            $.each(data['data'], function (key, val) {
                $("#select2_nama_perusahaan").append('<option value="' + val.nama_perusahaan + '">' + val.nama_perusahaan+ ' - ' + val.nama_sales+ '</option>')
            })
            $("#loadingIcon1").hide()
            if((typeof oldValP !== 'undefined')){
                $("#select2_nama_perusahaan").val(oldValP).trigger('change')
            }
        },
        error: function (request, status, error) {
            $('<span class="text-danger"><div class="parsley-required">Data tidak dapat dimuat, harap refresh halaman</div></span>').insertAfter('#select2_nama_perusahaan');
        }
    });    
    
    //untuk kategori
    $("#select2_nama_perusahaan").on('change', function () {
        $("#loadingIcon2").show()
        
        var nama_perusahaan = $(this).val()
        if (nama_perusahaan == "") {
            $("#select2_no_faktur").html('<option></option>')
            $("#loadingIcon2").hide()
        } else {
            $.ajax({
                url: '/admin/keuangan/daftar-no-faktur',
                type: 'post',
                data: {
                    _token: token,
                    nama_perusahaan: nama_perusahaan
                },
                dataType: 'json',
                success: function (data) {
                    console.log(data)                    
                    $('#select2_no_faktur').val(null).trigger('change'); // untuk buat null value ketika kita ganti pilihan pada nama perusahan
                    $("#select2_no_faktur").html('<option></option>')
                    $.each(data['data'], function (key, val) {
                        $("#select2_no_faktur").append('<option value="' + val.id_tagihan + '">' + val.no_faktur + '</option>')  
                        
                    })
                    $("#loadingIcon2").hide()
                    //set value to select2 option if its has old value
                    if ((typeof oldValS !== 'undefined')) {
                        $("#select2_no_faktur").val(oldValS).trigger('change')
                    }
                },
                error: function (request, status, error) {
                    $('<span class="text-danger"><div class="parsley-required">Data tidak dapat dimuat, harap refresh halaman</div></span>').insertAfter('#select2_no_faktur');
                }
            });
        }
    })

    // $("#select2_no_faktur").on('change', function () {
    //     var id_tagihan = $(this).val()
    //     alert(id_tagihan);
    // })


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
        $(this).parent().next().not('br').not('#progressBar-video').remove()
    })
})


	$('#submit').on('click', function (e) {        
		 if ($("#select2_no_faktur").val() == "" ||  $("#select2_nama_perusahaan").val() == "") {
			Swal.fire({
                title: 'Oops...',
                text: 'Harap pilih sales dan faktur terlebih dahulu',
                width: '400px',
                type: 'error',
                backdrop: `rgba(0,0,123,0.4)`
              })
		}
    })
    
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
		url: "/admin/keuangan/daftar-tagihan-belum-lunas",
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
                    
                ], 
                // "lengthChange": false,
                "columnDefs": [                 
                {
                    "render": function(data, type, row){
                        let button = `<span type='button' id='foto' class='btn btn-success-alt'><i class='fa fa-image'></i></span>`;
                        
                        return button;                        
                    },
                  "targets": -1,
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
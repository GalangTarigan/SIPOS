$(function () {

	var token = $('meta[name="csrf-token"]').attr('content')
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
	})

    //validate
	$('#validate-form #submit').on('click', function () {
        $('#validate-form').parsley().validate();
	});

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
	
	$(function() { $('.mask').inputmask(); });

	//select2 untuk merk barang
    //Initialize select2 merk barang
    $("#select2_merk_barang").select2({
        width: '100%',
        placeholder: "Pilih Merk Barang",
        containerCssClass: 'tpx-select2-container select2-container',
        dropdownCssClass: 'tpx-select2-drop',
        // allowClear: true
    });

	//Initializing options value select2 merk barang
	$.ajax({
        url: '/admin/manajemen-barang/get-merk-barang/',
        type: 'post',
        data: {
            _token: token
        },
        dataType: 'json',
        success: function (data) {
            $.each(data['data'], function (key, val) {
                $("#select2_merk_barang").append('<option value="' + val.id_merk + '">' + val.nama_merk + '</option>')
            })
        },
        error: function (request, status, error) {
            $('<span class="text-danger"><div class="parsley-required">Data tidak dapat dimuat, harap refresh halaman</div></span>').insertAfter('#select2_merk_barang');
        }
    });

	$("#select2_merk_barang").on('change', function () {
        if ($(this).hasClass('is-invalid') && $(this).val() != "") {
            if($("#select2_merk_barang").next().is('span')) $("#select2_merk_barang").next().remove()
        }
    })


	//select2 kategori barnag
    //Initialize select2 kategori barang
    $("#select2_kategori_barang").select2({
        width: '100%',
        placeholder: "Pilih Kategori",
        containerCssClass: 'tpx-select2-container select2-container',
        dropdownCssClass: 'tpx-select2-drop',
        // allowClear: true
    });
    
	 //Initializing options value select2 kategori barang
	 $.ajax({
        url: '/admin/manajemen-barang/getKategoriBarang/',
        type: 'post',
        data: {
            _token: token
        },
        dataType: 'json',
        success: function (data) {
            $.each(data['data'], function (key, val) {
                $("#select2_kategori_barang").append('<option value="' + val.id_kategori + '">' + val.nama_kategori + '</option>')
            })
            $("#loadingIcon3").hide()
            if((typeof oldValS !== 'undefined')){
                $("#select2_kategori_barang").val(oldValS).trigger('change')
            }
        },
        error: function (request, status, error) {
            $('<span class="text-danger"><div class="parsley-required">Data tidak dapat dimuat, harap refresh halaman</div></span>').insertAfter('#select2_kategori_barang');
        }
    });

	$("#select2_kategori_barang").on('change', function () {
        if ($(this).hasClass('is-invalid') && $(this).val() != "") {
            if($("#select2_kategori_barang").next().is('span')) $("#select2_kategori_barang").next().remove()
        }
    })

	//select2 nama sales
    //Initialize select2 nama sales
    $("#select2_nama_sales").select2({
        width: '100%',
        placeholder: "Pilih Sales",
        containerCssClass: 'tpx-select2-container select2-container',
        dropdownCssClass: 'tpx-select2-drop',
        // allowClear: true
    });
    
	 //Initializing options value select2 kategori barang
	 $.ajax({
        url: '/admin/manajemen-barang/getSales/',
        type: 'post',
        data: {
            _token: token
        },
        dataType: 'json',
        success: function (data) {
            $.each(data['data'], function (key, val) {
                $("#select2_nama_sales").append('<option value="' + val.id_sales + '">' + val.nama_sales + '</option>')
            })
            $("#loadingIcon4").hide()
            if((typeof oldValP !== 'undefined')){
                $("#select2_nama_sales").val(oldValS).trigger('change')
            }
        },
        error: function (request, status, error) {
            $('<span class="text-danger"><div class="parsley-required">Data tidak dapat dimuat, harap refresh halaman</div></span>').insertAfter('#select2_nama_sales');
        }
    });

	$("#select2_nama_sales").on('change', function () {
        if ($(this).hasClass('is-invalid') && $(this).val() != "") {
            if($("#select2_nama_sales").next().is('span')) $("#select2_nama_sales").next().remove()
        }
    })

	//alert if report failed to create
	if (typeof error_failed !== 'undefined') {
		Swal.fire(
			'Error!',
			error_failed,
			'error'
		)
	}

	//validate
    $('#validate-form #submit').on('click', function () {
        $('#validate-form').parsley().validate();
    });
    $('select').parsley({
		successClass: "select2-success",
		errorClass: "select2-error",
		classHandler: function (el) {
			return el.$element.parent().find('.select2-container')
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
	
	//images upload prerequisites
	var error_msg = [];
	const extensionLists = {}; //Create an object for all extension lists
	extensionLists.image = ['jpg', 'gif', 'bmp', 'png', 'jpeg'];
	
	// One validation function for all file types    
	function isValidFileType(fName, fType) {
		return extensionLists[fType].indexOf(fName.split('.').pop().toLowerCase()) > -1;
	}

	//Image upload
	var uploader = $('input[name="images[]"]')
	// var uploader = $('input[name="images"]')
	var images = $('.images_prev')
	$(".images_prev .pic").on('click', function () {
		uploader.click()
	})

	//check whether users browser support upload file or not
	if (window.File && window.FileList && window.FileReader) {
		function render(data) {
			$(
            `<div class="img" id="img" onclick="imagesOpen('${data}')" style="background-image: url(${data});"><span></span></div>`
        ).insertBefore($(".images_prev .pic"));
		}
		uploader.on('change', function (e) {
			var files = e.target.files
			if (files.length > 5) {
				Swal.fire(
					'Warning!',
					'Jumlah Foto Maksimal 5',
					'warning'
				)
				disableInputImage(counter)
			} else if(files.length <= 5){
				event.preventDefault()
				// if (!validateImagesInput(uploader)) {
				// 	var msg = ''
				// 	$.each(error_msg, function (key, val) {
				// 	msg += val
				// 	})
				// 	Swal.fire(
				// 	'Error!',
				// 	msg,
				// 	'error'
				// 	)
				// 	return false
				// }
				console.log(Object.values(files))
				console.log($("#imgPrevContainer").children('#img'))
				
				$(".images_prev").children().each(function (value) {
					if (!$(this).is('.pic')){
						$(this).remove();
					   }
				 });

				Object.values(files).forEach(file => {
					var img = URL.createObjectURL(file);
                    render(img);
                });
			}

		})
	} else {
		Swal.fire(
			'Error!',
			'Browser anda tidak support File API',
			'error'
		)
	}
	//Image file validation
	function validateImagesInput(input) {
		error_msg = []
		var result 
		for (let i = 0; i < input[0].files.length; i++) {
			if (input[0].files[i].size >= (1024 * 1024 * 3)) {
				if (!isValidFileType(input[0].files[i].name, 'image')) error_msg.push('Format file tidak didukung')
				error_msg.push('Ukuran file terlalu besar, maksimal 3MB per-file. ')
				return false
			} else if (!isValidFileType(input[0].files[i].name, 'image')) {
				error_msg.push('Format file tidak didukung. ')
				return false
			} else {
				result =  true
			}
		}
		return result
	}
	
});

function imagesNewTab(dokumentasi) {
	window.open('/dokumentasi/foto/get-foto/' + dokumentasi)
}

function imagesOpen(dokumentasi) {			
	// alert('berhasil')
	window.open(dokumentasi);
}

//untuk hide and show ubah kategori
function showEditMerk(){
	document.getElementById('label_merk').style.display = 'block';
	document.getElementById('input_merk').style.display = 'block';
	document.getElementById('bat_button_merk').style.display = 'block';
	document.getElementById('ed_button_merk').style.display = 'none';
}
function hideEditMerk(){
	document.getElementById('label_merk').style.display = 'none';
	document.getElementById('input_merk').style.display = 'none';
	document.getElementById('bat_button_merk').style.display = 'none';
	document.getElementById('ed_button_merk').style.display = 'block';
	$('#select2_merk_barang').val(null).trigger('change'); // untuk buat null value ketika kita pilih batal edit
}

//untuk hide and show ubah kategori
function show(){
	document.getElementById('label_kategori').style.display = 'block';
	document.getElementById('input_kategori').style.display = 'block';
	document.getElementById('bat_button').style.display = 'block';
	document.getElementById('ed_button').style.display = 'none';
}
function hide(){
	document.getElementById('label_kategori').style.display = 'none';
	document.getElementById('input_kategori').style.display = 'none';
	document.getElementById('bat_button').style.display = 'none';
	document.getElementById('ed_button').style.display = 'block';
	$('#select2_kategori_barang').val(null).trigger('change'); // untuk buat null value ketika kita pilih batal edit
}

//untuk hide and show ubah sales
function show2(){
	document.getElementById('input_sales').style.display = 'block';
	document.getElementById('label_sales').style.display = 'block';
	document.getElementById('bat_button2').style.display = 'block';
	document.getElementById('ed_button2').style.display = 'none';
}
function hide2(){
	document.getElementById('input_sales').style.display = 'none';
	document.getElementById('label_sales').style.display = 'none';
	document.getElementById('bat_button2').style.display = 'none';
	document.getElementById('ed_button2').style.display = 'block';
	$('#select2_nama_sales').val(null).trigger('change'); // untuk buat null value ketika kita pilih batal edit
}

//ketika tombol reset ditekan maka semua akan dihide
function hideAll(){
	//untuk merk
	document.getElementById('label_merk').style.display = 'none';
	document.getElementById('input_merk').style.display = 'none';
	document.getElementById('bat_button_merk').style.display = 'none';
	document.getElementById('ed_button_merk').style.display = 'block';
	$('#select2_merk_barang').val(null).trigger('change'); // untuk buat null value ketika kita pilih batal edit

	//unutk kategori
	document.getElementById('label_kategori').style.display = 'none';
	document.getElementById('input_kategori').style.display = 'none';
	document.getElementById('bat_button').style.display = 'none';
	document.getElementById('ed_button').style.display = 'block';
	$('#select2_kategori_barang').val(null).trigger('change'); // untuk buat null value ketika kita pilih batal edit

	//untuk sales
	document.getElementById('input_sales').style.display = 'none';
	document.getElementById('label_sales').style.display = 'none';
	document.getElementById('bat_button2').style.display = 'none';
	document.getElementById('ed_button2').style.display = 'block';
	$('#select2_nama_sales').val(null).trigger('change'); // untuk buat null value ketika kita pilih batal edit
}







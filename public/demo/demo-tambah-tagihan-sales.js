
$( document ).ready(function() {
  
    var token = $('meta[name="csrf-token"]').attr('content')
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    })
	
	
	$(function() { $('.mask').inputmask(); });
	
	



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
			if ($(this).parent().next()) {
				$(this).parent().next().remove()
			}
		})
	})
	$('select').each(function () {
		$(this).on('change', function () {
			if ($(this).hasClass('is-invalid') && $(this).val() != "") {
				if ($(this).next().is('span')) $(this).next().remove()
			} else {
				$(this).parsley().validate()
			}
		})
    })
    
    //validate
    $('#validate-form #submit').on('click', function () {
        $('#validate-form').parsley().validate();
    });


	//untuk select select
	$('select').parsley({
		successClass: "select2-success",
		errorClass: "select2-error",
		classHandler: function (el) {
			return el.$element.parent().find('.select2-container')
		}
	})


    //SELECT2
	//initialize select2 office

	$("#select2_nama_perusahaan").select2({
        width: '100%',
        placeholder: "Pilih Perusahaan",
        containerCssClass: 'tpx-select2-container select2-container',
        dropdownCssClass: 'tpx-select2-drop',
        allowClear: true
    });

    //Initializing options value select2 nama perusahaan
	$.ajax({
		url: '/admin/manajemen-sales/daftar-perusahaan',
		type: 'post',
		data: {
			_token: token,
		},
		dataType: 'json',
		success: function (data) {
            // console.log(data)
			$.each(data['data'], function (key, val) {
				$("#select2_nama_perusahaan").append('<option value="' + val.id_sales + '">' + val.nama_perusahaan + '</option>')
				// console.log(val.id_sales)
			})
			// $("#select2_nama_perusahaan").append('<option value="kategori_baru">"Kategori Baru"</option>')
			if ((typeof oldValP !== 'undefined')) {
				$("#select2_nama_perusahaan").val(oldValP).trigger('change')
			}
			$("#loadingIcon4").hide()
		},
		error: function (request, status, error) {
			$("#loadingIcon4").hide()
			$('<span class="text-danger"><div class="parsley-required">Data tidak dapat dimuat, harap refresh halaman</div></span>').insertAfter('#select2_nama_perusahaan');

		}
	});

	$("#select2_nama_perusahaan").on('change', function () {
        
		console.log("ini merk cok ")
		var id_sales = $(this).val()
		
		console.log(id_sales)
		
		document.getElementById('id_sales').value = id_sales

		$.ajax({
			url: '/admin/manajemen-sales/nama-sales',
			type: 'post',
			data: {
				_token: token,
				id : id_sales
			},
			dataType: 'json',
			success: function (data) {
				console.log(data)
				$.each(data['data'], function (key, val) {
					console.log("ini sales"+val.nama_sales)
					document.getElementById('nama_sales').value = val.nama_sales
					// $('#jumlah_tagihan').val(val.nama_sales);

						//Focus input if its has value
					$('.input100').each(function () {
						if ($(this).val().trim() != "") {
							$(this).addClass('has-val');
						}else {
							$(this).removeClass('has-val');
						}
					})
				})

			}
		})


        if ($(this).hasClass('is-invalid') && $(this).val() != "") {
            if ($("#select2_nama_perusahaan").next().is('span')) $("#select2_nama_perusahaan").next().remove()
        }
    })



	// Initialize datetime mask
	$('input[name="tanggal_faktur"]').inputmask({ alias: 'datetime', inputFormat: "dd/mm/yyyy" }, { showMaskOnHover: false })
	
	//daterangepicker
	$('#date-rangepicker-tanggal-faktur').daterangepicker({
		autoUpdateInput: true,
		singleDatePicker: true,
		locale: {
			format: 'DD/MM/YYYY',
			cancelLabel: 'Clear'
		}
	
	});
	
	$('#date-rangepicker-tanggal-faktur').on('apply.daterangepicker', function (ev, picker) {
	
		$('input[name="tanggal_faktur"]').val(picker.startDate.format(picker.locale.format));
		$('input[name="tanggal_faktur"]').addClass('has-val');
		if ($('input[name="tanggal_faktur"]').parent().next()) {
			$(this).parent().next().remove()
		}
	});

	$('#date-rangepicker-tanggal-faktur').on('cancel.daterangepicker', function (ev, picker) {
		$('input[name="tanggal_faktur"]').val('')
		$('input[name="tanggal_faktur"]').removeClass('has-val')
		$('input[name="tanggal_faktur"]').parsley().validate()
	});

	//field mask
	$('.mask').inputmask()
	$('input[name="tanggal_faktur"]').inputmask({ alias: 'datetime', inputFormat: "dd/mm/yyyy" }, { showMaskOnHover: false })

	//Video and images upload prerequisites
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
            `<div class="img" id="img" style="background-image: url(${data});" onclick="imagesNewTab('${data}')"><span></span></div>`
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
				if (!validateImagesInput(uploader)) {
					var msg = ''
					$.each(error_msg, function (key, val) {
					msg += val
					})
					Swal.fire(
					'Error!',
					msg,
					'error'
					)
					return false
				}
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


})

function imagesNewTab(dokumentasi) {			
	// alert('berhasil')			
	  window.open(dokumentasi);
}

$('#submit').on('click', function (e) {

	if ($("input[name='images[]']").val() == "") {
		Swal.fire({
			title: 'Oops...',
			text: 'Harap Upload foto Faktur Tagihan!',
			width: '400px',
			type: 'error',
			backdrop: `rgba(0,0,123,0.4)`
		  })
   }
})
var token = $('meta[name="csrf-token"]').attr('content')
$( document ).ready(function() {

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

	$('select').each(function () {
		$(this).on('change', function () {
			if ($(this).hasClass('is-invalid') && $(this).val() != "") {
				if ($(this).next().is('span')) $(this).next().remove()
			} else {
				$(this).parsley().validate()
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


    //untuk select select
    $('select').parsley({
        successClass: "select2-success",
        errorClass: "select2-error",
        classHandler: function (el) {
            return el.$element.parent().find('.select2-container')
        }
    })

    $("#select2_lokasi_barang").select2({
        width: '100%',
        placeholder: "Pilih Lokasi Barang",
        containerCssClass: 'tpx-select2-container select2-container',
        dropdownCssClass: 'tpx-select2-drop',
        // allowClear: true
    });

    // $("#loadingIcon4").hide()
    $("#select2_lokasi_barang").append('<option value="Toko" > Toko </option>')
    $("#select2_lokasi_barang").append('<option value="Gudang"> Gudang </option>')


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


});
function imagesNewTab(dokumentasi) {			
	// alert('berhasil')			
	  window.open(dokumentasi);
}
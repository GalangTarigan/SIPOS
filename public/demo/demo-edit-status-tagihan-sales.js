var token = $('meta[name="csrf-token"]').attr('content')
function getval(status)
{
	if(status.value == "Langsung Sales"){
		// alert('berhasil')
		$('#foto').remove();
		$('#input_file').remove();
		$('#tanggal').remove();
		$('#form_model_bayar').append(`<div class="form-group" id="tanggal"> <label class="col-sm-4 control-label" style="padding-top: 50px !important;"> Tanggal Pembayaran &nbsp;&nbsp;&nbsp;&nbsp; : </label> <div class="col-sm-7" style="padding-top: 35px !important;"> <div class="wrap-input100 input-group" data-validate="Tidak boleh kosong"> <span id="date-rangepicker-tanggal-bayar" class="input-group-addon" style="border: none; background-color: inherit !important;"><i id="cal-click" class="fas fa-calendar-alt"></i></span> <input class="input100 mask" required type="text" name="tanggal_bayar" autocomplete="off" spellcheck="false"><span class="focus-input100" data-placeholder="Tanggal Bayaar"></span></div></div></div>`)

		//Initialize datetime mask
		$('input[name="tanggal_bayar"]').inputmask({ alias: 'datetime', inputFormat: "dd/mm/yyyy" }, { showMaskOnHover: false })
		$('#date-rangepicker-tanggal-bayar').daterangepicker({
            autoUpdateInput: true,
            singleDatePicker: true,
            locale: {
                format: 'DD/MM/YYYY',
                cancelLabel: 'Clear'
            }
		});
		
        $('#date-rangepicker-tanggal-bayar').on('apply.daterangepicker', function (ev, picker) {
            $('input[name="tanggal_bayar"]').val(picker.startDate.format(picker.locale.format));
            $('input[name="tanggal_bayar"]').addClass('has-val');
            if ($('input[name="tanggal_bayar"]').parent().next()) {
                $(this).parent().next().remove()
            }
        });

	}else{
		$('#tanggal').remove();
		$('#form_model_bayar').append(`<div class="form-group" id="tanggal"> <label class="col-sm-4 control-label" style="padding-top: 50px !important;"> Tanggal Pembayaran &nbsp;&nbsp;&nbsp;&nbsp; : </label> <div class="col-sm-7" style="padding-top: 35px !important;"> <div class="wrap-input100 input-group" data-validate="Tidak boleh kosong"> <span id="date-rangepicker-tanggal-bayar" class="input-group-addon" style="border: none; background-color: inherit !important;"><i id="cal-click" class="fas fa-calendar-alt"></i></span> <input class="input100 mask" required type="text" name="tanggal_bayar" autocomplete="off" spellcheck="false"><span class="focus-input100" data-placeholder="Tanggal Bayaar"></span></div></div></div>`)
		$('#form_model_bayar').append(`<div class="form-group" id="foto"> <label class="col-sm-4 control-label" style="padding-top: 20px !important;">Upload Foto Faktur &nbsp;&nbsp;&nbsp;&nbsp; : </label><div class="col-sm-7" id="imgPrevContainer"><div class="images_prev"><div class="pic"><i class="fas fa-plus fa-3x"></i></div></div></div></div>`)
		$('#form_model_bayar').append(`<input required type="file" id="input_file" name="images[]" accept="image/*" multiple  style="display:none !important" />`)


		//Initialize datetime mask
		$('input[name="tanggal_bayar"]').inputmask({ alias: 'datetime', inputFormat: "dd/mm/yyyy" }, { showMaskOnHover: false })
		$('#date-rangepicker-tanggal-bayar').daterangepicker({
            autoUpdateInput: true,
            singleDatePicker: true,
            locale: {
                format: 'DD/MM/YYYY',
                cancelLabel: 'Clear'
            }
        });

        $('#date-rangepicker-tanggal-bayar').on('apply.daterangepicker', function (ev, picker) {
            $('input[name="tanggal_bayar"]').val(picker.startDate.format(picker.locale.format));
            $('input[name="tanggal_bayar"]').addClass('has-val');
            if ($('input[name="tanggal_bayar"]').parent().next()) {
                $(this).parent().next().remove()
            }
		});
		
		
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

	}
}

$( document ).ready(function() {

            //untuk select select
        $('select').parsley({
            successClass: "select2-success",
            errorClass: "select2-error",
            classHandler: function (el) {
                return el.$element.parent().find('.select2-container')
            }
        })
        $("#select2_status_pembayaran").select2({
            width: '100%',
            placeholder: "Pilih Model Pembayaran",
            containerCssClass: 'tpx-select2-container select2-container',
            dropdownCssClass: 'tpx-select2-drop',
            // allowClear: true
        });
        $("#select2_status_pembayaran").append('<option value="Langsung Sales" > Langsung ke sales</option>')
        $("#select2_status_pembayaran").append('<option value="Transfer"> Transfer</option>')



        // //Initialize datetime mask
        // $('input[name="tanggal_bayar"]').inputmask({ alias: 'datetime', inputFormat: "dd/mm/yyyy" }, { showMaskOnHover: false })

        // //daterangepicker
        // $('#date-rangepicker-tanggal-bayar').daterangepicker({
        //     autoUpdateInput: true,
        //     singleDatePicker: true,
        //     locale: {
        //         format: 'DD/MM/YYYY',
        //         cancelLabel: 'Clear'
        //     }

        // });

        // $('#date-rangepicker-tanggal-bayar').on('apply.daterangepicker', function (ev, picker) {

        //     $('input[name="tanggal_bayar"]').val(picker.startDate.format(picker.locale.format));
        //     $('input[name="tanggal_bayar"]').addClass('has-val');
        //     if ($('input[name="tanggal_bayar"]').parent().next()) {
        //         $(this).parent().next().remove()
        //     }
        // });

    // //images upload prerequisites
	// var error_msg = [];
	// const extensionLists = {}; //Create an object for all extension lists
	// extensionLists.image = ['jpg', 'gif', 'bmp', 'png', 'jpeg'];
	
	// // One validation function for all file types    
	// function isValidFileType(fName, fType) {
	// 	return extensionLists[fType].indexOf(fName.split('.').pop().toLowerCase()) > -1;
	// }

	// //Image upload
	// var uploader = $('input[name="images[]"]')
	// // var uploader = $('input[name="images"]')
	// var images = $('.images_prev')
	// $(".images_prev .pic").on('click', function () {
	// 	uploader.click()
	// })

	// //check whether users browser support upload file or not
	// if (window.File && window.FileList && window.FileReader) {
	// 	function render(data) {
	// 		$(
    //         `<div class="img" id="img" style="background-image: url(${data});" onclick="imagesNewTab('${data}')"><span></span></div>`
    //     ).insertBefore($(".images_prev .pic"));
	// 	}
	// 	uploader.on('change', function (e) {
	// 		var files = e.target.files
	// 		if (files.length > 5) {
	// 			Swal.fire(
	// 				'Warning!',
	// 				'Jumlah Foto Maksimal 5',
	// 				'warning'
	// 			)
	// 			disableInputImage(counter)
	// 		} else if(files.length <= 5){
	// 			event.preventDefault()
	// 			if (!validateImagesInput(uploader)) {
	// 				var msg = ''
	// 				$.each(error_msg, function (key, val) {
	// 				msg += val
	// 				})
	// 				Swal.fire(
	// 				'Error!',
	// 				msg,
	// 				'error'
	// 				)
	// 				return false
	// 			}
	// 			console.log(Object.values(files))
	// 			console.log($("#imgPrevContainer").children('#img'))
				
	// 			$(".images_prev").children().each(function (value) {
	// 				if (!$(this).is('.pic')){
	// 					$(this).remove();
	// 				   }
	// 			 });

	// 			Object.values(files).forEach(file => {
	// 				var img = URL.createObjectURL(file);
    //                 render(img);
    //             });
	// 		}

	// 	})
	// } else {
	// 	Swal.fire(
	// 		'Error!',
	// 		'Browser anda tidak support File API',
	// 		'error'
	// 	)
	// }
	// //Image file validation
	// function validateImagesInput(input) {
	// 	error_msg = []
	// 	var result 
	// 	for (let i = 0; i < input[0].files.length; i++) {
	// 		if (input[0].files[i].size >= (1024 * 1024 * 3)) {
	// 			if (!isValidFileType(input[0].files[i].name, 'image')) error_msg.push('Format file tidak didukung')
	// 			error_msg.push('Ukuran file terlalu besar, maksimal 3MB per-file. ')
	// 			return false
	// 		} else if (!isValidFileType(input[0].files[i].name, 'image')) {
	// 			error_msg.push('Format file tidak didukung. ')
	// 			return false
	// 		} else {
	// 			result =  true
	// 		}
	// 	}
	// 	return result
	// }
});

function imagesNewTab(dokumentasi) {			
	// alert('berhasil')			
	  window.open(dokumentasi);
}


function imagesOldPic(dokumentasi) {
	window.open('/dokumentasi/tagihan/get-foto/' + dokumentasi)
}

$('#submit').on('click', function (e) {

	if ($("input[name='tanggal_bayar']").val() == "" || $("input[name='images[]']").val() == "") {
		Swal.fire({
			title: 'Oops...',
			text: 'Harap diisi dengan benar!',
			width: '400px',
			type: 'error',
			backdrop: `rgba(0,0,123,0.4)`
		  })
   }
})


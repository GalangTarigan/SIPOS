//select2 nama sales
    //Initialize select2 nama sales
    $("#select2_posisi_pegawai").select2({
        width: '100%',
        placeholder: "Pilih posisi pegawai",
        containerCssClass: 'tpx-select2-container select2-container',
        dropdownCssClass: 'tpx-select2-drop',
        allowClear: true
	});
	

//field mask
$('.mask').inputmask();
	if (typeof messageFailedCreateUser !== 'undefined') {
		Swal.fire(
			'Error!',
			messageFailedCreateUser,
			'error'
		)
	}
	if (typeof messageSuccessCreateUser !== 'undefined') {
		Swal.fire(
			'Berhasil!',
			messageSuccessCreateUser,
			'success'
		)
	}
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

	$('select').each(function () {
		$(this).on('change', function () {
			if ($(this).hasClass('is-invalid') && $(this).val() != "") {
				if ($(this).next().is('span')) $(this).next().remove()
			} else {
				$(this).parsley().validate()
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

	var showPass = 0;
    $('.btn-show-pass').on('click', function(){
        if(showPass == 0) {
            $(this).next('input').attr('type','text');
            $(this).find('i').removeClass('zmdi-eye');
            $(this).find('i').addClass('zmdi-eye-off');
            showPass = 1;
        }
        else {
            $(this).next('input').attr('type','password');
            $(this).find('i').addClass('zmdi-eye');
            $(this).find('i').removeClass('zmdi-eye-off');
            showPass = 0;
        }
        
	});
	
	$('input[type="number"]').each(function () {
		$(this).on('keyup', function () {
            if ($(this).val().length < 11)  $(this).parent().attr('data-validate', 'Min. 11 karakter')
            else if($(this).val().length > 12)  $(this).parent().attr('data-validate', 'Maks. 12 karakter')

            $(this).parsley().validate()
		})

    })



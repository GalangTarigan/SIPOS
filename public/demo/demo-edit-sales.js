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
        console.log(id_sales)
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
	
	



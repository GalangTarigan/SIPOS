


	var token = $('meta[name="csrf-token"]').attr('content')
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
	})



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

//render preview image
// function render(dokumentasi) {
// 	console.log(dokumentasi)
// var hostname = window.location.origin;
// $(
// // `<div class="img" id="img" style="background-image: url(`+ hostname+`/dokumentasi/foto/get-foto/` +dokumentasi`);"><span>
// // </span>
// // </div>`
// // ).insertBefore($(".images_prev .pic"));
// 	}

	// function render(dokumentasi) {
	// 	var hostname = window.location.origin;
	// 	$('<a onclick="imageNewTab(\''+dokumentasi+'\')"><div class="img" id="img" style="background-image: url('+ hostname+'/dokumentasi/foto/get-foto/' + dokumentasi + ');"><span></span></div></a>')
	// 	.insertBefore($(".images_prev .pic"))
	// }
	
	// function loadImage(imgsrc) {
	// 	// buka modal
	// 	$('#my_image').on({
	// 		'click': function(){
	// 			$('#my_image').attr('src','second.jpg');
	// 		}
	// 	});
	// }
	// pr dari widi

	function imagesNewTab(dokumentasi) {
		window.open('/dokumentasi/foto/get-foto/' + dokumentasi)
	}

	

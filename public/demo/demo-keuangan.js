
//Token_CSRF
var token = $('meta[name="csrf-token"]').attr('content')
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

//daterangepicker
	$('#date-rangepicker-tanggal-mulai').css('cursor', 'pointer')
	$('#date-rangepicker-tanggal-mulai').daterangepicker({
		autoUpdateInput: true,
		maxDate: moment(),
		locale: {
			format: 'DD/MM/YYYY'
		}

	});
	$('#date-rangepicker-tanggal-mulai').on('apply.daterangepicker', function (ev, picker) {
		//Apply changes to input field waktu mulai training
		$('input[name="tanggalMulai"]').val(picker.startDate.format(picker.locale.format))
		$('input[name="tanggalMulai"]').addClass('has-val')
		$('input[name="tanggalMulai"]').parsley().validate()

		//Apply changes to input field waktu selesai training
		$('input[name="sampaiTanggal"]').val(picker.endDate.format(picker.locale.format))
		$('input[name="sampaiTanggal"]').addClass('has-val')
		$('input[name="sampaiTanggal"]').parsley().validate()
	});

	//field mask
	$('.mask').inputmask()
	$('input[name="tanggalMulai"]').inputmask({ alias: 'datetime', inputFormat: "dd/mm/yyyy" })
	$('input[name="sampaiTanggal"]').inputmask({ alias: 'datetime', inputFormat: "dd/mm/yyyy" })

	$('#submit').on('click', function (e) {

		 if ($("input[name='tanggalMulai']").val() == "") {
			Swal.fire({
                title: 'Oops...',
                text: 'Harap pilih Tanggal terlebih dahulu',
                width: '400px',
                type: 'error',
                backdrop: `rgba(0,0,123,0.4)`
              })
		}
	})
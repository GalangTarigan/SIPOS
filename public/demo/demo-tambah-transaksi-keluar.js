
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



	// Initialize datetime mask
	$('input[name="tanggal_transaksi"]').inputmask({ alias: 'datetime', inputFormat: "dd/mm/yyyy" }, { showMaskOnHover: false })
	
	//daterangepicker
	$('#date-rangepicker-transaksi-keluar').daterangepicker({
		autoUpdateInput: true,
		singleDatePicker: true,
		locale: {
			format: 'DD/MM/YYYY',
			cancelLabel: 'Clear'
		}
	
	});
	
	$('#date-rangepicker-transaksi-keluar').on('apply.daterangepicker', function (ev, picker) {
	
		$('input[name="tanggal_transaksi"]').val(picker.startDate.format(picker.locale.format));
		$('input[name="tanggal_transaksi"]').addClass('has-val');
		if ($('input[name="tanggal_transaksi"]').parent().next()) {
			$(this).parent().next().remove()
		}
	});

	$('#date-rangepicker-transaksi-keluar').on('cancel.daterangepicker', function (ev, picker) {
		$('input[name="tanggal_transaksi"]').val('')
		$('input[name="tanggal_transaksi"]').removeClass('has-val')
		$('input[name="tanggal_transaksi"]').parsley().validate()
	});

	//field mask
	$('.mask').inputmask()
	$('input[name="tanggal_transaksi"]').inputmask({ alias: 'datetime', inputFormat: "dd/mm/yyyy" }, { showMaskOnHover: false })

})
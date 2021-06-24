var token = $('meta[name="csrf-token"]').attr('content')
$( document ).ready(function() {

	//validate
    $('#validate-form #submit').on('click', function () {
        $('#validate-form').parsley().validate();
    });
    
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
    

    let status = document.getElementById('status_barang').value;
    if (status === "Tidak dapat diperbaiki"){
        document.getElementById('form_biaya').style.display = 'none';
		document.getElementById('form_modal').style.display = 'none';
		document.getElementById('form_status_bayar').style.display = 'none';
        document.getElementById('form_note').style.display = 'block';
	}else if (status === "Belum Selesai"){
		document.getElementById('form_biaya').style.display = 'none';
		document.getElementById('form_modal').style.display = 'none';
		document.getElementById('form_status_bayar').style.display = 'none';
	}
		
})


function imagesNewTab(dokumentasi) {
	window.open('/dokumentasi/barang_service/get-foto/' + dokumentasi)
}

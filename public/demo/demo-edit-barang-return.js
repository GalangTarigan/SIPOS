

$(function () {

    var token = $('meta[name="csrf-token"]').attr('content')
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    })
    
    $(function () { $('.mask').inputmask(); });

    //Initialize datetime mask
$('input[name="tanggal_barang_return"]').inputmask({ alias: 'datetime', inputFormat: "dd/mm/yyyy" }, { showMaskOnHover: false })

//daterangepicker
$('#date-rangepicker-barang-return').daterangepicker({
    autoUpdateInput: true,
    singleDatePicker: true,
    locale: {
        format: 'DD/MM/YYYY',
        cancelLabel: 'Clear'
    }
});

$('#date-rangepicker-barang-return').on('apply.daterangepicker', function (ev, picker) {

    $('input[name="tanggal_barang_return"]').val(picker.startDate.format(picker.locale.format));
    $('input[name="tanggal_barang_return"]').addClass('has-val');
    if ($('input[name="tanggal_barang_return"]').parent().next()) {
        $(this).parent().next().remove()
    }
});



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

    /*isi dari form mulai dari sini =======================================================================================*/

    console.log(date(tanggal_pengambilan))

    function date(val){
        let date_start = moment(val, 'YYYY-MM-DD', 'id').format("dddd, DD MMMM YYYY")
        return date_start
    }

    if(status == 'Belum diambil'){        
        document.getElementById('wrapper-field').style.display = 'block'; // untuk menampilkan ubah jumlah
        $('#status_div').append(`<input type="radio" onclick="yesnoCheck();" name="status_barang" id="noCheck" value="Belum diambil" checked> &nbsp;Belum diambil <br>`)
        $('#status_div').append(`<input type="radio" onclick="yesnoCheck();" name="status_barang" id="yesCheck" value="Telah Dibawa Sales"> &nbsp;Telah dibawa Sales <br>`)
        $('#status_div').append(` <input type="radio" onclick="yesnoCheck();" name="status_barang" id="selesaiCheck" value="Sudah Selesai"> &nbsp;Sudah Selesai <br>`)
    }else{
        $('#status_div').append(`<input type="radio" onclick="telahDibawaCheck();" name="status_barang" id="yesCheck" value="Telah Dibawa Sales" checked> &nbsp;Telah dibawa Sales <br>`)
        $('#status_div').append(`<input type="radio" onclick="telahDibawaCheck();" name="status_barang" id="selesaiCheck" value="Sudah Selesai"> &nbsp;Sudah Selesai <br>`)
        // untuk append tanggal diambil
        $('#div_status_barang').append(`<div class="form-group">
        <label class="col-sm-3 control-label labalaba" style="padding-top: 60px !important;">
            Tanggal Barang Dibawa Sales* &nbsp;&nbsp;&nbsp;&nbsp; : </label>
        <div class="col-sm-7 labalaba" style="padding-top: 60px !important;">
            <div class="wrap-input100" > 
                    <p>`+ date(tanggal_pengambilan)+`</p>
                    <span class="focus-input100" ></span>
                </div>
            </div>
        </div>`)
        $('#div_status_barang').append(` <br><div class="form-group">
        <label class="col-sm-3 control-label labalaba" style="padding-top: 1px !important;">
            Jumlah Barang Dibawa Sales* &nbsp;&nbsp;&nbsp;&nbsp; : </label>
        <div class="col-sm-7 labalaba" style="padding-top: 1px !important;">
            <div class="wrap-input100" > 
                    <p> `+ jumlahReturnSaatIni+`</p>
                    <span class="focus-input100" ></span>
                </div>
            </div>
        </div>`)
    }

    //touchspin
    $("input#jumlah_barang_tambah").TouchSpin({
        min: 0,
        max: jumlahMax,
        stepinterval: 1,
        maxboostedstep: jumlahMax,
    });

    //touchspin
    $("input#jumlah_barang_kurang").TouchSpin({
        min: 0,
        max: jumlahReturnSaatIni,
        stepinterval: 1,
        maxboostedstep: jumlahReturnSaatIni,
    });


    //dynamic fields
    const add_button = $("#add_button")
    const add1_button = $("#add1_button")
    const remove_button = $('#remove_button')
    const reset_button = $('#cancel')
	if ((typeof activateFields !== 'undefined')) {
		if (activateFields) activateAdditionalField()
    }
    
    if ((typeof activateFields1 !== 'undefined')) {
		if (activateFields1) activateAdditionalField1()
	}
	add_button.click((e) => {
		activateAdditionalField()
    })
    
    add1_button.click((e) => {
		activateAdditionalField1()
    })
    
	remove_button.click((e) => {
        removeAdditionalField()
        
    })
    
    reset_button.click((e) => {
        hideAll()
        
	})
    
    // button remove di tanda tambah
    function activateAdditionalField() {
        add_button.attr('disabled', 'disabled').hide()
        add1_button.attr('disabled', 'disabled').hide()
		$('#after-fields input:nth-child(1)').removeAttr('disabled')
		$('#after-fields-namaPic1').attr('required', true).attr('name', 'namaPic[]')
		$('#after-fields').fadeIn(300)
        remove_button.removeAttr('disabled').fadeIn(300)
        $('#remove_button').on('click', function (e) {
            document.getElementById('jumlah_barang_tambah').value = '0'
        })
      
    }
    
    // button remove di tanda kurang
    function activateAdditionalField1() {
        add1_button.attr('disabled', 'disabled').hide()
        add_button.attr('disabled', 'disabled').hide()
		$('#after-fields1 input:nth-child(1)').removeAttr('disabled')
		$('#after-fields1-namaPic1').attr('required', true).attr('name', 'namaPic[]')
		$('#after-fields1').fadeIn(300)
        remove_button.removeAttr('disabled').fadeIn(300)
        $('#remove_button').on('click', function (e) {
            document.getElementById('jumlah_barang_kurang').value = '0'
        })
        
    }
    

	function removeAdditionalField() {
		remove_button.attr('disabled', 'disabled').hide()
		$('#after-fields input:nth-child(1)').attr('disabled', 'disabled')
		$('#after-fields-namaPic1').attr('required', false).val('').removeAttr('name')
		$('#after-fields-namaPic1').parent().attr('class', 'wrap-input100')
        $('#after-fields').fadeOut(300)
        $('#after-fields1 input:nth-child(1)').attr('disabled', 'disabled')
		$('#after-fields1-namaPic1').attr('required', false).val('').removeAttr('name')
		$('#after-fields1-namaPic1').parent().attr('class', 'wrap-input100')
		$('#after-fields1').fadeOut(300)
        add1_button.removeAttr('disabled').fadeIn(300)
        add_button.removeAttr('disabled').fadeIn(300)
    }
    
    function hideAll(){
        
        remove_button.attr('disabled', 'disabled').hide()
        $('#after-fields input:nth-child(1)').attr('disabled', 'disabled')
        $('#after-fields-namaPic1').attr('required', false).val('').removeAttr('name')
        $('#after-fields-namaPic1').parent().attr('class', 'wrap-input100')
        $('#after-fields').fadeOut(300)
        $('#after-fields1 input:nth-child(1)').attr('disabled', 'disabled')
        $('#after-fields1-namaPic1').attr('required', false).val('').removeAttr('name')
        $('#after-fields1-namaPic1').parent().attr('class', 'wrap-input100')
        $('#after-fields1').fadeOut(300)
        add1_button.removeAttr('disabled').fadeIn(300)
        add_button.removeAttr('disabled').fadeIn(300)
        $('#input_tanggal').remove();
        document.getElementById('div1').style.display = 'none';
    }

   

});

const add_button = $("#add_button")
const add1_button = $("#add1_button")
const remove_button = $('#remove_button')
//hide and show status barang
function yesnoCheck() {
    if (document.getElementById('yesCheck').checked) {
        document.getElementById('div1').style.display = 'block';                
        $('#div_tanggal').append(`<input required
        class="input100 mask @error('tanggal_barang_return') is-invalid @enderror"
        type="text" name="tanggal_barang_return" autocomplete="off" id="input_tanggal"
        spellcheck="false">`);
        // menampilkan tombol ubah jumlah
        add1_button.removeAttr('disabled').fadeIn(300)
        add_button.removeAttr('disabled').fadeIn(300)
    }else if(document.getElementById('selesaiCheck').checked){
        //untuk tanggal ambil barang
        document.getElementById('div1').style.display = 'none';
        $('#input_tanggal').remove();
        // supaya ketika barang telah selesau jumlahnya gabisa diubah
        remove_button.attr('disabled', 'disabled').hide()
		$('#after-fields input:nth-child(1)').attr('disabled', 'disabled')
		$('#after-fields-namaPic1').attr('required', false).val('').removeAttr('name')
		$('#after-fields-namaPic1').parent().attr('class', 'wrap-input100')
        $('#after-fields').fadeOut(300)
        $('#after-fields1 input:nth-child(1)').attr('disabled', 'disabled')
		$('#after-fields1-namaPic1').attr('required', false).val('').removeAttr('name')
		$('#after-fields1-namaPic1').parent().attr('class', 'wrap-input100')
        $('#after-fields1').fadeOut(300)
        add_button.attr('disabled', 'disabled').hide()
        add1_button.attr('disabled', 'disabled').hide()
    }else {
        document.getElementById('div1').style.display = 'none';
        $('#input_tanggal').remove();
        // menampilkan tombol ubah jumlah
        add1_button.removeAttr('disabled').fadeIn(300)
        add_button.removeAttr('disabled').fadeIn(300)
    }
}










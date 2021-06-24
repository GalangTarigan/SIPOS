var token = $('meta[name="csrf-token"]').attr('content')
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
})

    $("#select2_posisi_pegawai").select2({
        width: '100%',
        placeholder: "Pilih status pegawai",
        containerCssClass: 'tpx-select2-container select2-container',
        dropdownCssClass: 'tpx-select2-drop',
        allowClear: true
	});

    
    $("#select2_posisi_pegawai").append('<option value="admin" > Admin </option>')
    $("#select2_posisi_pegawai").append('<option value="kasir"> Kasir </option>')
    $("#select2_posisi_pegawai").append('<option value="default"> Pegawai Biasa </option>')
    

function show(){
	document.getElementById('input_posisi').style.display = 'block';
	document.getElementById('label_posisi').style.display = 'block';
	document.getElementById('bat_button2').style.display = 'block';
	document.getElementById('ed_button2').style.display = 'none';
}

function hide(){
	document.getElementById('input_posisi').style.display = 'none';
	document.getElementById('label_posisi').style.display = 'none';
	document.getElementById('bat_button2').style.display = 'none';
	document.getElementById('ed_button2').style.display = 'block';
	$('#select2_posisi_pegawai').val(null).trigger('change'); // untuk buat null value ketika kita pilih batal edit
}

function hideAll(){

	document.getElementById('input_posisi').style.display = 'none';
	document.getElementById('label_posisi').style.display = 'none';
	document.getElementById('bat_button2').style.display = 'none';
	document.getElementById('ed_button2').style.display = 'block';
	$('#select2_posisi_pegawai').val(null).trigger('change'); // untuk buat null value ketika kita pilih batal edit
}






//Focus input if its has value
$(".input100").each(function() {
    if (
        $(this)
            .val()
            .trim() != ""
    ) {
        $(this).addClass("has-val");
    } else {
        $(this).removeClass("has-val");
    }
});
/*Form==================================================================
   [ Focus input ]*/
$(".input100").each(function() {
    $(this).on("blur", function() {
        if (
            $(this)
                .val()
                .trim() != ""
        ) {
            $(this).addClass("has-val");
        } else {
            $(this).removeClass("has-val");
        }
    });
});
//Remove error message after server validation if input has changed
$(".input100").each(function() {
    //If focused on particular input, then remove its parent next element
    $(this).on("focus", function() {
        if (
            $(this)
                .parent()
                .next()
        ) {
            $(this)
                .parent()
                .next()
                .remove();
        }
    });
});

$(function() {
    //ajax upload image profile
    var progress = $("#progress");
    var bar = $("#progress-bar");
    var percentage = $(".progress-percentage");
    $('input[name="image"]').change(function() {
        if (this.files[0].size > 1024 * 1024 * 3) {
            Swal.fire(
                'Error!',
                'Ukuran File Terlalu Besar, Maks. 3MB',
                'error'
            )
            return
        } else {
            $("#image-form").submit();
        }
    });
    $("#image-form").ajaxForm({
        beforeSend: function() {
            $(".contextual-progress").show(300);
            percentage.text('')
            progress.addClass("progress-striped active");
            bar.removeClass(
                "progress-bar-success progress-bar-danger"
            ).addClass("progress-bar-primary");
        },
        uploadProgress: (event, position, total, percentComplete) => {
            percentage.text("Uploading " + percentComplete + "%");
            bar.css("width", percentComplete + "%");
        },
        success: (data) => {
            if (data.errors) {
                alert(data.errors);
                percentage.text("Failed");
                progress.removeClass("progress-striped active");
                bar.removeClass("progress-bar-primary").addClass(
                    "progress-bar-danger"
                );
                bar.css("width", "100%");
                $(".contextual-progress").fadeOut(300);
            }
            if (data.success) {
                percentage.text("Uploaded");
                progress.removeClass("progress-striped active");
                bar.removeClass("progress-bar-primary").addClass(
                    "progress-bar-success"
                );
                bar.css("width", "100%");
                $(".contextual-progress").fadeOut("slow");
                window.location.reload();
            }
        },
        error: (err) => {
            percentage.text(`Failed, ${err.statusText}`);
            progress.removeClass("progress-striped active");
            bar.removeClass("progress-bar-primary").addClass(
                "progress-bar-danger"
            );
            bar.css("width", "100%");
            $(".contextual-progress").fadeOut(1000);
        }
    });
});

function imagesOldPic(dokumentasi) {			
	// alert('berhasil')			
	  window.open('/admin/akun/profile/get-foto/?filename=' + dokumentasi);
}

function imagesPicNull(dokumentasi) {			
	// alert('berhasil')			
	  window.open('/admin/akun/profile/get-foto/?filename=' + dokumentasi);
}


$(function () {
    //ajax upload image profile  
    var progress = $('#progress')
    var bar = $('#progress-bar')
    var percentage = $('.progress-percentage')
    if (window.File && window.FileList && window.FileReader) {
        $('input[name="image"]').change(function (e) {
            var files = e.target.files
            if(files.length > 0){
                if (this.files[0].size > 1024 * 1024 * 3) {
                    Swal.fire(
                        'Error!',
                        'Ukuran File Terlalu Besar, Maks. 3MB',
                        'error'
                    )
                } else {
                    $('#image-form').submit()
                }
            }
        })
    } else {
        Swal.fire(
            'Error!',
            'Browser anda tidak support File API',
            'error'
        )
    }
    $('#image-form').ajaxForm({
        beforeSend: function () {
            $('.contextual-progress').show(300)
            progress.addClass("progress-striped active")
            bar.removeClass('progress-bar-success progress-bar-danger').addClass('progress-bar-primary')
        },
        uploadProgress: function (event, position, total, percentComplete) {
            percentage.text('Uploading ' + percentComplete + '%')
            bar.css('width', percentComplete + '%')
        },
        success: function (data) {
            if (data.errors) {
                alert(data.errors)
                percentage.text('Failed')
                progress.removeClass('progress-striped active')
                bar.removeClass('progress-bar-primary').addClass('progress-bar-danger')
                bar.css('width', '100%')
                $('.contextual-progress').fadeOut(300)
            }
            if (data.success) {
                percentage.text('Uploaded');
                progress.removeClass('progress-striped active')
                bar.removeClass('progress-bar-primary').addClass('progress-bar-success')
                bar.css('width', '100%')
                $('.contextual-progress').fadeOut('slow')
                window.location.reload(true)
            }
        },
        error: function (err){
            //window.location.reload()
            Swal.fire(
                'Error!',
                err.statusText,
                'error'
            ).then((result) => {
                if(result.dismiss || result.value){
                    window.location.reload()
                }
            })
        }
    });
});

function imagesOldPic(dokumentasi) {			
	// alert('berhasil')			
	  window.open('/kasir/akun/profile/get-foto/?filename=' + dokumentasi);
}

function imagesPicNull(dokumentasi) {			
	// alert('berhasil')			
	window.open('/kasir/akun/profile/get-foto/?filename=' + dokumentasi);
}

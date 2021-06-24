var token = $('meta[name="csrf-token"]').attr('content')
$( document ).ready(function() {

    //Focus input if its has value
    $('.input100').each(function () {
        if ($(this).val().trim() != "") {
            $(this).addClass('has-val');
        }else {
            $(this).removeClass('has-val');
        }
    })


    

});

function render(dokumentasi) {
    var hostname = window.location.origin;
    $('<a onclick="imageNewTab(\''+dokumentasi+'\')"><div class="img" id="img" style="background-image: url('+ hostname+'/dokumentasi/foto/get-foto/' + dokumentasi + ');"><span></span></div></a>')
    .insertBefore($(".images_prev .pic"))
}

function imagesNewTab(dokumentasi) {
    window.open('/dokumentasi/tagihan/get-foto/' + dokumentasi)
}
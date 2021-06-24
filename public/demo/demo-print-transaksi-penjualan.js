
$( document ).ready(function() {
    
    $(function () {
        var data = [], data2 = []
    $.each(dataPelanggan, function (key, val) {
        switch (key) {
            case 'no_invoice': data['invoice'] = '<tr><th class="width10"></th><th class="width15">Nomor Invoice</th><th class="width2">:</th><td>' + val + '</td></tr>'
                break
            case 'nama_pelanggan': data['nama'] = '<tr><th class="width10"></th><th>Nama Pelanggan</th><th>:</th><td>' + capital_letter(val) + '</td></tr>'
                break
            case 'alamat_pembeli': data['alamat'] = '<tr><th class="width10"></th><th>Alamat Pembeli</th><th>:</th><td>' + capital_letter(val) + '</td></tr>'
                break
            case 'tanggal_pembelian': 
            let date_start = moment(val, 'YYYY-MM-DD', 'id').format("dddd, DD MMMM YYYY")
            data['tanggal_beli'] = '<tr><th class="width10"></th><th>Tanggal Pembelian</th><th>:</th><td>' + date_start + '</td></tr>'
                break
            case 'nama_lengkap': data['nama_kasir'] = '<tr><th class="width10"></th><th>Kasir Melayani</th><th>:</th><td>' + val + '</td></tr>'
                break
            case 'no_telepon_pembeli': data['no_telepon'] = '<tr><th class="width10"></th><th>Nomor Hp</th><th>:</th><td>' + val + '</td></tr>'
                break
            }
        })
        renderTb1(data)
        data2['daftarBarang'] = renderPembelianBarang(dataBarangBeli)
        renderTb2(data2)
    })

    function renderTb1(data) {
        $('.tb1').append(data.nama_kasir)
        $('.tb1').append(data.invoice)  
        $('.tb1').append(data.tanggal_beli)
        $('.tb1').append(data.nama)
        $('.tb1').append(data.alamat)
        $('.tb1').append(data.no_telepon)
    }
    function renderTb2(data){
        $('.tb2').append(data.daftarBarang)
    }

    // $('.tb1').append(
    //     '<tr><td class="width5" scope="col">galang</td><td>tampan</td><td>sekali</td><td>anjay</td></tr>'
    // );
    
    console.log(dataPelanggan)
    console.log(dataBarangBeli)

    function renderPembelianBarang(dataBarangBeli) {
        var result = ''
            $.each(dataBarangBeli, function (key, val) {
                    result += '<tr><td style="text-align:center;" scope="row">'+(key+1)+'</td><td style="text-align:center;">'+val.kategori_barang+'</td><td style="text-align:center;">'+val.merk_barang_beli+'</td><td style="text-align:center;">'+val.tipe_barang_beli+'</td><td style="text-align:center;">'+val.harga_barang_beli+'</td><td style="text-align:center;">'+val.jumlah_barang_beli+'</td><td style="text-align:center;">'+val.total_harga+'</td>  </tr>'
            })
            return result
        
    }


    function capital_letter(str) {
        str = str.toLowerCase()
        str = str.split(" ");
    
        for (let i = 0, x = str.length; i < x; i++) {
            str[i] = str[i][0].toUpperCase() + str[i].substr(1);
        }
    
        return str.join(" ");
    }
    
});



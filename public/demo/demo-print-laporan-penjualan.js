
$( document ).ready(function() {
    
    $(function () {
        var data = [], data2 = [], data3=[]
        
        renderTb1(data)
        data2['dataPenjualan'] = renderPembelianBarang(data)
        renderTb2(data2)
        renderTb3(data3)
    })

    function renderTb1() {
        $('.tb1').append('<tr><th class="width10"></th><th class="width15">Tanggal Mulai</th><th class="width2">:</th><td>' + mulai + '</td></tr>')
        $('.tb1').append('<tr><th class="width10"></th><th class="width15">Sampai Tanggal</th><th class="width2">:</th><td>' + selesai + '</td></tr>')
    }
    function renderTb2(data){
        $('.tb2').append(data.dataPenjualan)
    }

    function renderTb3(){
        $('.tb3').append('<tr><th class="width5"></th><th class="width10"></th><th class="width10"></th><th class="width15" style="text-align:center;"></th><th class="width15" style="text-align:center;">Total</th><th class="width10"style="text-align:center;">Rp.'+totalBeli+'</th><th class="width10" style="text-align:center;" >Rp.'+totalModal+'</th><th class="width10" style="text-align:center;">Rp.' + totalLaba + '</th></tr>')
        
    }
    
     console.log(data)



    function renderPembelianBarang(dataBarangBeli) {
        var result = ''
        $.each(data, function (key, val) {            
                    result += '<tr><td style="text-align:center;" scope="row">'+(key+1)+'</td><td style="text-align:center;">'+val.nama_lengkap+'</td><td style="text-align:center;">'+val.no_invoice+'</td><td style="text-align:center;">'+ date(val.tanggal_pembelian) +'</td><td style="text-align:center;">'+val.nama_pelanggan+'</td><td style="text-align:center;">'+val.total_pembelian+'</td><td style="text-align:center;">'+val.modal_barang_beli+'</td><td style="text-align:center;">'+ val.laba+'</td>  </tr>'
            })
                        
            return result
            
        }
        
    
    function date(val){
        let date_start = moment(val, 'YYYY-MM-DD', 'id').format("dddd, DD MMMM YYYY")
        return date_start
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



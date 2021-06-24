
$( document ).ready(function() {
    
    $(function () {
        var data = [], data2 = [], data3=[]
        
        renderTb1(data)
        data2['dataRender'] = renderDataPengeluaran(dataTransaksi)
        renderTb2(data2)
        renderTb3(data3)
    })

    function renderTb1() {
        $('.tb1').append('<tr><th class="width5"></th><th class="width15">Laporan Bulan</th><th class="width2">:</th><td>' + namaBulanLengkap +'</td></tr>')
        $('.tb1').append('<tr><th class="width5"></th><th class="width15">Laporan Tahun</th><th class="width2">:</th><td>' + tahun +'</td></tr>')
    }
    function renderTb2(data){
        $('.tb2').append(data.dataRender)
    }

    function renderTb3(){
        // $('.tb3').append('<tr><th class="width5"></th><th class="width12"></th><th class="width16"></th><th class="width12"></th><th class="width10"></th></tr>')

        $('.tb3').append('<tr><th class="width5"></th><th class="width12"></th><th class="width16" style="text-align:center;">Total</th><th class="width12" style="text-align:center;">'+ total_modal +'</th><th class="width10" style="text-align:center;">'+ total_pemasukan +'</th></tr>')
        
    }
        
    function renderDataPengeluaran(dataTransaksi) {
        var result = ''
        $.each(dataTransaksi, function (key, val) {            
            result += '<tr><td style="text-align:center;" scope="row">'+(key+1)+'</td><td style="text-align:center;">'+date(val.tanggal_transaksi_laba_rugi)+'</td><td style="text-align:center;">'+ capital_letter(val.keterangan)+'</td><td style="text-align:center;">'+ val.biaya_modal +'</td><td style="text-align:center;">'+val.pendapatan+'</td>'
            })
                        
            return result
            
        }
        
    
    function date(val){
        let date_start = moment(val, 'YYYY-MM-DD', 'id').format("DD MMMM YYYY")
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



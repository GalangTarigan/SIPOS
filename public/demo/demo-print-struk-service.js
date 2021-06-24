
$( document ).ready(function() {
    
    $(function () {
        var data = [], data2 = []
        
        renderTb1(data)
        data2['dataRender'] = renderDataPengeluaran(dataTable)
        renderTb2(data2)
    })

    function renderTb1() {
        $.each(dataTable, function (key, val) {

        $('.tb1').append('<tr><th class="width14"></th><th class="width15">Tanggal</th><th class="width2">:</th><td>' + date(val.created_at) +'</td></tr>')
        $('.tb1').append('<tr><th class="width14"></th><th class="width15">Nama Pelanggan</th><th class="width2">:</th><td>' + val.nama_pelanggan +'</td></tr>')
        $('.tb1').append('<tr><th class="width14"></th><th class="width15">Nomor Hp</th><th class="width2">:</th><td>' + val.no_telepon +'</td></tr>')
         })  
    }
    function renderTb2(data2){
        $('.tb2').append(data2.dataRender)
    }

        
    function renderDataPengeluaran(dataTable) {
        var result = ''
        $.each(dataTable, function (key, val) {            
            result += '<tr><td style="text-align:center;" scope="row">'+(key+1)+'</td><td style="text-align:center;">'+ capital_letter(val.jenis_barang) +'</td><td style="text-align:center;">'+ capital_letter(val.permasalahan)+'</td><td style="text-align:center;">'+ capital_letter(val.kelengkapan) +'</td><td style="text-align:center;">'+ val.status_barang+'</td>'
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



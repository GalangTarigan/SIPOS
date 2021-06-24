$(function(){
    //selectors
    var all_notif_selector = $('#all-notif')
    var unread_selector = $('#unread')
    const notifications_type= {
        newReport: 'App\\Notifications\\reportCreated',
        newTReport : 'App\\Notifications\\trainingReportCreated',
        newCReport : 'App\\Notifications\\complaintReportCreated'
    };
    //assigning unread messages to new array
    var unread_notifications = []
    $.each(all_notifications, function(index, value){
        if(value.read_at == null) unread_notifications.push(value)
    })

    //define function to calculate time differences between now and given date
    function diffDates(date){
        const now = moment()
        const expiration = moment(date, 'YYYY-MM-DD HH:mm:ss')

        // get the difference between the moments
        const diff = now.diff(expiration);

        //express as a duration
        const diffDuration = moment.duration(diff);

        // display
        if(diffDuration.days()>7){
            return moment(date).format('D MMMM YYYY')
        }else if(diffDuration.days() <7 && diffDuration.days() >= 1){
            return diffDuration.days() +' days '+ diffDuration.hours() +' hours ago'
        }else if(diffDuration.days() < 1 && diffDuration.hours() != 0){
            return diffDuration.hours()+ ' hours '+ diffDuration.minutes() + ' minutes ago'
        }else if(diffDuration.hours() < 1){
            return diffDuration.minutes()+ ' minutes ago'
        }
    }

    //define function to set html contents inside notif-content wrapper
    function contents(content){
        console.log(content)
        var html = ''
        $.each(content, function(index, value){
            if(value.type == notifications_type.newReport){
                if(value.read_at == null){
                    var to = '&read=' + value.id
                    var id_laporan = value.data['id_laporan'] + to
                    html+= '<li class="li-notif"><a class="notif-info" href="/admin/daftar-proyek-instalasi/detail-proyek?laporan='+id_laporan+'"><div class="notif-icon"><i class="fas fa-file-signature"></i></div><div class="notif-content">'+value.data['user_name']+' membuat laporan instalasi '+'<strong>'+value.data['nama_instansi']+'</strong>'+'</div><div class="notif-time">'+diffDates(value.created_at)+'</div></a></li>'
                }else{
                    var id = value.data['id_laporan']
                    html+= '<li class="li-notif"><a class="notif-info" href="/admin/daftar-proyek-instalasi/detail-proyek?laporan='+id+'"><div class="notif-icon"><i class="fas fa-file-signature"></i></div><div class="notif-content">'+value.data['user_name']+' membuat laporan instalasi '+'<strong>'+value.data['nama_instansi']+'</strong>'+'</div><div class="notif-time">'+diffDates(value.created_at)+'</div></a></li>'
                }
               
            }else if(value.type == notifications_type.newTReport){
                if(value.read_at == null){
                    var to = '&read=' + value.id
                    var id_laporan = value.data['id_laporan'] + to
                    html+= '<li class="li-notif"><a class="notif-success" href="/admin/daftar-proyek-instalasi/detail-proyek?laporan='+id_laporan+'"><div class="notif-icon"><i class="fa fa-chalkboard-teacher"></i></div><div class="notif-content">'+value.data['user_name']+' membuat laporan training '+'<strong>'+value.data['nama_instansi']+'</strong></div><div class="notif-time">'+diffDates(value.created_at)+'</div></a></li>'
                }else{
                    var id = value.data['id_laporan']
                    html+= '<li class="li-notif"><a class="notif-success" href="/admin/daftar-proyek-instalasi/detail-proyek?laporan='+id+'"><div class="notif-icon"><i class="fa fa-chalkboard-teacher"></i></div><div class="notif-content">'+value.data['user_name']+' membuat laporan training '+'<strong>'+value.data['nama_instansi']+'</strong></div><div class="notif-time">'+diffDates(value.created_at)+'</div></a></li>'
                }
            }else if(value.type == notifications_type.newCReport){
                if(value.read_at == null){
                    var to = '&read=' + value.id
                    var id_laporan = value.data['id_laporan'] + to
                    html+= '<li class="li-notif"><a class="notif-primary" href="/admin/keluhan/detail-keluhan?keluhan='+id_laporan+'"><div class="notif-icon"><i class="fab fa-teamspeak"></i></div><div class="notif-content">'+value.data['user_name']+' membuat laporan keluhan instansi '+'<strong>'+value.data['nama_instansi']+'</strong></div><div class="notif-time">'+diffDates(value.created_at)+'</div></a></li>'
                }else{
                    var id = value.data['id_laporan']
                    html+= '<li class="li-notif"><a class="notif-primary" href="/admin/keluhan/detail-keluhan?keluhan='+id+'"><div class="notif-icon"><i class="fab fa-teamspeak"></i></div><div class="notif-content">'+value.data['user_name']+' membuat laporan keluhan instansi '+'<strong>'+value.data['nama_instansi']+'</strong></div><div class="notif-time">'+diffDates(value.created_at)+'</div></a></li>'
                }
            }
        })
        return html
    }
        

    //define a function to change the content
    function changeElementContent (){
        $('#unread-count').html(unread_notifications.length)
        $('#all-msg-count').html(all_notifications.length)
        if(all_notif_selector.hasClass('active')){    
            $('#notif-heading').html('Semua Notifikasi')
            $('#notif-wrapper').html(contents(all_notifications))
        }else if(unread_selector.hasClass('active')){
            $('#notif-heading').html('Belum Terbaca')
            $('#notif-wrapper').html(contents(unread_notifications))
        }
    }
    //call function changeContent()
    changeElementContent()

    //event when selectors clicked
    all_notif_selector.click( function(e){
        unread_selector.removeClass('active')
        $(this).addClass('active')
        changeElementContent()
    })
    unread_selector.click(function(e){
        all_notif_selector.removeClass('active')
        $(this).addClass('active')
        changeElementContent()
    })
})
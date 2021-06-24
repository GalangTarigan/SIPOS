var notifications = []
var notificationCountElem = $(".notif-count")
var notificationCount = 0
const NOTIFICATION_TYPES = {
    newReport: 'App\\Notifications\\reportCreated',
    newTReport : 'App\\Notifications\\trainingReportCreated',
    newCReport: 'App\\Notifications\\complaintReportCreated'
};


$(function() {
    // check if there's a logged in user
    //console.log(Laravel.userId)
        $.get('/unreadNotifications', function (data) {
            addNotifications(data.msg, data.len, "#notificationsWrapper");
        });  
        
       window.Echo.private('App.User.' + Laravel.userId)
        .notification((notification) => {
            addNotifications([notification], [notification].length,"#notificationsWrapper");  
        }); 

});
function addNotifications(newNotifications, len, target) {
    var incomingNotif = len
    notifications = _.concat(newNotifications, notifications);
    // show only last 5 notifications
    notifications.slice(0, 10);
    showNotifications(notifications, target, incomingNotif)
}

function showNotifications(notifications, target, incomingNotif) {
    if(notifications.length) {
        $(".no-msg").remove()
        var htmlElements = notifications.map(function (notification) {
            return makeNotification(notification);
        });
        $(target).html(htmlElements.join(''));
        if(incomingNotif <= 10) {
            notificationCount+= incomingNotif
        }else{
            notificationCount='10+'
        }
        notificationCountElem.html(notificationCount)
    } else {
        $(target).parent().append('<div class="text-center pt50"><span>Tidak ada pesan yang belum terbaca</span></div>');
        $(target).removeClass('has-notifications');
    }
}

// Make a single notification string
function makeNotification(notification) {
    var to = routeNotification(notification);
    var notificationText = makeNotificationText(notification);
    if(notification.type === NOTIFICATION_TYPES.newReport) {
        return '<li><a class="notification-info" href="' + to + '">' + notificationText + '</a></li>';
    }else if(notification.type === NOTIFICATION_TYPES.newTReport){
        return '<li><a class="notification-success" href="' + to + '">' + notificationText + '</a></li>';
    }else if(notification.type === NOTIFICATION_TYPES.newCReport){
        return '<li><a class="notification-primary" href="' + to + '">' + notificationText + '</a></li>';
    }
}

// get the notification route based on it's type
function routeNotification(notification) {
    var to = '&read=' + notification.id;
    if(notification.type === NOTIFICATION_TYPES.newReport) {
        var id_laporan = notification.data.id_laporan
        to = `daftar-proyek-instalasi/detail-proyek?laporan=${id_laporan}` + to;
    }else if(notification.type === NOTIFICATION_TYPES.newTReport){
        var id_laporan = notification.data.id_laporan
        to = `daftar-proyek-instalasi/detail-proyek?laporan=${id_laporan}` + to;
    }else if(notification.type === NOTIFICATION_TYPES.newCReport){
        var id_laporan = notification.data.id_laporan
        to = `keluhan/detail-keluhan?keluhan=${id_laporan}`+ to;
    }
    return '/'+ to;
}

// get the notification text based on it's type
function makeNotificationText(notification) {
    var text = '';
    if(notification.type === NOTIFICATION_TYPES.newReport) {
        var instansi = notification.data.nama_instansi
        text += '<div class="notification-icon"><i class="fas fa-file-signature"></i></div><div class="notification-content">Laporan instalasi '+'<strong>'+instansi+'</strong> berhasil dibuat </div><div class="notification-time">'+diffDates(notification.created_at)+'</div>'
    }else if(notification.type === NOTIFICATION_TYPES.newTReport){
        var instansi = notification.data.nama_instansi
        text += '<div class="notification-icon"><i class="fas fa-chalkboard-teacher"></i></div><div class="notification-content">Laporan training '+'<strong>'+instansi+'</strong> berhasil dibuat </div><div class="notification-time">'+diffDates(notification.created_at)+'</div>'
    }else if(notification.type === NOTIFICATION_TYPES.newCReport){
        var instansi = notification.data.nama_instansi
        text += '<div class="notification-icon"><i class="fab fa-teamspeak"></i></div><div class="notification-content">Laporan keluhan '+'<strong>'+instansi+'</strong> berhasil dibuat </div><div class="notification-time">'+diffDates(notification.created_at)+'</div>'
    }
    return text;
};

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
    }else if(diffDuration.hours() < 1 && diffDuration.minutes() != 0){
        return diffDuration.minutes()+ ' minutes ago'
    }else{
        return 'just now'
    }
}



<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use App\User;
use App\Model\Laporan_Keluhan;
use App\Model\Instansi;

class complaintReportCreated extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    protected $user, $laporan_keluhan;
    public function __construct(User $user,Laporan_Keluhan $laporan_keluhan)
    {
        $this->user = $user;
        $this->laporan_keluhan = $laporan_keluhan;
    }
    /**
     * Get instansi name
     *
     * @return string
     */
    public function instansiName($id_instansi){
       return Instansi::find($id_instansi)->nama_instansi;
    }
    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database', 'broadcast'];
    }

    
    public function toDatabase($notifiable)
    {
        return [
            'user_id' => $this->user->id,
            'user_name' => $this->user->nama_lengkap,
            'id_laporan' => $this->laporan_keluhan->uuid,
            'nama_instansi' => $this->instansiName($this->laporan_keluhan->instansi_id)
        ];
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'id' => $this->id,
            'read_at' => null,
            'data' => [
                'user_id' => $this->user->id,
                'user_name' => $this->user->nama_lengkap,
                'id_laporan' => $this->laporan_keluhan->uuid,
                'nama_instansi' => $this->instansiName($this->laporan_keluhan->instansi_id)
            ]
        ];
    }
}

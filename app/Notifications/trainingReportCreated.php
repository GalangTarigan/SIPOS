<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use App\Model\Laporan_Instalasi;
use App\Model\Laporan_Training;
use App\User;

class trainingReportCreated extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    protected $user, $laporan_training, $laporan_instalasi;
    public function __construct(User $user,Laporan_Training $laporan_training)
    {
        $this->user = $user;
        $this->laporan_t = $laporan_training;
        $this->laporan_instalasi = Laporan_Training::find($laporan_training->id_laporan_training)->laporan_instalasi;
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
            'user_id' => $this->laporan_instalasi->user_id,
            'user_name' => $this->user->nama_lengkap,
            'id_laporan' => $this->laporan_instalasi->uuid,
            'nama_instansi'=>$this->laporan_instalasi->instansi()->value('nama_instansi')
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
                'user_id' => $this->laporan_instalasi->user_id,
                'user_name' => $this->user->nama_lengkap,
                'id_laporan' => $this->laporan_instalasi->uuid,
                'nama_instansi'=>$this->laporan_instalasi->instansi()->value('nama_instansi')
            ]
        ];
    }
}

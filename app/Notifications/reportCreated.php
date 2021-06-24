<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use App\Model\Laporan_Instalasi;
use App\User;

class reportCreated extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    protected $user, $laporan;
    public function __construct(User $user,Laporan_Instalasi $laporan)
    {
        $this->user = $user;
        $this->laporan = $laporan;
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
    public function namaInstansi($id_laporan){
        $instansi = Laporan_Instalasi::find($id_laporan)->instansi()->value('nama_instansi');
        return $instansi;
    }


    public function toDatabase($notifiable)
    {
        return [
            'user_id' => $this->laporan->user_id,
            'user_name' => $this->user->nama_lengkap,
            'id_laporan' => $this->laporan->uuid,
            'nama_instansi'=>$this->namaInstansi($this->laporan->id_laporan)
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
                'user_id' => $this->laporan->user_id,
                'user_name' => $this->user->nama_lengkap,
                'id_laporan' => $this->laporan->id_laporan,
                'nama_instansi'=>$this->namaInstansi($this->laporan->id_laporan)
            ]
        ];
    }
}

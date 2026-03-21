<?php

namespace App\Notifications;

use App\Models\Activity;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ActivityCreatedNotification extends Notification
{
    use Queueable;

    public function __construct(private readonly Activity $activity) {}

    public function via(object $notifiable): array
    {
        return ['database', 'mail'];
    }

    public function toDatabase(object $notifiable): array
    {
        return [
            'activity_id'    => $this->activity->id,
            'activity_title' => $this->activity->title,
            'project_name'   => $this->activity->project?->name,
            'message'        => "Atividade \"{$this->activity->title}\" registrada com sucesso.",
        ];
    }

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Nova atividade registrada')
            ->greeting("Olá, {$notifiable->name}!")
            ->line("A atividade **\"{$this->activity->title}\"** foi registrada com sucesso.")
            ->when(
                $this->activity->project,
                fn ($mail) => $mail->line("Projeto: **{$this->activity->project->name}**")
            )
            ->line('Acesse o TimeTracker para ver os detalhes.');
    }
}

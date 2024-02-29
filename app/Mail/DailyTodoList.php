<?php

namespace App\Mail;

use App\Models\task;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class DailyTodoList extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    private $user;
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Daily Todo List',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'emails.daily_task_summary',
        );
    }
    public function build()
    {
  $tasks = getTasks($this->user->id);

    $count = getCount($tasks);
    getFormetedDuedate($count['todayTasksCount']);

        return $this->markdown('emails.daily_task_summary')
        ->with([
            'completedTasksCount' => $count['completedTasksCount'],
            'todayTasksCount' => $count['todayTasksCount'],
            'overdueTasksCount' => $count['overdueTasksCount']
        ])
                    ->subject('Your Daily Task Summary')
                    ->from('taskorganizo@gmail.com', 'TaskOrganizo');
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}

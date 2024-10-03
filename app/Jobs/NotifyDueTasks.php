<?php
namespace App\Jobs;

use App\Models\KanbanTask;
use App\Models\KanbanTaskUsers;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class NotifyDueTasks implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function handle()
    {
        Log::info('NotifyDueTasks job çalıştırıldı.');
        
        $tasks = KanbanTask::where('due_date', '>=', Carbon::now())
            ->where('due_date', '<=', Carbon::now()->addDays(3))
            ->get();
        
        foreach ($tasks as $task) {
            $userIds = KanbanTaskUsers::where('task_id', $task->id)->pluck('user_id');
            $users = User::whereIn('id', $userIds)->get();

            foreach ($users as $user) {
                $now = Carbon::now();
                $dueDate = Carbon::parse($task->due_date);

                $remainingDays = (int) $now->diffInDays($dueDate); // gün
                $remainingHours = $now->diffInHours($dueDate) % 24; // saat
                $remainingMinutes = $now->diffInMinutes($dueDate) % 60; // dakika

                Log::info("Kalan gün: $remainingDays, Kalan saat: $remainingHours, Kalan dakika: $remainingMinutes");

                $message = "{$task->name} İsimli taskınızın son tarihine ";
                
                if ($remainingDays > 1) {
                    $message .= "3 günden az kaldı!";
                } elseif ($remainingDays == 1) {
                    $message .= "1 gün kaldı!";
                } else {
                    $message .= "1 günden az kaldı! ($remainingHours Saat, $remainingMinutes Dakika)";
                }

                $notificationData = [
                    'type' => 'App\Notifications\TaskDueSoonNotification',
                    'notifiable_type' => 'App\Models\User',
                    'notifiable_id' => $user->id,
                    'data' => json_encode([
                        'message' => $message,
                        'due_date' => $task->due_date,
                    ]),
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ];

                DB::table('notifications')->insert($notificationData);
            }
        }
    }
}

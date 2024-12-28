<?php

namespace App\Console\Commands;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Console\Command;

class SubscripeCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:subscripe-command';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $users = User::where('type', 'user')->get(); // الحصول على كل المستخدمين من قاعدة البيانات

        foreach ($users as $user) {
            if ($user->date_subscribe) {
                $date_subscribed = Carbon::parse($user->date_subscribe);
                $date_end_subscribe = $date_subscribed->copy()->addMonth();
                $day = Carbon::now();
                $today = $day->translatedFormat('y:m:d');
                // dd($date_end_subscribe==$today);
                if ($date_end_subscribe == $today) {
                    $data = [
                        'subscription_fees' => null,
                        'date_subscribe' => null,
                    ];
                    // قد مر شهر واحد على الاشتراك، قم بتصفير عمود subscription_fees
                    $user->update($data);
                    echo "كلوو تمام";
                    // يمكنك أيضًا تنفيذ الإجراءات الإضافية التي ترغب في تنفيذها عند تصفير الرسوم
                }
            }
        }
    }
}

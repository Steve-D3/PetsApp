<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class TestEmailCommand extends Command
{
    protected $signature = 'mail:test';
    protected $description = 'Test email sending';

    public function handle()
    {
        $user = User::first();

        if (!$user) {
            $this->error('No users found in the database.');
            return;
        }

        try {
            Mail::raw('Test email content', function ($message) use ($user) {
                $message->to($user->email)
                    ->subject('Test Email');
            });
            $this->info('Test email sent to ' . $user->email);
        } catch (\Exception $e) {
            $this->error('Failed to send email: ' . $e->getMessage());
        }
    }
}

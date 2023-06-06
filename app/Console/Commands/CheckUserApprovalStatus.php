<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Member;
use Illuminate\Support\Facades\Mail;

class CheckUserApprovalStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'approval:check';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check all users in the database, if user is approved, 
                                check if they have received a approved-email yet, if not, send one';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // Retrieve members who have the approved status as 1 and have not received the approval email
        $members = Member::where('approved', 1)
            ->where('approved_email_sent', 0)
            ->get();
    
        foreach ($members as $member) {
            $data = [
                'email' => $member->email,
                'firstname' => $member->firstname,
            ];

            // Send the approval email to the member
            Mail::send('mail.approved-mail', $data, function ($message) use ($member) {
                $message->to($member->email)
                    ->subject('Bedankt voor uw registratie, ' . $member->firstname . '.');
            });
    
            // Update the member's approved_email_sent status to 1
            $member->update([
                'approved_email_sent' => 1,
            ]);
        }
    
        $this->info('Approval emails sent successfully.');
    
        return 0;
    }
}

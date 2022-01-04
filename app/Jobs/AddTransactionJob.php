<?php

namespace App\Jobs;

use App\Models\Assignment;
use App\Models\Transaction;
use App\Models\TransactionType;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class AddTransactionJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $assignment;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Assignment $assignment)
    {
        $this->assignment = $assignment;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Transaction::create([
            'transaction_type_id' => TransactionType::ADDED,
            'user_id' => $this->assignment->user_id,
            'project_id' => $this->assignment->project_id
        ]);
    }
}

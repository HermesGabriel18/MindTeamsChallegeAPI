<?php

namespace App\Console\Commands;

use App\Services\ConstantsService;
use Illuminate\Console\Command;

class ConstantSeederCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'db:seed_constants';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Seed all constants tables';

    /**
     * @var ConstantsService
     */
    private ConstantsService $constantsService;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(ConstantsService $constantsService)
    {
        parent::__construct();
        $this->constantsService = $constantsService;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->comment("Seeding: Constants models");

        $total = $this->constantsService->seed();

        $this->info("Seeded: $total Constant Models");
        
        return 0;
    }
}

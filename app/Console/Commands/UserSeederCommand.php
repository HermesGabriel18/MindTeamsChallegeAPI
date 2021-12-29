<?php

namespace App\Console\Commands;

use App\Models\Role;
use App\Models\User;
use Illuminate\Console\Command;

class UserSeederCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'db:seed_users';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Seed initial users.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->comment('Seeding: Admin users.');

        $super_admin = User::make([
            'role_id' => Role::SUPER_ADMIN,
            'name' => 'super admin',
            'email' => 'super_admin@mindteams.com',
            'password' => 'Secret123**',
            'locale' => 'en'
        ]);

        $users = collect([$super_admin]);

        $users->each(function (User $user) {
            $user->forceFill([
                'email_verified_at' => now()
            ])->save();
        });

        $this->info("Seeded: {$users->count()} Admin users.");

        return 0;
    }
}

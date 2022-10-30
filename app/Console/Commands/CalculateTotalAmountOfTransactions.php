<?php

namespace App\Console\Commands;

use App\Models\Wallet;
use Illuminate\Console\Command;

class CalculateTotalAmountOfTransactions extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'total:amount';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'calculate total amount of transactions and print it on terminal';

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
        $totalAmount = Wallet::query()->sum('amount');
        $this->info("Total amount of transactions is: " . $totalAmount);
    }
}

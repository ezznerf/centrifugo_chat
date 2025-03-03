<?php

namespace App\Console\Commands;

use App\Extensions\RabbitMq\RabbitMq;
use Exception;
use Illuminate\Console\Command;

class RabbitMqInitCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'rabbitmq:init';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'RabbitMQ init queues ...';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        try {
            RabbitMq::init();
            $this->info('✅ RabbitMQ infrastructure initialized successfully!');
        }catch (Exception $exception){
            $this->error('❌ Error: ' . $exception->getMessage());
        }
    }
}

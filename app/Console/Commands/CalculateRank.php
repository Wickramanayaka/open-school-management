<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Events\ExamMarkUpdate;
use App\Exam;
use App\ClassRoom;

class CalculateRank extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'bluesmart:rank';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Calculate Rank Manually';

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
     * @return mixed
     */
    public function handle()
    {
        $this->info('');
        $this->info('Calculate Rank Manual');
        $exam_id = $this->ask('What is the exam ID?');
        $class_room_id = $this->ask('What is the class room ID?');
        $exam = Exam::findOrFail($exam_id);
        $class_room = ClassRoom::findOrFail($class_room_id);
        if($exam->has_rank){
            event(new ExamMarkUpdate($exam,$class_room));
            $this->info('The rank has been calculated manually.');
        }
        else{
            $this->error('The exam has no rank enabled');
        }
    }
}

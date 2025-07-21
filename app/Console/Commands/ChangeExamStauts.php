<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Exam;

class ChangeExamStauts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'bluesmart:exam';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Change exam statuses according to the start and end ate with current date.';

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
        // Update all exam statuses every day
        $this->info('The exam status update process has began...');
        $exams = Exam::whereIn('status',['Pending','Ongoing'])->get();
        foreach($exams as $exam){
            $date_start = \Carbon\Carbon::parse($exam->start);
            if($date_start->lt(\Carbon\Carbon::now())){
                // Exam has started
                $date_end = \Carbon\Carbon::parse($exam->end);
                if($date_end->lt(\Carbon\Carbon::now())){
                    // Exam already completed
                    $exam->status = 'Completed';
                    $exam->save();
                }
                else{
                    // Exam has started but not completed
                    $exam->status = 'Ongoing';
                    $exam->save();
                }
            }
            else{
                // Exam has not started
            }
        }
        $this->info('The task has been completed without any issue...');

    }
}

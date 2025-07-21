<?php

namespace ProactiveAnts\Discipline;

use Illuminate\Console\Command;
use DB;

class DisciplinePointAllocationAnnual extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'discipline:annual';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Student discipline point allocation annually task';

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
        $this->info('Annual discipline point allocation process begins');
        // Run the annual point allocation for all the students if the student has already got the point
        // will be ingnored with update
        $students = \App\Student::whereNull('is_left')->get();
        $count = 0;
        foreach($students as $student){
            $point = \ProactiveAnts\Discipline\StudentDisciplinePoint::where('student_id',$student->id)->where('date',getCurrentAcademicYear()->start)->where('type','ALLOCATED')->first();
            if(!$point==null){
                $point->delete();
            }
            \ProactiveAnts\Discipline\StudentDisciplinePoint::create([
                'student_id' => $student->id,
                'date' => getCurrentAcademicYear()->start,
                'point' => config('discipline.annual'),
                'type' => 'ALLOCATED',
                'academic_year_id' => getCurrentAcademicYear()->id
            ]);
            $count++;
            echo('.');
        }
        $this->info('');
        $this->info('Records ' . $count . " have been proccessed");
        $this->info('Process completed');
    }
}

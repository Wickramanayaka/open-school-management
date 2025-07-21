<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class DummyDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        // Academic year
        App\AcademicYear::create([
            'name' => '2005',
            'start' => '2005-01-01',
            'end' => '2005-12-31'
        ]);
        App\AcademicYear::create([
            'name' => '2006',
            'start' => '2006-01-01',
            'end' => '2006-12-31'
        ]);
        App\AcademicYear::create([
            'name' => '2007',
            'start' => '2007-01-01',
            'end' => '2007-12-31'
        ]);
        App\AcademicYear::create([
            'name' => '2008',
            'start' => '2008-01-01',
            'end' => '2008-12-31'
        ]);
        App\AcademicYear::create([
            'name' => '2009',
            'start' => '2009-01-01',
            'end' => '2009-12-31'
        ]);
        App\AcademicYear::create([
            'name' => '2010',
            'start' => '2010-01-01',
            'end' => '2010-12-31'
        ]);
        App\AcademicYear::create([
            'name' => '2011',
            'start' => '2011-01-01',
            'end' => '2011-12-31'
        ]);
        App\AcademicYear::create([
            'name' => '2012',
            'start' => '2012-01-01',
            'end' => '2012-12-31'
        ]);
        App\AcademicYear::create([
            'name' => '2013',
            'start' => '2013-01-01',
            'end' => '2013-12-31'
        ]);
        App\AcademicYear::create([
            'name' => '2014',
            'start' => '2014-01-01',
            'end' => '2014-12-31'
        ]);
        App\AcademicYear::create([
            'name' => '2015',
            'start' => '2015-01-01',
            'end' => '2015-12-31'
        ]);
        App\AcademicYear::create([
            'name' => '2016',
            'start' => '2016-01-01',
            'end' => '2016-12-31'
        ]);
        App\AcademicYear::create([
            'name' => '2017',
            'start' => '2017-01-01',
            'end' => '2017-12-31'
        ]);
        App\AcademicYear::create([
            'name' => '2018',
            'start' => '2018-01-01',
            'end' => '2018-12-31'
        ]);
        // Cluster
        App\Cluster::create([
            'code' => '1',
            'name' => 'Junior',
            'description' => 'Junior' 
        ]);
        App\Cluster::create([
            'code' => '2',
            'name' => 'Senior',
            'description' => 'Senior' 
        ]);
        // Grade
        App\Grade::create([
            'name' => 1,
        ]);
        App\Grade::create([
            'name' => 2,
        ]);    
        App\Grade::create([
            'name' => 3,
        ]);
        App\Grade::create([
            'name' => 4,
        ]);  
        App\Grade::create([
            'name' => 5,
        ]);
        App\Grade::create([
            'name' => 6,
        ]);    
        App\Grade::create([
            'name' => 7,
        ]);
        App\Grade::create([
            'name' => 8,
        ]);     
        App\Grade::create([
            'name' => 9,
        ]);
        App\Grade::create([
            'name' => 10,
        ]);    
        App\Grade::create([
            'name' => 11,
        ]);
        // Division
        App\Division::create([
            'name' => 'A',
        ]);
        App\Division::create([
            'name' => 'B',
        ]);
        App\Division::create([
            'name' => 'C',
        ]);
        App\Division::create([
            'name' => 'D',
        ]);
        App\Division::create([
            'name' => 'E',
        ]);
        App\Division::create([
            'name' => 'F',
        ]);
        App\Division::create([
            'name' => 'G',
        ]);
        // Class room
        foreach (App\Grade::all() as $key => $grade) {
            foreach (App\Division::all() as $key => $division) {
                App\ClassRoom::create([
                    'grade_id' => $grade->id,
                    'division_id' => $division->id,
                    'name' => $grade->name . ' - ' . $division->name
                ]);
            }
        }
        
        // exam
        App\Exam::create([
            'code' => '1',
            'name' => '1st term exam 2017',
            'description' => '',
            'term_id' => 1,
            'academic_year_id' => 13,
            'exam_category_id' => 1,
            'start' => '2017-01-01',
            'end' => '2017-01-01',
            'status' => 'Pending',
            'has_rank' => 1,
            'has_grade_average' => 1
        ]);

        App\Exam::create([
            'code' => '2',
            'name' => '2nd term exam 2017',
            'description' => '',
            'term_id' => 2,
            'academic_year_id' => 13,
            'exam_category_id' => 1,
            'start' => '2017-01-01',
            'end' => '2017-01-01',
            'status' => 'Pending',
            'has_rank' => 1,
            'has_grade_average' => 0
        ]);

        App\Exam::create([
            'code' => '3',
            'name' => '3rd term exam 2017',
            'description' => '',
            'term_id' => 3,
            'academic_year_id' => 13,
            'exam_category_id' => 1,
            'start' => '2017-01-01',
            'end' => '2017-01-01',
            'status' => 'Pending',
            'has_rank' => 1,
            'has_grade_average' => 0
        ]);

        App\Exam::create([
            'code' => '4',
            'name' => '1st term exam 2018',
            'description' => '',
            'term_id' => 4,
            'academic_year_id' => 14,
            'exam_category_id' => 1,
            'start' => '2018-01-01',
            'end' => '2018-01-01',
            'status' => 'Pending',
            'has_rank' => 1,
            'has_grade_average' => 1
        ]);

        App\Exam::create([
            'code' => '5',
            'name' => '2nd term exam 2018',
            'description' => '',
            'term_id' => 5,
            'academic_year_id' => 14,
            'exam_category_id' => 1,
            'start' => '2018-01-01',
            'end' => '2018-01-01',
            'status' => 'Pending',
            'has_rank' => 1,
            'has_grade_average' => 0
        ]);

        App\Exam::create([
            'code' => '6',
            'name' => '3rd term exam 2018',
            'description' => '',
            'term_id' => 6,
            'academic_year_id' => 14,
            'exam_category_id' => 1,
            'start' => '2018-01-01',
            'end' => '2018-01-01',
            'status' => 'Pending',
            'has_rank' => 1,
            'has_grade_average' => 0
        ]);
        //house
        App\House::create([
            'code' => 1,
            'name' => 'Green'
        ]);
        App\House::create([
            'code' => 2,
            'name' => 'Blue'
        ]);
        App\House::create([
            'code' => 3,
            'name' => 'Yellow'
        ]);
        // term
        App\Term::create([
            'code' => 1,
            'name' => '1st Term - 2017',
            'academic_year_id' => 13,
            'start' => '2017-01-01',
            'end' => '2017-03-30',
            'number_of_days' => 60,
            'sequence' => 1
        ]);
        App\Term::create([
            'code' => 2,
            'name' => '2nd Term - 2017',
            'academic_year_id' => 13,
            'start' => '2017-04-01',
            'end' => '2017-07-30',
            'number_of_days' => 60,
            'sequence' => 2
        ]);
        App\Term::create([
            'code' => 3,
            'name' => '3rd Term - 2017',
            'academic_year_id' => 13,
            'start' => '2017-08-01',
            'end' => '2017-11-30',
            'number_of_days' => 60,
            'sequence' => 3
        ]);
        App\Term::create([
            'code' => 4,
            'name' => '1st Term - 2018',
            'academic_year_id' => 14,
            'start' => '2018-01-01',
            'end' => '2018-03-30',
            'number_of_days' => 60,
            'sequence' => 1
        ]);
        App\Term::create([
            'code' => 5,
            'name' => '2nd Term - 2018',
            'academic_year_id' => 14,
            'start' => '2018-04-01',
            'end' => '2018-07-30',
            'number_of_days' => 60,
            'sequence' => 2
        ]);
        App\Term::create([
            'code' => 6,
            'name' => '3rd Term - 2018',
            'academic_year_id' => 14,
            'start' => '2018-08-01',
            'end' => '2018-11-30',
            'number_of_days' => 60,
            'sequence' => 3
        ]);

        // factory(App\Address::class,100)->create();
        // factory(App\Student::class,50)->create();       
        // factory(App\Teacher::class,150)->create();

        // Student parent
        // App\StudentParent::create([
        //     'father_name' => $faker->name,
        // ]);

        // Emergency contact
        // App\EmergencyContact::create([
        //     'name' => $faker->name,
        //     'telephone' => $faker->phoneNumber,
        //     'address' => $faker->address,
        // ]);

        // subject
        App\Subject::create([
            'code' => '1',
            'name' => 'Sinhala',
            'description' => 'Sinhala 1',
            'language_id' => 1,
            'grade_id' => 1,
            'compulsory' => 1
        ]);

        App\Subject::create([
            'code' => '2',
            'name' => 'Maths',
            'description' => 'Maths 6,7,8',
            'language_id' => 1,
            'grade_id' => 1,
            'compulsory' => 1
        ]);

        App\Subject::create([
            'code' => '3',
            'name' => 'English',
            'description' => 'English 6,7,8',
            'language_id' => 1,
            'grade_id' => 1,
            'compulsory' => 1
        ]);

        App\Subject::create([
            'code' => '4',
            'name' => 'Music',
            'description' => 'Music 6,7,8',
            'language_id' => 1,
            'grade_id' => 1,
            'compulsory' => 1
        ]);

        App\Subject::create([
            'code' => '5',
            'name' => 'Science',
            'description' => 'Science 6,7,8',
            'language_id' => 1,
            'grade_id' => 1,
            'compulsory' => 1
        ]);

        App\Subject::create([
            'code' => '2-1',
            'name' => 'Sinhala',
            'description' => 'Sinhala 1',
            'language_id' => 1,
            'grade_id' => 2,
            'compulsory' => 1
        ]);

        App\Subject::create([
            'code' => '2-2',
            'name' => 'Maths',
            'description' => 'Maths 6,7,8',
            'language_id' => 1,
            'grade_id' => 2,
            'compulsory' => 1
        ]);

        App\Subject::create([
            'code' => '2-3',
            'name' => 'English',
            'description' => 'English 6,7,8',
            'language_id' => 1,
            'grade_id' => 2,
            'compulsory' => 1
        ]);

        App\Subject::create([
            'code' => '2-4',
            'name' => 'Music',
            'description' => 'Music 6,7,8',
            'language_id' => 1,
            'grade_id' => 2,
            'compulsory' => 1
        ]);

        App\Subject::create([
            'code' => '2-5',
            'name' => 'Science',
            'description' => 'Science 6,7,8',
            'language_id' => 1,
            'grade_id' => 2,
            'compulsory' => 1
        ]);

        App\Subject::create([
            'code' => '3-1',
            'name' => 'Sinhala',
            'description' => 'Sinhala 1',
            'language_id' => 1,
            'grade_id' => 3,
            'compulsory' => 1
        ]);

        App\Subject::create([
            'code' => '3-2',
            'name' => 'Maths',
            'description' => 'Maths 6,7,8',
            'language_id' => 1,
            'grade_id' => 3,
            'compulsory' => 1
        ]);

        App\Subject::create([
            'code' => '3-3',
            'name' => 'English',
            'description' => 'English 6,7,8',
            'language_id' => 1,
            'grade_id' => 3,
            'compulsory' => 1
        ]);

        App\Subject::create([
            'code' => '3-4',
            'name' => 'Music',
            'description' => 'Music 6,7,8',
            'language_id' => 1,
            'grade_id' => 3,
            'compulsory' => 1
        ]);

        App\Subject::create([
            'code' => '3-5',
            'name' => 'Science',
            'description' => 'Science 6,7,8',
            'language_id' => 1,
            'grade_id' => 3,
            'compulsory' => 1
        ]);

        App\Subject::create([
            'code' => '4-1',
            'name' => 'Sinhala',
            'description' => 'Sinhala 1',
            'language_id' => 1,
            'grade_id' => 4,
            'compulsory' => 1
        ]);

        App\Subject::create([
            'code' => '4-2',
            'name' => 'Maths',
            'description' => 'Maths 6,7,8',
            'language_id' => 1,
            'grade_id' => 4,
            'compulsory' => 1
        ]);

        App\Subject::create([
            'code' => '4-3',
            'name' => 'English',
            'description' => 'English 6,7,8',
            'language_id' => 1,
            'grade_id' => 4,
            'compulsory' => 1
        ]);

        App\Subject::create([
            'code' => '4-4',
            'name' => 'Music',
            'description' => 'Music 6,7,8',
            'language_id' => 1,
            'grade_id' => 4,
            'compulsory' => 1
        ]);

        App\Subject::create([
            'code' => '4-5',
            'name' => 'Science',
            'description' => 'Science 6,7,8',
            'language_id' => 1,
            'grade_id' => 4,
            'compulsory' => 1
        ]);

        App\Subject::create([
            'code' => '6',
            'name' => 'Sinhala',
            'description' => 'Sinhala 5',
            'language_id' => 2,
            'grade_id' => 5,
            'compulsory' => 1
        ]);

        App\Subject::create([
            'code' => '7',
            'name' => 'Maths',
            'description' => 'Maths 5',
            'language_id' => 2,
            'grade_id' => 5,
            'compulsory' => 1
        ]);

        App\Subject::create([
            'code' => '8',
            'name' => 'English',
            'description' => 'English 5',
            'language_id' => 2,
            'grade_id' => 5,
            'compulsory' => 1
        ]);

        App\Subject::create([
            'code' => '9',
            'name' => 'Music',
            'description' => 'Music 5',
            'language_id' => 2,
            'grade_id' => 5,
            'compulsory' => 1
        ]);

        App\Subject::create([
            'code' => '10',
            'name' => 'Science',
            'description' => 'Science 5',
            'language_id' => 2,
            'grade_id' => 5,
            'compulsory' => 1
        ]);

        App\Subject::create([
            'code' => '11',
            'name' => 'Sinhala',
            'description' => 'Sinhala 6',
            'language_id' => 3,
            'grade_id' => 6,
            'compulsory' => 1
        ]);

        App\Subject::create([
            'code' => '12',
            'name' => 'Maths',
            'description' => 'Maths 6',
            'language_id' => 3,
            'grade_id' => 6,
            'compulsory' => 1
        ]);

        App\Subject::create([
            'code' => '13',
            'name' => 'English',
            'description' => 'English 6',
            'language_id' => 3,
            'grade_id' => 6,
            'compulsory' => 1
        ]);

        App\Subject::create([
            'code' => '14',
            'name' => 'Music',
            'description' => 'Music 6',
            'language_id' => 3,
            'grade_id' => 6,
            'compulsory' => 1
        ]);

        App\Subject::create([
            'code' => '15',
            'name' => 'Science',
            'description' => 'Science 6',
            'language_id' => 3,
            'grade_id' => 6,
            'compulsory' => 1
        ]);

        App\Subject::create([
            'code' => '16',
            'name' => 'IT',
            'description' => 'IT 7',
            'language_id' => 1,
            'grade_id' => 7
        ]);

        App\Subject::create([
            'code' => '17',
            'name' => 'Dance',
            'description' => 'Dance 7',
            'language_id' => 1,
            'grade_id' => 7
        ]);

        App\Subject::create([
            'code' => '18',
            'name' => 'Mechanic',
            'description' => 'Mechanic 7',
            'language_id' => 1,
            'grade_id' => 7
        ]);

        App\Subject::create([
            'code' => '19',
            'name' => 'Agri',
            'description' => 'Agri 7',
            'language_id' => 1,
            'grade_id' => 7
        ]);

        App\Subject::create([
            'code' => '20',
            'name' => 'Commerce',
            'description' => 'Commerce 7',
            'language_id' => 1,
            'grade_id' => 7
        ]);

        // This has been removed
        // Grade subject
        // foreach (App\Grade::all() as $key => $grade) {
        //     for ($i=0; $i < 15 ; $i++) { 
        //         DB::table('grade_subjects')->insert([
        //             'grade_id' => $grade->id,
        //             'subject_id' => $i+1,
        //             'academic_year_id' => 1
        //         ]); 
        //         DB::table('grade_subjects')->insert([
        //             'grade_id' => $grade->id,
        //             'subject_id' => $i+1,
        //             'academic_year_id' => 2
        //         ]);  
        //     }
            
        // }

        // Student class room
        // $students = App\Student::all();
        // foreach ($students as $student) {
        //     App\ClassRoomStudent::create([
        //         'student_id' => $student->id,
        //         'class_room_id' => $student->present_class_room_id,
        //         'academic_year_id' => 1,
        //         'date' => '2017-01-01',
        //         'comment' => 'Admitted'
        //     ]);
        // }

        // Exam Marks
        // $students = App\Student::all();
        // foreach ($students as $student) {
        //     $subjects = [1,2,3,4,5];
        //     foreach ($subjects as $subject) {
        //         DB::table('exam_marks')->insert([
        //             'student_id' => $student->id,
        //             'subject_id' => $subject,
        //             'exam_id' => '1',
        //             'mark' => rand(0,100)
        //         ]);
        //         DB::table('exam_marks')->insert([
        //             'student_id' => $student->id,
        //             'subject_id' => $subject,
        //             'exam_id' => '2',
        //             'mark' => rand(0,100)
        //         ]);
        //         DB::table('exam_marks')->insert([
        //             'student_id' => $student->id,
        //             'subject_id' => $subject,
        //             'exam_id' => '3',
        //             'mark' => rand(0,100)
        //         ]);
        //         // 2018 exams
        //         DB::table('exam_marks')->insert([
        //             'student_id' => $student->id,
        //             'subject_id' => $subject,
        //             'exam_id' => '4',
        //             'mark' => rand(0,100)
        //         ]);
        //         DB::table('exam_marks')->insert([
        //             'student_id' => $student->id,
        //             'subject_id' => $subject,
        //             'exam_id' => '5',
        //             'mark' => rand(0,100)
        //         ]);
        //         DB::table('exam_marks')->insert([
        //             'student_id' => $student->id,
        //             'subject_id' => $subject,
        //             'exam_id' => '5',
        //             'mark' => rand(0,100)
        //         ]);
        //     }
            
        // }
        // Section
        // App\Section::create([
        //     'name' => 'OL',
        //     'current_section_head' => 2,
        //     'uid' => str_random(30).time()
        // ]);
        // App\Section::create([
        //     'name' => 'AL',
        //     'current_section_head' => 5,
        //     'uid' => str_random(30).time()
        // ]);
        // Users and roles
        // App\User::create([
        //     'name' => 'Grade 5 Teacher',
        //     'email' => 'teacher@bs.com',
        //     'password' => \Hash::make('chamal'),
        //     'status' => 1,
        //     'teacher_id' => 1
        // ]);
        // App\UserRole::create([
        //     'user_id' => 2,
        //     'role_id' => 7,
        // ]);          
        // App\User::create([
        //     'name' => 'OL Section Head',
        //     'email' => 'head@bs.com',
        //     'password' => \Hash::make('chamal'),
        //     'status' => 1,
        //     'teacher_id' => 2
        // ]);
        // App\UserRole::create([
        //     'user_id' => 3,
        //     'role_id' => 5,
            
        // ]);   
        // App\User::create([
        //     'name' => 'Admin Deputy',
        //     'email' => 'deputy@bs.com',
        //     'password' => \Hash::make('chamal'),
        //     'status' => 1,
        //     'teacher_id' => 3
        // ]);
        // App\UserRole::create([
        //     'user_id' => 4,
        //     'role_id' => 3,
        // ]);  
        
    }
}

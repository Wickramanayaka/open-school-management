<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /**
         * Compulsary basic data
         */
        $this->call(UsersTableSeeder::class);
        $this->call(SchoolsTableSeeder::class);
        $this->call(RolesAndPermissionsSeeder::class);
        $this->call(ExamCategoriesTableSeeder::class);
        $this->call(LanguagesTableSeeder::class);
        $this->call(PaymentCategoryTablesSeeder::class);
        $this->call(MarkGradeTablesSeeder::class);
        $this->call(TransportsTableSeeder::class);
        $this->call(OccupationTableSeeder::class);

        /**
         * Optinal data can be usefull when the initial setup
         */
        // $this->call(AcademicYearsTableSeeder::class);
        // $this->call(TermsTableSeeder::class);
        // $this->call(SubjectsTableSeeder::class);
        // $this->call(GradesTableSeeder::class);
        // $this->call(DivisionsTableSeeder::class);
        // $this->call(ClassRoomsTableSeeder::class);
        // $this->call(HousesTableSeeder::class);
        // $this->call(ClustersTableSeeder::class);
        // $this->call(ExamsTableSeeder::class);
         
        /**
         * Can not seed at live system. The data volume is heigh 
         */
        // $this->call(AddressesTableSeeder::class);
        // $this->call(TeachersTableSeeder::class);
        // $this->call(StudentsTableSeeder::class);

        /** Use at testing purpose (Comment on actual system)
         * When run dummy enable only compulsary seeds
         * 
         */
        //$this->call(DummyDataSeeder::class);
    }
}

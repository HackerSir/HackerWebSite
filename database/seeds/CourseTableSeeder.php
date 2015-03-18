<?php
use App\Course;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class CourseTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('courses')->delete();

        $faker = Faker::create();

        for ($i = 0; $i < 50; $i++) {
            $course = Course::create(array(
                'time' => $faker->dateTime(),
                'subject' => $faker->text(60),
                'lecturer' => $faker->name
            ));

            $this->command->info("[$i] Add course: " . $course->subject);
        }
    }
}

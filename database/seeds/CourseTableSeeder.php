<?php
use App\Course;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class CourseTableSeeder extends Seeder
{
    public function run()
    {
        //移除所有標籤
        foreach (Course::all() as $course) {
            $course->untag();
        }

        DB::table('courses')->delete();

        $faker = Faker::create();

        for ($i = 0; $i < 50; $i++) {
            $links = "";
            $linkCount = rand(0, 3);
            for ($j = 0; $j < $linkCount; $j++) {
                $links .= $faker->url . "\n";
            }
            $course = Course::create(array(
                'time' => $faker->dateTime(),
                'subject' => $faker->text(60),
                'lecturer' => $faker->name,
                'location' => $faker->country,
                'info' => $faker->text,
                'link' => trim($links),
            ));

            $tag = array();
            if (rand(0, 2) == 0) {
                $tag[] = "課程";
            }
            if (rand(0, 3) == 0) {
                $tag[] = "活動";
            }
            if (rand(0, 4) == 0) {
                $tag[] = "演講";
            }
            $course->retag($tag);

            $this->command->info("[$i] Add course: " . $course->subject);
        }
    }
}

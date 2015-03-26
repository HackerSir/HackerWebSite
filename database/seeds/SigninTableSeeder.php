<?php
use App\Card;
use App\Course;
use App\Signin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class SigninTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('signins')->delete();

        $faker = Faker::create();

        for ($i = 0; $i < 200; $i++) {
            //隨機選擇卡片與課程
            $card = Card::orderByRaw("RAND()")->first();
            $course = Course::orderByRaw("RAND()")->first();

            $signin = Signin::create(array(
                'time' => $faker->dateTimeBetween($course->time, 'now'),
                'card_id' => $card->id,
                'course_id' => $course->id
            ));

            $this->command->info("[$i] Add signin: " . $signin->card_id . " - " . $signin->course_id);
        }
    }
}

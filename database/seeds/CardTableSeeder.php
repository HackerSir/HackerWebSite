<?php

use App\Card;
use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class CardTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('cards')->delete();

        $faker = Faker::create();
        //計算有NID的會員人數
        $count_nid = User::whereNotIn('nid', [''])->count();
        //建立會員卡片
        for ($i = 0; $i < $count_nid; $i++) {
            //有機率不建立
            if (rand(0, 4) == 0) {
                continue;
            }
            $user = User::whereNotIn('nid', [''])->skip($i)->first();
            $card = Card::create(array(
                'nid' => $user->nid,
                //有機率不綁定
                'card_number' => rand(0, 1) ? $faker->creditCardNumber : ''
            ));

            $this->command->info("[$i] Add card: " . $card->nid . " - " . $card->card_number);
        }
        //建立無對應會員卡片
        for ($i = 0; $i < 50; $i++) {
            //班級
            $department = array("資訊", "資電", "電機", "外文", "國貿", "會計", "統計");
            $year = array("一", "二", "三", "四");
            $class = array("甲", "乙", "丙");
            shuffle($department);
            shuffle($year);
            shuffle($class);
            $grade = $department[0] . $year[0] . $class[0];

            $card = Card::create(array(
                'nid' => $faker->regexify('[depm]([0-9]){7})'),
                'grade' => $grade,
                'name' => $faker->name,
                //有機率不綁定
                'card_number' => rand(0, 1) ? $faker->creditCardNumber : ''
            ));

            $this->command->info("[$i] Add card: " . $card->nid . " - " . $faker->name);
        }
    }
}

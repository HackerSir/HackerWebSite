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
        //綁定卡片
        for ($i = 0; $i < $count_nid; $i++) {
            //有機率不綁定
            if (rand(0, 4) == 0) {
                continue;
            }
            $user = User::whereNotIn('nid', [''])->skip($i)->first();
            $card = Card::create(array(
                'nid' => $user->nid,
                'card_number' => $faker->creditCardNumber
            ));

            $this->command->info("[$i] Add card: " . $card->nid . " - " . $card->card_number);
        }
        //建立未綁定卡片
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
                'name' => $faker->name
            ));

            $this->command->info("[$i] Add card: " . $card->nid . " - " . $faker->name);
        }
    }
}

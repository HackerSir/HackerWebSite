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
    }
}

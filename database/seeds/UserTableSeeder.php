<?php
use App\Group;
use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class UserTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->delete();

        $faker = Faker::create();

        for ($i = 0; $i < 50; $i++) {
            $email = $faker->email;
            $password = $faker->password;
            //是否驗證
            switch (rand(0, 1)) {
                case 0:
                    $confirm_code = str_random(60);
                    $confirm_at = null;
                    break;
                case 1:
                    $confirm_code = '';
                    $confirm_at = $faker->dateTime();
                    break;
            }
            //班級
            $department = array("資訊", "資電", "電機", "外文", "國貿", "會計", "統計");
            $year = array("一", "二", "三", "四");
            $class = array("甲", "乙", "丙");
            shuffle($department);
            shuffle($year);
            shuffle($class);
            $grade = $department[0] . $year[0] . $class[0];
            //是否登入過
            switch (rand(0, 1)) {
                case 0:
                    $lastlogin_ip = '';
                    $lastlogin_at = null;
                    break;
                case 1:
                    $lastlogin_ip = (rand(0, 1)) ? $faker->ipv4 : $faker->ipv6;
                    $lastlogin_at = $faker->dateTime();
                    break;
            }

            $user = User::create(array(
                'nid' => (rand(0, 1)) ? $faker->regexify('[depm]([0-9]){7})') : '',
                'email' => $email,
                'password' => Hash::make($password),
                'grade' => (rand(0, 1)) ? $grade : '',
                'nickname' => $faker->userName,
                'name' => (rand(0, 1)) ? $faker->name : '',
                'confirm_code' => $confirm_code,
                'confirm_at' => $confirm_at,
                'register_ip' => (rand(0, 1)) ? $faker->ipv4 : $faker->ipv6,
                'register_at' => $faker->dateTime(),
                'lastlogin_ip' => $lastlogin_ip,
                'lastlogin_at' => $lastlogin_at
            ));
            //群組
            $group = Group::where('id', '=', rand(1, 3))->first();
            $user = $group->users()->save($user);
            if ($user->group->name == "staff") {
                //職務
                $jobs = array("社長", "副社長", "學術", "事務", "公關", "網管", "顧問");
                shuffle($jobs);
                $user->job = $jobs[0];
            }
            $user->save();

            $this->command->info("[$i] Add user: " . $user->nickname);
        }
    }
}

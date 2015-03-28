<?php
use App\Booth;
use App\Candidate;
use App\Group;
use App\User;
use App\Vote;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class VoteSeeder extends Seeder
{
    public function run()
    {
        DB::table('votes')->delete();
        DB::table('candidates')->delete();
        DB::table('booths')->delete();

        $faker = Faker::create();

        //建立會長候選人
        $jobs = ["會長", "副會長", "另一位？"];
        $department = array("資訊", "資電", "電機", "外文", "國貿", "會計", "統計");
        $year = array("一", "二", "三", "四");
        $class = array("甲", "乙", "丙");
        shuffle($department);
        shuffle($year);
        shuffle($class);
        for ($i = 0; $i < 3; $i++) {
            $candidate = Candidate::create(array(
                'number' => 1,
                'job' => $jobs[$i],
                'name' => $faker->name,
                'department' => $department[$i],
                'class' => $year[$i] . $class[$i],
                'type' => '學生會會長'
            ));
            $this->command->info("[$i] Candidate: " . $candidate->name);
        }
        //建立議員候選人＆系會長候選人
        for ($i = 0; $i < 20; $i++) {
            shuffle($department);
            shuffle($year);
            shuffle($class);
            $candidate = Candidate::create(array(
                'number' => $i + 2,
                'job' => '',
                'name' => $faker->name,
                'department' => $department[0],
                'class' => $year[0] . $class[0],
                'type' => (rand(0, 1)) ? '學生議員' : '系會長'
            ));
            $this->command->info("[$i] Candidate: " . $candidate->name);
        }
        //建立投票所
        for ($i = 0; $i < 8; $i++) {
            $booth = Booth::create(array(
                'name' => $faker->country,
                'url' => 'https://www.youtube.com/watch?v=' . str_random(11)
            ));
            $this->command->info("[$i] Booth: " . $booth->name);
        }
        //投票
        $booth_list = Booth::all();
        $candidate_list = DB::table('candidates')
            ->select(DB::raw('*, min(id) as id'))
            ->groupBy('number')
            ->orderBy('id', 'asc')
            ->get();

        foreach ($candidate_list as $candidate) {
            foreach ($booth_list as $booth) {
                $vote = Vote::create(array(
                    'candidate_id' => $candidate->id,
                    'booth_id' => $booth->id,
                    'count' => rand(0, 50)
                ));
                $this->command->info("[$i] Vote: " . $vote->candidate_id . "-" . $vote->booth_id . "-" . $vote->count);
            }
        }

    }
}

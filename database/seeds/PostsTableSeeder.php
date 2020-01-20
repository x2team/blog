 <?php

use Illuminate\Database\Seeder;
use Faker\Factory;
use Carbon\Carbon;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // reset the posts table
        \DB::table('posts')->truncate();

        // generate 36 dummy posts data
        $posts = [];
        $faker = Factory::create();
        $date = Carbon::now()->modify('-1 year');

        for ($i = 1; $i <= 36; $i++)
        {
            $image = "Post_Image_" . rand(1, 5) . ".jpg";
            $date->addDays(10);
            $publishedDate = clone($date);
            // $createdDate   = clone($date);

            $posts[] = [
                'uuid'  => (string) Str::uuid(),
                'author_id'    => rand(1, 3),
                'title'        => $faker->sentence(rand(8, 12)),
                'excerpt'      => $faker->text(rand(250, 300)),
                'body'         => $faker->paragraphs(rand(10, 15), true),
                'slug'         => $faker->slug(),
                'image'        => rand(0, 1) == 1 ? $image : NULL,
                'view_count'    => rand(1, 10)*10,
                'created_at'   => clone($date), //$createdDate,
                'updated_at'   => clone($date), //$createdDate,
                'published_at' => $i < 30 ? $publishedDate : ( rand(0, 1) == 0 ? NULL : $publishedDate->addDays(4)),
            ];
        }
        \DB::table('posts')->insert($posts);
    }
}

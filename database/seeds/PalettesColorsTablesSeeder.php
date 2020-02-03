<?php

use App\Palette;
use Illuminate\Database\Seeder;

class PalettesColorsTablesSeeder extends Seeder
{
    public function run()
    {
        factory(Palette::class, 10)
           ->create();
    }

    /**
     * TODO: Переделать эту хрень, написанную на скорую руку через фабрику с использованием Faker.
     *
     * @return void
     * @throws Exception
     */
    public static function generate()
    {
        for ($i = 1; $i <= 1000; $i++) {
            $palette = new Palette();
            $url = $palette->generateUrl();
            $palette->url = $url;
            $palette->ip = $_SERVER['REMOTE_ADDR'];
            $palette->save();

            //Добавление красок (в вашу жизнь)
            $paletteId = $palette->id;
            $colorsArray = [];

            for ($o = 1, $range = mt_rand(2, 10); $o <= $range; $o++) {
                $colorsArray[] = ['sort' => $o, 'color' => bin2hex(random_bytes(3))];
            }

            foreach ($colorsArray as $item) {
                $palette->colors()
                    ->create(
                        ['palette_id' => $paletteId, 'sort' => $item['sort'], 'color' => $item['color']]
                    );
            }
        }
    }
}

<?php

use \App\Palette;
use \App\Color;
use Illuminate\Database\Seeder;

class PalettesColorsTablesSeeder extends Seeder
{
    public function run()
    {
        factory(Palette::class, 1000)
            ->create()
            ->each(function (Palette $palette) {
                $range = rand(2,10);
                // Пока не дошло, как сделать генерацию
                // рандомного кол-ва элементов в hasMany.
                // TODO: Как дойдет - переписать.
                for ($sort = 1; $sort <= $range; $sort++) {
                    $palette->colors()->save(
                        factory(Color::class)->make(['palette_id' => $palette->id, 'sort' => $sort])
                    );
                }
            });
    }
}

<?php

namespace App\Http\Controllers;

use App\Palette;

/**
 * Реализация приложения через один контроллер типа Ресурс
 * Очень просто, очень быстро, просто для тренировки psr7 и
 * небольшого взгляда на Lumen. Спасибо.
 */
class MainController extends JsonController
{
    /**
     * Домашняя страница:
     * $router->get('/')
     *
     * Должна возвращать определенное кол-во палитр (с кол-вом определимся попозже)
     * в формате json
     *
     * В параметрах ожидает номер страницы
     * @param integer $page
     *
     * send() посылает ответ клиенту.
     */
    public function index(int $page = null)
    {
        $limit = 80;

        $palettes = Palette::with('colors')
            ->forPage($page, $limit)
            ->get()
            ->makeHidden(['ip', 'created_at', 'updated_at'])
            ->toArray();
        $this->setResponse($palettes)->send();
    }

    /**
     * Создание палитры из цветов:
     * $router->post('/create/')
     *
     * Должна принимать данные из post,
     * создавать запись со сгенерированным url
     * и отдавать url свежесозданной палитры
     *
     * send() посылает ответ клиенту
     */
    public function create()
    {
        if ($this->request->method()) {
            dd(4);
        }
        //Добавление палитр
        $palette = new Palette();
        $palette->url = $palette->generateUrl();
        $palette->ip = $_SERVER['REMOTE_ADDR'];
        $palette->save();

        //Добавление красок (в вашу жизнь)
        $paletteId = $palette->id;

        foreach ($this->request->all() as $item) {
            $palette->colors()
                ->create(
                    ['palette_id' => $paletteId, 'sort' => $item['sort'], 'color' => $item['color']]
                );
        }

        $this->setResponse(['id' => $paletteId, 'url' => $url])->send();
    }

    /**
     * Возвращает палитру по указанному url,
     * Или отдает 404, если такой записи нет.
     * $router->get('/{url}/')
     *
     * @param $url
     *
     * send() посылает ответ клиенту.
     */
    public function get(string $url)
    {
        $palette = Palette::where('url', $url)
            ->with('colors')
            ->first();
        if ($palette) {
            $palette->makeHidden(['ip', 'created_at', 'updated_at']);
        }
        $this->setResponse($palette)->send();
    }

    public function generatePalettes($please)
    {
        if ($please !== 'please') {
            return 'Just say magic word!';
        }
        $seeder = new \PalettesColorsTablesSeeder();
        $seeder->run();
        return redirect('/');
    }
}

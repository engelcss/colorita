<?php

namespace App\Http\Controllers;

use App\Palette;
use App\Color;

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
            ->toArray();
        $data = $palettes;
        $this->setResponse($data)->send();
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
        //Добавление палитр
        $palette = new Palette();
        $url = $palette->generateUrl();
        $palette->url = $url;
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
    public function get($url)
    {
        $data = Palette::where('url', $url)
            ->with('colors')
            ->first()
            ->toArray();
        $this->setResponse($data)->send();
    }

    /**
     * Удаление палитры:
     * $router->delete('/delete/{id}')
     *
     * @param $id
     *
     * send() посылает ответ клиенту.
     */
    public function delete($id)
    {
        $this->setResponse()->send();
    }

    public function generateFuckingPalettes($please)
    {
        if ($please !== 'please') {
            return 'Just say magic word!';
        }
        \PalettesColorsTablesSeeder::generate();
        return redirect('/');
    }
}

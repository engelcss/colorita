<?php

namespace App\Http\Controllers;

use App\Palette;
use Illuminate\Http\JsonResponse;

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
     * Возвращает палитры (с пагинацией по 80 элементов)
     * в формате json
     *
     * В параметрах ожидает номер страницы
     * @param integer $page
     *
     * send() посылает ответ клиенту.
     */
    public function index(int $page = 1)
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
     * $router->post('palette/create/')
     *
     * Принимает данные из post,
     * вида
     *
     * {"data" : [ { "sort" : "1" , "color" : "e1e1e1" } , { "sort" : "2" , "color" : "f2f2f2" } ] }
     *
     * создает запись со сгенерированным url
     * Возвращает url свежесозданной палитры
     */
    public function create()
    {
        $data = $this->request->json('data');

        if (!isset($data) || empty($data)) {
            $this->setResponse('Data is missing.', 200, 'error')->send();
            exit();
        }

        //Добавление палитр
        $palette = new Palette();
        $palette->save();

        //Добавление красок в вашу жизнь :)
        foreach ($data as $item) {
            $palette->colors()
                ->create(
                    ['palette_id' => $palette->id, 'sort' => $item['sort'], 'color' => $item['color']]
                );
        }

        $this->setResponse(['id' => $palette->id, 'url' => $palette->url])->send();
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

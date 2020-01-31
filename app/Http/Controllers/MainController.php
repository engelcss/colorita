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
     * send() посылает ответ клиенту.
     */
    public function index()
    {
        $palettes = Palette::take(80)->skip(0)->get();
        dd($palettes);
        $data = ['id' => ['color1', 'color2', 'color3']];
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
     * send() посылает ответ клиенту.
     */
    public function create()
    {
        $data = $this->request->all();

        $this->setResponse($data)->send();
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
        $this->setResponse()->send();
    }

    /**
     * Редактирование палитры:
     * $router->patch('/edit/{id}')
     *
     * @param $id
     *
     * send() посылает ответ клиенту.
     */
    public function edit($id)
    {
        $this->setResponse()->send();
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
}

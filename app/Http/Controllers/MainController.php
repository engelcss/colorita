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
    public function index(int $page = 0)
    {
        $limit = 80;
        $palettes = Palette::take($limit)->skip($limit*$page)->get();
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
     * send() посылает ответ клиенту
     */
    public function create()
    {
        $palette = new Palette;
        $url = $palette->generateUrl();
        $palette->url = $url;
        $palette->ip = $_SERVER['REMOTE_ADDR'];
        $palette->save();
        $this->setResponse(['id' => $palette->id, 'url' => $url])->send();
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

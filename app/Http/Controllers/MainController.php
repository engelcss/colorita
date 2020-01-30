<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Cookie;

class MainController extends Controller
{

    /**
     * Реализация приложения через один контроллер типа Ресурс
     * Очень просто, очень быстро, просто для тренировки psr7 и
     * небольшого взгляда на Lumen. Спасибо.
     */

    protected $request;
    protected $response;

    public function __construct(Request $request, JsonResponse $response)
    {
        $this->request = $request;
        $this->response = $response;
    }

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
        $content = ['status' => 'ok', 'data' => ['colors' => ['#001122', '#005543', '#4b3f20']]];
        $this->response
            ->setStatusCode(200)
            ->setData($content)
            ->withCookie(Cookie::create('myCookie1', 'cookie1'))
            ->send();
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
        $this->response
            ->setStatusCode(200)
            ->setData(['url' => 'kdsgDf'])
            ->send();
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

    }
}

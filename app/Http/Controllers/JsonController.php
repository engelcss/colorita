<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class JsonController extends Controller
{

    protected $request;
    protected $response;

    public function __construct(Request $request, JsonResponse $response)
    {
        $this->request = $request;
        $this->response = $response;
    }

    protected function setResponse($data = array(), int $code = 200, string $status = 'ok')
    {
        $this->response
            ->setStatusCode($code)
            ->setData(['status' => $status, 'data' => $data]);

        return $this;
    }

    protected function send()
    {
        //TODO: Проверки перед отправкой.

        $this->response->send();
    }
}

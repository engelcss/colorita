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

    protected function setResponse(int $code = 200, $data = array())
    {
        $this->response
            ->setStatusCode($code)
            ->setData($data);
    }
}

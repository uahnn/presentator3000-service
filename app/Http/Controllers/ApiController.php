<?php

namespace App\Http\Controllers;


use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Http\Response as IlluminateResponse;

class ApiController extends Controller
{
    protected $statusCode = 200;


    public function getStatusCode()
    {
        return $this->statusCode;

    }

    public function setStatusCode($statusCode)
    {
        $this->statusCode = $statusCode;

        return $this;
    }

    public function respond($data, array $headers = [])
    {
        return response($data, $this->getStatusCode(), $headers);
    }

    protected function respondWithPagination(Paginator $item, $data)
    {
        $data = array_merge($data, [
            'paginator' => [
                'total_count' => $item->total(),
                'total_pages' => ceil($item->total() / $item->perPage()),
                'current_page' => $item->currentPage(),
                'prev_page' => $item->previousPageUrl(),
                'next_page' => $item->nextPageUrl(),
                'limit' => $item->perPage()
            ]
        ]);

        return $this->respond($data);
    }


    public function respondWithError($message)
    {
        return $this->respond([
            'error' => [
                'message' => $message,
                'status_code' => $this->getStatusCode()
            ]
        ]);
    }

    public function respondNotFound($message = 'Not Found')
    {
        return $this->setStatusCode(IlluminateResponse::HTTP_NOT_FOUND)->respondWithError($message);
    }

    public function respondBadInput($message = 'Bad Input')
    {
        return $this->setStatusCode(IlluminateResponse::HTTP_UNPROCESSABLE_ENTITY)->respondWithError($message);
    }

    public function respondCreated($message = 'Resource successfully created.')
    {
        return $this->setStatusCode(IlluminateResponse::HTTP_CREATED)->respond([
            'message' => $message
        ]);
    }


}

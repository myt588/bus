<?php namespace App\Http\Controllers\Api;

use Illuminate\Support\Facades\Response;
use Illuminate\Routing\Controller as BaseController;


/**
 * Created by PhpStorm.
 * User: Tian
 * Date: 3/5/15
 * Time: 11:36 PM
 */



class ApiController extends BaseController{

    protected $data;

    protected $headers = [];

    public function paginate($httpCode = 200)
    {
        return Response::json($this->data, $httpCode, $this->headers);
    }


    public function push($httpCode = 200, $code = 20000, $message = 'ok')
    {
        return $this->respond($this->data, $httpCode, $code, $message, $this->headers);
    }

    protected function respond($data = null, $httpCode = 200, $code = 20000, $message = 'ok', $headers = [])
    {
        $respData = [
            'code'      => $code,
            'message'   => $message,
            'data'      => $data
        ];
        //dd($respData);

        $respHeaders = $headers;
        return Response::json($respData, $httpCode, $respHeaders);
    }

    public function respondWithError($message)
    {
        return $this->respond(null, 111, 11111, $message);
    }

    /**
     * 生成一个 400 响应
     *
     * @see docs/api/introduction
     * @param string $reason    响应原因，默认为 `invalid input`.
     * @return \JSONResponse
     */
    public function invalidInput($reason = null, $data = null)
    {
        $reason = $reason ?: 'invalid input';
        return $this->respond($data, 400, 40000, $reason);

    }

    /**
     * 生成一个 401 响应
     *
     * @see docs/api/introduction
     * @param string $reason    响应原因，默认为 `authentication failed`.
     * @return \JSONResponse
     */
    public function authFailed($reason = 'authentication failed')
    {
        return $this->respond(null, 401, 40100, $reason);
    }

    /**
     * 生成一个 403 响应
     *
     * @see docs/api/introduction
     * @param string $reason    响应原因，默认为 `request forbidden`.
     * @return \JSONResponse
     */
    public function forbidden($reason = 'request forbidden')
    {
        return $this->respond(null, 403, 40300, $reason);
    }

    /**
     * 生成一个 404 响应
     *
     * @see docs/api/introduction
     * @param string $reason    响应原因，默认为 `not found`.
     * @return \JSONResponse
     */
    public function notFound($reason = 'not found')
    {
        return $this->respond(null, 404, 40400, $reason);
    }

    /**
     * 生成一个 500 响应
     *
     * @see docs/api/introduction
     * @param string $reason    响应原因，默认为 `server error`.
     * @return \JSONResponse
     */
    public function serverError($reason = 'server error')
    {
        return $this->respond(null, 500, 50000, $reason);
    }

}



/*
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

public function respond($data, $headers = [])
 {
     return Response::json($data, $this->getStatusCode(), $headers);
 }

    public function respondNotFound($message = 'Not Found!')
    {
        return $this->setStatusCode(404)->respondWithError($message);
    }

 public function respondDeleted($message)
 {
     return $this->setStatusCode(200)->respond([
         'message' => $message
     ]);
 }


 public function respondWithError($message)
 {
     return $this->respond([
         'error' => [
             'message' => $message,
             'code'	  => $this->getStatusCode()
         ]
     ]);
 }

 protected function respondCreated($message)
 {
     return $this->setStatusCode(201)->respond([
         'message' => $message
     ]);
 }

*/



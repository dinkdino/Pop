<?php namespace Pop\Http\Controllers;

use Symfony\Component\HttpFoundation\Response;

class ApiController extends Controller {

    protected $statusCode = 200;

    /**
     * @return mixed
     */
    public function getStatusCode()
    {
        return $this->statusCode;
    }

    /**
     * @param mixed $statusCode
     * @return $this
     */
    public function setStatusCode($statusCode)
    {
        $this->statusCode = $statusCode;

        return $this;
    }

    /**
     * @param $message
     * @return Response
     */
    public function respondNotValid($message) {
        return $this->setStatusCode(Response::HTTP_FORBIDDEN)->respondWithError($message);
    }

    /**
     * @param $message
     * @return Response
     */
    public function respondUnauthorized($message) {
        return $this->setStatusCode(Response::HTTP_UNAUTHORIZED)->respondWithError($message);
    }

    /**
     * @param $message
     * @return Response
     */
    public function respondWithError($message) {
        return $this->respond([
            'error' => [
                'message' => $message,
                'status_code' => $this->getStatusCode()
            ]
        ]);
    }

    /**
     * @param $message
     * @param null $data
     * @return Response
     */
    public function respondWithSuccess($message, $data = null) {
        $responseData = [
            'message' => $message,
            'status_code' => $this->getStatusCode()
        ];

        if ($data !== null) $responseData['data'] = $data;

        return $this->setStatusCode(200)->respond($responseData);
    }

    /**
     * @param $data
     * @param array $headers
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function respond($data, $headers = []) {
        return response()->json($data, $this->statusCode, $headers);
    }


}

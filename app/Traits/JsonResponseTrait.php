<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

trait JsonResponseTrait
{
    /**
     * @param $result
     * @param $message
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function sendResponse($result, $message = null, int $status = Response::HTTP_OK)
    {
        return response()->json(self::makeResponse($message, $result), $status, []);
    }

    /**
     * @param $result
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function sendData($result, int $status = Response::HTTP_OK): JsonResponse
    {
        return response()->json($result, $status, []);
    }

    /**
     * @param string $message
     * @param int $status
     * @return \Illuminate\Http\JsonResponse
     */
    public function sendMessage(string $message, int $status = Response::HTTP_OK)
    {
        return response()->json(compact('message'), $status, [], JSON_NUMERIC_CHECK);
    }

    /**
     * @param string $message
     * @param int $status
     * @return \Illuminate\Http\JsonResponse
     */
    public function sendErrorResponse(string $message, int $status = Response::HTTP_UNPROCESSABLE_ENTITY)
    {
        return response()->json(['error_message' => $message], $status, [], JSON_NUMERIC_CHECK);
    }

    public static function makeResponse($message, $data)
    {
        return [
            'success' => true,
            'data' => $data,
            'message' => $message,
        ];
    }

    function generateOptmatricule($n)
    {
        $generator="1234567890AZERTYUIOPQSDFGHJKLMWXCVBN";
        $result="";
        for ($i=0; $i <$n ; $i++)
        {
          $result.=substr($generator, (rand()%(strlen($generator))),1);
        }
        return $result;
    }

    function generateOpt($n)
    {

     $generator="0123456789";
     $result="";
     for ($i=0; $i <$n ; $i++) {
       $result.=substr($generator, (rand()%(strlen($generator))),1);
     }
     return $result;
    }

    // function generateOpt(limit)
    // {
    //     const digits = '0123456789';
    //     let OTP = '';

    //     for (let i = 0; i < limit; i++){
    //         OTP += digits[Math.floor(Math.random() * 10)];
    //     }
    //     return OTP;
    // }
}

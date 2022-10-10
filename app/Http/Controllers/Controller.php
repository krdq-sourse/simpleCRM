<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests;
    use DispatchesJobs;
    use ValidatesRequests;

    protected $statusCode;

    public function getStatusCode()
    {
        return $this->statusCode;
    }

    public function respondWithError($message = null)
    {
        return response()->json(
            ['success' => false, 'msg' => $message]
        );
    }

    public function respondWentWrong($exception = null)
    {

        $message = (config('app.debug') && is_object($exception))
            ? "File:" . $exception->getFile() . "Line:" . $exception->getLine() . "Message:" . $exception->getMessage()
            : __('messages.something_went_wrong');

        return $this->setStatusCode(200)
            ->respondWithError($message);
    }

    public function respondSuccess($message = null, $additional_data = [])
    {
        $message = is_null($message) ? __('messages.success') : $message;
        $data    = ['success' => true, 'msg' => $message];

        if (!empty($additional_data)) {
            $data = array_merge($data, $additional_data);
        }

        return $this->respond($data);
    }

    public function respond($data)
    {
        return response()->json($data);
    }
}

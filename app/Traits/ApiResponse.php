<?php
namespace App\Traits;

use Illuminate\Http\Response;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;
use App\Http\Enums\ApiResponse as StatusCode;
trait ApiResponse
{
    public function ok($data = null, string $message = "") : Response
    {
        return $this->sendResponse(StatusCode::OK, $message, $data);
    }

    public function badRequest() : Response
    {
        return $this->sendResponse(StatusCode::BAG_REQUEST, "", null);
    }

    public function unauthorized() : Response
    {
        return $this->sendResponse(StatusCode::UNAUTHORIZED, "Username or password incorrect", null, ['email' => 'Username or password incorrect']);
    }

    public function sendResponse(int $statusCode, string $mgs , $data, $error = null) : Response
    {
        return response($this->toResponse($mgs, $data, $error), $statusCode);
    }

    public function toResponse(string $mgs, $data, $error = null) : array
    {
        return [
            'message' => $mgs,
            'data' => $data,
            'error' => $error,
        ];
    }

    public function validationFail(Validator $validator){
        $changeValidator = [];

        foreach ($validator->errors()->toArray() as $attribute => $errorMgs)
        {
            $changeValidator[$attribute] = $errorMgs[0];
        }

        throw new HttpResponseException($this->sendResponse(
            StatusCode::UNPROCESSABLE_ENTITY,
            "",
            null,
            $changeValidator,
        ));
    }

}

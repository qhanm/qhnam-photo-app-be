<?php
namespace App\Http\Enums;

class ApiResponse
{
    const OK = 200;
    const CREATE = 201;
    const NO_CONTENT  = 204;
    const BAG_REQUEST = 400;
    const UNAUTHORIZED = 401;
    const FORBIDDEN = 403;
    const METHOD_NOT_ALLOW = 405;
    const UNPROCESSABLE_ENTITY  = 422;
    const INTERNAL_SERVER_ERROR = 500;
    const BAG_GATEWAY = 502;
    const GATEWAY_TIMEOUT = 504;
}

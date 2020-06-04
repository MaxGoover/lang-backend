<?php

namespace app\models\response;

class DTO
{
    const STATUS_SUCCESS = 200;
    const STATUS_BAD_REQUEST = 400;
    const STATUS_UNAUTHORIZED = 401;
    const STATUS_FORBIDDEN = 403;
    const STATUS_NOT_FOUND = 404;
    const STATUS_INTERNAL_SERVER_ERROR = 500;

    protected $data = null;
    protected $date;
    protected $errors = null;
    protected $executionTime;
    protected bool $isError = true;
    protected string $message;
    protected int $status;

    public static function badRequestError($errors = null)
    {
        $dto = new static();
        $dto->errors = $errors;
        $dto->message = 'Bad Request Error';
        $dto->status = self::STATUS_BAD_REQUEST;

        return $dto->response();
    }

    public static function internalServerError($errors = null)
    {
        $dto = new static();
        $dto->errors = $errors;
        $dto->message = 'Internal Server Error';
        $dto->status = self::STATUS_INTERNAL_SERVER;

        return $dto->response();
    }

    public static function notFoundError($errors = null)
    {
        $dto = new static();
        $dto->errors = $errors;
        $dto->message = 'Not Found Error';
        $dto->status = self::STATUS_NOT_FOUND;

        return $dto->response();
    }

    public static function success ($data) {
        $dto = new static();
        $dto->data = $data;
        $dto->isError = false;
        $dto->message = 'Successfully';
        $dto->status = self::STATUS_SUCCESS;

        return $dto->response();
    }

    public static function validationError($errors = null)
    {
        $dto = new static();
        $dto->errors = $errors;
        $dto->message = 'Validation Error';
        $dto->status = self::STATUS_BAD_REQUEST;

        return $dto->response();
    }
}
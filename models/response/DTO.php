<?php

namespace app\models\response;

class DTO
{
    const STATUS_SUCCESS = 200;
    const STATUS_BAD_REQUEST = 400;
    const STATUS_UNAUTHORIZED = 401;
    const STATUS_NOT_FOUND = 404;
    const STATUS_INTERNAL_SERVER = 500;

    protected $data = null;
    protected $date;
    protected $errors = null;
//    protected $executionTime;
    protected bool $isError = true;
    protected string $message;
    protected int $status;

    public static function badRequestError($errors = null): self
    {
        $callback = function (self $dto) {
            $dto->message = 'Bad Request Error';
            $dto->status = self::STATUS_BAD_REQUEST;
            return $dto;
        };
        return self::response($callback, $errors);
    }

    public static function internalServerError($errors = null): self
    {
        $callback = function (self $dto) {
            $dto->message = 'Internal Server Error';
            $dto->status = self::STATUS_INTERNAL_SERVER;
            return $dto;
        };
        return self::response($callback, $errors);
    }

    public static function notFoundError($errors = null): self
    {
        $callback = function (self $dto) {
            $dto->message = 'Not Found Error';
            $dto->status = self::STATUS_NOT_FOUND;
            return $dto;
        };
        return self::response($callback, $errors);
    }

    public static function unauthorizedError($errors = null): self
    {
        $callback = function (self $dto) {
            $dto->message = 'Unauthorized Error';
            $dto->status = self::STATUS_UNAUTHORIZED;
            return $dto;
        };
        return self::response($callback, $errors);
    }

    public static function validationError($errors = null): self
    {
        $callback = function (self $dto) {
            $dto->message = 'Validation Error';
            $dto->status = self::STATUS_BAD_REQUEST;
            return $dto;
        };
        return self::response($callback, $errors);
    }

    ##################################################

    public static function response(callable $callback, $errors = null): self
    {
        $dto = new static();
        $dto->errors = $errors;
        $dto = $callback($dto);
        $dto->date = time();
        return $dto;
    }

    public static function success ($data): self
    {
        $callback = function (self $dto) use ($data) {
            $dto->data = $data;
            $dto->isError = false;
            $dto->message = 'Successfully';
            $dto->status = self::STATUS_SUCCESS;
            return $dto;
        };
        return self::response($callback);
    }
}
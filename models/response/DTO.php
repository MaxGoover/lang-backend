<?php

namespace app\models\response;

class DTO
{
    const STATUS_SUCCESS = 200;
    const STATUS_BAD_REQUEST = 400;
    const STATUS_UNAUTHORIZED = 401;
    const STATUS_NOT_FOUND = 404;
    const STATUS_INTERNAL_SERVER = 500;

    /**
     * @var mixed
     */
    public $data;
    public int $date;
    public $errors;
    public bool $isError;
    public string $message;
    public int $status;

    public function __construct()
    {
        $this->data = null;
        $this->errors = null;
        $this->isError = true;
    }

    public function badRequestError($errors = null): self
    {
        $callback = function () {
            $this->message = 'Bad Request Error';
            $this->status = self::STATUS_BAD_REQUEST;
            return $this;
        };
        return $this->response($callback, $errors);
    }

    public function internalServerError($errors = null): self
    {
        $callback = function () {
            $this->message = 'Internal Server Error';
            $this->status = self::STATUS_INTERNAL_SERVER;
            return $this;
        };
        return $this->response($callback, $errors);
    }

    public function notFoundError($errors = null): self
    {
        $callback = function () {
            $this->message = 'Not Found Error';
            $this->status = self::STATUS_NOT_FOUND;
            return $this;
        };
        return $this->response($callback, $errors);
    }

    public function unauthorizedError($errors = null): self
    {
        $callback = function () {
            $this->message = 'Unauthorized Error';
            $this->status = self::STATUS_UNAUTHORIZED;
            return $this;
        };
        return $this->response($callback, $errors);
    }

    public function validationError($errors = null): self
    {
        $callback = function () {
            $this->message = 'Validation Error';
            $this->status = self::STATUS_BAD_REQUEST;
            return $this;
        };
        return $this->response($callback, $errors);
    }

    ##################################################

    public function response(callable $callback, $errors = null): self
    {
        $this->errors = $errors;
        $callback();
        $this->date = time();
        return $this;
    }

    public function success ($data): self
    {
        $callback = function () use ($data) {
            $this->data = $data;
            $this->isError = false;
            $this->message = 'Successfully';
            $this->status = self::STATUS_SUCCESS;
            return $this;
        };
        return $this->response($callback);
    }
}

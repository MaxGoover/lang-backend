<?php

namespace app\models\response;

use app\helpers\Pagination;
use Yii;

/**
 * Class Response
 * @package app\models\response
 */
class Response
{
    /**
     * Statuses.
     */
    const STATUS_SUCCESS = 200;
    const STATUS_BAD_REQUEST = 400;
    const STATUS_UNAUTHORIZED = 401;
    const STATUS_PAYMENT_REQUIRED = 402;
    const STATUS_FORBIDDEN = 403;
    const STATUS_NOT_FOUND = 404;
    const STATUS_INTERNAL_SERVER_ERROR = 500;

    /**
     * Response data transfer object.
     *
     * @var ResponseDTO
     */
    private $_responseDto;

    /**
     * Code execution time.
     *
     * @var
     */
    private $_executionStartTime;
    private $_executionEndTime;

    /**
     * ResponseDTO constructor.
     */
    public function __construct()
    {
        // Set code execution time start
        $this->_startExecution();

        // Creates response data transfer object
        $this->_responseDto = new ResponseDTO();

        // Response created date
        $this->_responseDto->date = time();

        // Set API information
        $this->_setApiInformation();

        // Set default status
        $this->setSuccess();
    }

    /**
     * Get response data transfer object.
     *
     * @return ResponseDTO
     */
    public function getResponseData()
    {
        // Set code execution time
        $this->_setExecutionTime();

        return $this->_responseDto;
    }

    /**
     * Set data.
     *
     * @param $data
     * @param null $message
     * @return $this
     */
    public function setData($data, $message = null)
    {
        // Set data
        $this->_responseDto->data = $data;

        // Set success status
        $this->setSuccess($message);

        return $this;
    }

    /**
     * Set pagination data.
     *
     * @param Pagination $pagination
     * @return $this
     */
    public function setPagination(Pagination $pagination)
    {
        $this->_responseDto->pagination = $pagination->getPaginationData();

        return $this;
    }

    /**
     * Set API information.
     */
    private function _setApiInformation()
    {
        $this->_responseDto->name = '';
        $this->_responseDto->description = '';
        $this->_responseDto->version = '';
        $this->_responseDto->license = '';
    }

    /**
     * Set success.
     *
     * @param null $message
     * @return $this
     */
    public function setSuccess($message = null)
    {
        $this->_responseDto->status = self::STATUS_SUCCESS;
        $this->_responseDto->message = $message ?? Yii::t('status', 'Successfully');;
        $this->_responseDto->errors = null;
        $this->_responseDto->isError = false;

        return $this;
    }

    /**
     * Set errors.
     *
     * @param $status
     * @param $message
     * @param null $errors
     * @return $this
     */
    public function setErrors($status, $message, $errors = null)
    {
        $this->_responseDto->status = $status ?? self::STATUS_INTERNAL_SERVER_ERROR;
        $this->_responseDto->message = $message ?? Yii::t('status', 'Internal Server Error');
        $this->_responseDto->errors = $errors;
        $this->_responseDto->isError = true;

        return $this;
    }

    /**
     * Set validation errors.
     *
     * @param array $errors
     * @return $this
     */
    public function setValidationError($errors = [])
    {
        $this->_responseDto->status = $status ?? self::STATUS_BAD_REQUEST;
        $this->_responseDto->message = $message ?? Yii::t('status', 'Validation Error');
        $this->_responseDto->isError = true;
        $this->_responseDto->isValidationError = true;

        // Validation errors must be an array
        $this->_responseDto->validationErrors = is_array($errors) ? $errors : [$errors];

        return $this;
    }

    /**
     * Set bad request error (400).
     *
     * @param null $message
     * @param null $errors
     * @return $this
     */
    public function setBadRequestError($message = null, $errors = null)
    {
        $this->_responseDto->status = self::STATUS_BAD_REQUEST;
        $this->_responseDto->message = $message ?? Yii::t('status', 'Bad Request');
        $this->_responseDto->errors = $errors;
        $this->_responseDto->isError = true;

        return $this;
    }

    /**
     * Set unauthorized error (401).
     *
     * @param null $message
     * @param null $errors
     * @return $this
     */
    public function setUnauthorizedError($message = null, $errors = null)
    {
        $this->_responseDto->status = self::STATUS_UNAUTHORIZED;
        $this->_responseDto->message = $message ?? Yii::t('status', 'Unauthorized');
        $this->_responseDto->errors = $errors;
        $this->_responseDto->isError = true;

        return $this;
    }

    /**
     * Set payment required error (402).
     *
     * @param null $message
     * @param null $errors
     * @return $this
     */
    public function setPaymentRequiredError($message = null, $errors = null)
    {
        $this->_responseDto->status = self::STATUS_PAYMENT_REQUIRED;
        $this->_responseDto->message = $message ?? Yii::t('status', 'Payment Required');
        $this->_responseDto->errors = $errors;
        $this->_responseDto->isError = true;

        return $this;
    }

    /**
     * Set forbidden error (403).
     *
     * @param null $message
     * @param null $errors
     * @return $this
     */
    public function setForbiddenError($message = null, $errors = null)
    {
        $this->_responseDto->status = self::STATUS_FORBIDDEN;
        $this->_responseDto->message = $message ?? Yii::t('status', 'Forbidden');
        $this->_responseDto->errors = $errors;
        $this->_responseDto->isError = true;

        return $this;
    }

    /**
     * Set not found error (404).
     *
     * @param null $message
     * @param null $errors
     * @return $this
     */
    public function setNotFoundError($message = null, $errors = null)
    {
        $this->_responseDto->status = self::STATUS_NOT_FOUND;
        $this->_responseDto->message = $message ?? Yii::t('status', 'Not Found');
        $this->_responseDto->errors = $errors;
        $this->_responseDto->isError = true;

        return $this;
    }

    /**
     * Set internal server error (500).
     *
     * @param null $message
     * @param null $errors
     * @return $this
     */
    public function setInternalServerError($message = null, $errors = null)
    {
        $this->_responseDto->status = self::STATUS_INTERNAL_SERVER_ERROR;
        $this->_responseDto->message = $message ?? Yii::t('status', 'Internal Server Error');
        $this->_responseDto->errors = $errors;
        $this->_responseDto->isError = true;

        return $this;
    }

    /**
     * Set code execution time.
     */
    private function _startExecution()
    {
        $this->_executionStartTime = microtime(true);
    }

    /**
     * Set code execution time.
     */
    private function _setExecutionTime()
    {
        $this->_executionEndTime = microtime(true);

        $this->_responseDto->executionTime = $this->_executionEndTime - $this->_executionStartTime;
    }
}

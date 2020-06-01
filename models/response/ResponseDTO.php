<?php

namespace app\models\response;

use app\helpers\Pagination;

/**
 * Class ResponseDTO.
 * Data transfer object for API response.
 *
 * @package app\models\response
 */
class ResponseDTO
{
    /**
     * Data.
     *
     * @var int
     */
    public $data;

    /**
     * Pagination data.
     *
     * @var Pagination
     */
    public $pagination;

    /**
     * Response created date.
     *
     * @var int
     */
    public $date;

    /**
     * API information.
     *
     * @var
     */
    public $name;
    public $description;
    public $version;
    public $license;

    /**
     * Additional data.
     *
     * @var
     */
    public $status;
    public $message;
    public $errors = null;
    public $isError = false;
    public $isValidationError = false;
    public $validationErrors = [];

    /**
     * Code execution micro time.
     *
     * @var
     */
    public $executionTime;
}

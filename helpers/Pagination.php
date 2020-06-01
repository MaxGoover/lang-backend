<?php

namespace app\helpers;

/**
 * Class Pagination
 * @package app\helpers
 */
class Pagination
{
    /**
     * Limits.
     */
    const DEFAULT_LIMIT = 10;
    const MAX_LIMIT = 500;

    /**
     * Items count.
     *
     * @var int
     */
    private $_count = 0;

    /**
     * Current page.
     *
     * @var int
     */
    private $_page = 1;

    /**
     * Limit.
     *
     * @var int
     */
    private $_limit = self::DEFAULT_LIMIT;

    /**
     * Descending sort.
     *
     * @var bool
     */
    private $_descending = false;

    /**
     * Sort by field.
     *
     * @var string
     */
    private $_sortBy = '';

    /**
     * Pagination constructor.
     *
     * @param array $data
     */
    public function __construct($data = [])
    {
        if (is_array($data)) {

            // Set data
            $this->attributes($data);

            // Set data from Pagination array
            if (isset($data['Pagination'])) {
                $this->load($data);
            }
        }
    }

    /**
     * Set data from Pagination array.
     *
     * @param array $data
     * @return bool
     */
    public function load($data)
    {
        if (is_array($data) && isset($data['Pagination'])) {
            return $this->attributes($data['Pagination']);
        }

        return false;
    }

    /**
     * Set data.
     *
     * @param array $data
     * @return bool
     */
    public function attributes($data)
    {
        if (is_array($data)) {

            // Set total items
            if (isset($data['totalItems'])) {
                $this->setCount($data['totalItems']);
            }

            // Set page
            if (isset($data['page'])) {
                $this->setPage($data['page']);
            }

            // Set rows per page
            if (isset($data['rowsPerPage'])) {
                $this->setLimit($data['rowsPerPage']);
            }

            // Set descending
            if (isset($data['descending'])) {
                $this->setDescending($data['descending']);
            }

            // Set sort by field
            if (isset($data['sortBy'])) {
                $this->setSortBy($data['sortBy']);
            }

            return true;
        }

        return false;
    }

    /**
     * Get count.
     *
     * @return int
     */
    public function getCount(): int
    {
        return $this->_count;
    }

    /**
     * Get page.
     *
     * @return int
     */
    public function getPage(): int
    {
        return $this->getPages() < $this->_page ? 1 : $this->_page;
    }

    /**
     * Get limit.
     *
     * @return int
     */
    public function getLimit(): int
    {
        return $this->_limit;
    }

    /**
     * Get descending.
     *
     * @return bool
     */
    public function getDescending(): bool
    {
        return $this->_descending;
    }

    /**
     * Get sort by field.
     *
     * @return string
     */
    public function getSortBy(): string
    {
        return $this->_sortBy;
    }

    /**
     * Get pages number.
     *
     * @return int
     */
    public function getPages(): int
    {
        return ceil($this->getCount() / $this->getLimit());
    }

    /**
     * Get offset.
     *
     * @return int
     */
    public function getOffset(): int
    {
        return (int)(($this->getPage() - 1) * $this->getLimit());
    }

    /**
     * Get pagination data.
     *
     * @return array
     */
    public function getPaginationData(): array
    {
        return [
            'descending'  => $this->getDescending(),
            'page'        => $this->getPage(),
            'rowsPerPage' => $this->getLimit(),
            'sortBy'      => $this->getSortBy(),
            'totalItems'  => $this->getCount(),
            'offset'      => $this->getOffset(),
            'pages'       => $this->getPages(),
        ];
    }

    /**
     * Set limit.
     *
     * @param int $limit
     */
    public function setLimit($limit): void
    {
        $limit = is_int($limit) && $limit > 0 ? $limit : self::DEFAULT_LIMIT;

        $this->_limit = $limit < self::MAX_LIMIT ? $limit : self::MAX_LIMIT;
    }

    /**
     * Set count.
     *
     * @param int $count
     */
    public function setCount($count): void
    {
        $this->_count = is_int($count) ? $count : 0;
    }

    /**
     * Set page.
     *
     * @param int $page
     */
    public function setPage($page): void
    {
        $this->_page = is_int($page) && $page > 0 ? $page : 1;
    }

    /**
     * Set descending.
     *
     * @param bool $descending
     */
    public function setDescending($descending): void
    {
        $this->_descending = (bool)$descending;
    }

    /**
     * Set sort by field.
     *
     * @param string $sortBy
     */
    public function setSortBy($sortBy): void
    {
        $this->_sortBy = (string)$sortBy;
    }
}

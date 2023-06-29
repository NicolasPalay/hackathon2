<?php
namespace App\Search;

use App\Entity\Brand;

class SearchData
{
    /**
     * @var int
     */
    public int $page = 1;

    /**
     * @var string
     */
    public ?string $q = '';

    /**
     * @var Brand[]
     */
    public array $brand = [];

    /**
     * @var null|integer
     */
    public ?int $max;

    /**
     * @var null|integer
     */
    public ?int $min;

}
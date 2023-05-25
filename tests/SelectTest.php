<?php

namespace Tests\QB;

use QB\Select;

class SelectTest extends \PHPUnit\Framework\TestCase
{
    protected $select;
    protected function assertPreConditions(): void
    {
        $this->assertTrue(class_exists(Select::class));
    }

    protected function setUp(): void
    {
        $this->select = new Select('products');
    }

    /**
     * @test
     */
    public function queryBaseIsGeneratedWithSuccess()
    {
        $this->assertEquals(strtolower('SELECT * FROM `products`'), $this->select->toSql());
    }

    /**
     * @test
     */
    public function queryIsGeneratedWithWhereConditions()
    {
        $query = $this->select
            ->where('name', '=', 'Produto 1');

        $this->assertEquals("select * from `products` where `name` = :name", $query->toSql());
    }

    /**
     * @test
     */
    public function queryAllowToAddSeveralConditions()
    {
        $query = $this->select
            ->where('name', '=', 'Produto 1')
            ->where('price', '>=', 10);

        $this->assertEquals("select * from `products` where `name` = :name and `price` >= :price", $query->toSql());
    }
}
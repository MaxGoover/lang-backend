<?php

namespace app\other\cart;

use app\other\cart\cost\calculator\CalculatorInterface;
use app\other\cart\cost\Cost;
use app\other\cart\storage\StorageInterface;

class Cart
{
    private CalculatorInterface $_calculator;
    /**
     * @var CartItem[]
     * */
    private array $_items;
    private StorageInterface$_storage;

    public function __construct(
        CalculatorInterface $calculator,
        StorageInterface $storage
    )
    {
        $this->_calculator = $calculator;
        $this->_storage = $storage;
    }

    public function add(CartItem $item): void
    {
        $this->_loadItems();
        $this->_items[] = $item;
        $this->_saveItems();
    }

    public function clear(): void
    {
        $this->_items = [];
        $this->_saveItems();
    }

    public function getAmount(): int
    {
        $this->_loadItems();
        return count($this->_items);
    }

    public function getCost(): Cost
    {
        $this->_loadItems();
        return $this->_calculator->getCost($this->_items);
    }

    /**
     * @return CartItem[]
     */
    public function getItems(): array
    {
        $this->_loadItems();
        return $this->_items;
    }

    public function remove(int $goodsId): void
    {
        $this->_loadItems();
        foreach ($this->_items as $i => $current) {
            if ($current->getGoodsId() === $goodsId) {
                unset($this->_items[$i]);
                $this->_saveItems();
                return;
            }
        }
        throw new \DomainException('CartItem is not found.');
    }

    private function _loadItems(): void
    {
        if ($this->_items === null) {
            $this->_items = $this->_storage->load();
        }
    }

    private function _saveItems(): void
    {
        $this->_storage->save($this->_items);
    }
} 
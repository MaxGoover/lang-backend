<?php

namespace app\other\cart\storage;

use app\other\cart\CartItem;
use yii\db\Connection;
use yii\web\User;

class HybridStorage implements StorageInterface
{
    private string $_cookieKey;
    private int $_cookieTimeout;
    private Connection $_db;
    private StorageInterface $_storage;
    private User $_user;

    public function __construct(
        string $cookieKey,
        int $cookieTimeout,
        Connection $db,
        User $user
    )
    {
        $this->_cookieKey = $cookieKey;
        $this->_cookieTimeout = $cookieTimeout;
        $this->_db = $db;
        $this->_user = $user;
    }

    public function load(): array
    {
        return $this->_getStorage()->load();
    }

    public function save(array $items): void
    {
        $this->_getStorage()->save($items);
    }

    private function _getStorage(): StorageInterface
    {
        if ($this->_storage === null) {
            $cookieStorage = new CookieStorage($this->_cookieKey, $this->_cookieTimeout);
            if ($this->_user->isGuest) {
                $this->_storage = $cookieStorage;
            } else {
                $dbStorage = new DbStorage($this->_db, $this->_user->id);
                if ($cookieItems = $cookieStorage->load()) {
                    $dbItems = $dbStorage->load();
//                    $items = array_merge($dbItems, array_udiff($cookieItems, $dbItems, function (CartItem $first, CartItem $second) {
//                        return $first->getId() === $second->getId();
//                    }));
//                    $dbStorage->save($items);
//                    $cookieStorage->save([]);
                }
                $this->_storage = $dbStorage;
            }
        }
        return $this->_storage;
    }
}
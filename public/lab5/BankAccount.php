<?php

require_once __DIR__ . '/AccountInterface.php';

class BankAccount implements AccountInterface {
    const MIN_BALANCE = 0;

    protected $balance;
    protected $currency;

    public function __construct($currency = "USD", $balance = 0) {
        $this->currency = $currency;
        $this->balance = $balance;
    }

    public function deposit($amount) {
        if ($amount <= 0) {
            throw new Exception("Сума поповнення має бути додатною");
        }
        $this->balance += $amount;
    }

    public function withdraw($amount) {
        if ($amount <= 0) {
            throw new Exception("Сума зняття має бути додатною");
        }

        if ($amount > $this->balance) {
            throw new Exception("Недостатньо коштів");
        }

        $this->balance -= $amount;
    }

    public function getBalance() {
        return $this->balance . " " . $this->currency;
    }
}

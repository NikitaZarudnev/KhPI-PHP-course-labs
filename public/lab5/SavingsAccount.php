<?php

class SavingsAccount extends BankAccount {
    public static $interestRate = 0.05; // 5%

    public function applyInterest() {
        $interest = $this->balance * self::$interestRate;
        $this->balance += $interest;
    }
}

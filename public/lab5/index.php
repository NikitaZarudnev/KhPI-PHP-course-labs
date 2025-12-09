<?php

require_once __DIR__ . '/BankAccount.php';
require_once __DIR__ . '/SavingsAccount.php';

echo "<h2>Тестування банківських рахунків</h2>";

try {
    $account = new BankAccount("USD", 100);
    echo "Початковий баланс: " . $account->getBalance() . "<br>";

    $account->deposit(50);
    echo "Після поповнення: " . $account->getBalance() . "<br>";

    $account->withdraw(30);
    echo "Після зняття: " . $account->getBalance() . "<br><br>";

    $savings = new SavingsAccount("EUR", 200);
    echo "Баланс накопичувального рахунку: " . $savings->getBalance() . "<br>";

    $savings->deposit(100);
    echo "Після поповнення: " . $savings->getBalance() . "<br>";

    $savings->applyInterest();
    echo "Після нарахування відсотків: " . $savings->getBalance() . "<br><br>";

    $test = new BankAccount("UAH", 20);
    $test->withdraw(50);

} catch (Exception $e) {
    echo "<b>Помилка:</b> " . $e->getMessage();
}

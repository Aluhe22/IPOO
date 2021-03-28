<?php
include 'CuentaBancaria.php';

//PROGRAMA PRINCIPAL
//int $cuenta
$cuenta = new CuentaBancaria(123, 39584581, 100, 10);

$cuenta -> actualizarSaldo();
echo "\n----------------------\n";
echo $cuenta;
$cuenta -> depositar(100);
echo "\n----------------------\n";
echo $cuenta;
$cuenta -> retirar(10);
echo " Se pudo hacer la operacion su saldo es: ".$cuenta -> getSaldoActual();
echo "\n----------------------\n";
echo $cuenta;
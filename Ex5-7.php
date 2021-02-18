<?php

class A
{
    public function foo()
    {
        static $x = 0;
        echo ++$x;
    }
}
$a1 = new A();
$a2 = new A();
$a1->foo(); // Вывод: 1. Так как перемення статична для данного класса и сохраняется значение $x после каждого запуска функции.
$a2->foo(); // Вывод: 2.
$a1->foo(); // Вывод: 3.
$a2->foo(); // Вывод: 4.


class A
{
    public function foo()
    {
        static $x = 0;
        echo ++$x;
    }
}
class B extends A
{
}
$a1 = new A();
$b1 = new B();
$a1->foo(); // Вывод: 1. х статичен для каждого запуска функции в каждом классе (Привязан к классу).
$b1->foo(); // Вывод: 1.
$a1->foo(); // Вывод: 2.
$b1->foo(); // Вывод: 2.



class A
{
    public function foo()
    {
        static $x = 0;
        echo ++$x;
    }
}
class B extends A
{
}
$a1 = new A;
$b1 = new B;
$a1->foo();
$b1->foo();
$a1->foo();
$b1->foo();

//Вывод будет тем же (1122), так как у нас нет функции __construct, объект остается таким же, ставим мы скобки при его создании или нет.

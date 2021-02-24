<?php

trait Singleton
{
    private static $instance;
    public static function GetInstance()
    {
        if (empty(self::$instance)) {
            self::$instance = new static();
        }
        return self::$instance;
    }
    private function __construct()
    {
    }
    private function __clone()
    {
    }
    private function __wakeup()
    {
    }
}

class MyClass
{
    use Singleton;
    static function Plus()
    {
        $instance = 0;
        return $instance += 1;
    }
}

//$a = new MyClass; // Не будет работать
echo MyClass::GetInstance()->Plus(); //Вывод: 1.

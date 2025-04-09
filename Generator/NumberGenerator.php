<?php

class NumberGenerator
{
    const BASE_NUMBER = "988988";

    const COUNT_NUMBER_GENERATE = "7";


    public function generate()
    {

        // Генерируем случайные 7 цифр (от 0 до 9)
        $randomNumbers = $this->generateRandomNumbers();

        // Полный набор цифр без контрольного числа
        $numberWithoutControl = sprintf('%s%s', self::BASE_NUMBER, $randomNumbers);

        // Вычисляем контрольное число
        $controlNumber = $this->calculateControlNumber($numberWithoutControl);

        // Результат. (Разделил пробелами, для лучшей читабельности)
        return sprintf('%s%s', chunk_split($numberWithoutControl, 1, ' '), $controlNumber);
    }


    /**
     * Генератор случайных чисел
     */
    private function generateRandomNumbers()
    {
        $randomNumbers = '';

        for($i = 0; $i < self::COUNT_NUMBER_GENERATE; $i++)
        {
            $randomNumbers .= rand(0, 9);
        }

        return $randomNumbers;
    }


    /**
     * Калькулятор контрольного числа
     */
    private function calculateControlNumber($number)
    {
        // Переворачиваем строку
        $reversedNumber = strrev($number);

        $sumOdd = 0; // Сумма нечетных чисел
        $sumEven = 0; // Сумма четных чисел

        // Проходим по каждой цифре и суммируем
        for($i = 0; $i < strlen($reversedNumber); $i++)
        {
            $num = (int) $reversedNumber[$i];

            if($i % 2 == 0)
            {
                // Нечетные числа, индексы: 0, 2, 4, 6 и т.д
                $sumOdd += $num;
            }
            else
            {
                // Четные числа, индексы: 1, 3, 5 и т.д
                $sumEven += $num;
            }
        }

        // Вычисляем итоговое значение
        $result = ($sumOdd * 3) + $sumEven;

        // Получаем последнюю цифру результата
        $lastNum = $result % 10;

        // Определяем контрольную цифру
        return $lastNum == 0 ? 0 : 10 - $lastNum;
    }
}
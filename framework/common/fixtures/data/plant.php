<?php

return [
    'apple-tree' => [
        'name' => 'Apple Tree', // название растения
        'lifespan' => 40, // длительность жизни, лет
        'temperature_min' => -30, // минимальная температура в сезон
        'temperature_max' => 35, // максимальная температура в сезон
        'humidity_min' => 5, // минимальная влажность, проценты
        'humidity_max' => 60,  // максимальная влажность, проценты
        'precipitation_min' => 50, // минимальное количество осадков в сезон, мм
        'precipitation_max' => 500,  // максимальное количество осадков в сезон, мм
        'sunshine_min' => 80, // минимальное количество солнечных часов в сезон, часы
        'sunshine_max' => 900, // максимальное количество солнечных часов в сезон, часы
        'wind_min' => 0,
        'wind_max' => 20
    ],
    // арбуз - показатели произвольные, для примера
    'watermelon-plant' => [
        'name' => 'Watermelon Plant',
        'lifespan' => 1, // длительность жизни, лет
        'temperature_min' => 20, // минимальная температура в сезон
        'temperature_max' => 40, // максимальная температура в сезон
        'humidity_min' => 30, // минимальная влажность, проценты
        'humidity_max' => 70,  // максимальная влажность, проценты
        'precipitation_min' => 300, // минимальное количество осадков в сезон, мм
        'precipitation_max' => 800,  // максимальное количество осадков в сезон, мм
        'sunshine_min' => 300, // минимальное количество солнечных часов в сезон, часы
        'sunshine_max' => 2000, // максимальное количество солнечных часов в сезон, часы
        'wind_min' => 0,
        'wind_max' => 10
    ]
];

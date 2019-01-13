<?php

/**
 * @param array $array
 * @return array|bool
 */
function arraySort(array $array)
{
    if (empty($array)) {
        return false;
    }

    uasort($array, 'dateSort');

    return $array;
}

/**
 * @param array $a
 * @param array $b
 * @return int
 */
function dateSort(array $a, array $b): int
{
    $aDate = strtotime($a['date']);
    $bDate = strtotime($b['date']);

    if ($aDate === $bDate) {
        return 0;
    }
    if ($aDate > $bDate) {
        return -1;
    }
    return 1;
}

$array = [
    [
        'name' => 'test1',
        'date' => '18.05.2018 18:32:45',
    ],
    [
        'name' => 'test2',
        'date' => '18.06.2018 18:32:45',
    ],
    [
        'name' => 'test3',
        'date' => '18.04.2018 18:32:45',
    ],
];
$array = arraySort($array);

foreach ($array as $item) {
    $date = DateTime::createFromFormat('d.m.Y H:i:s', $item['date'])->format('Y-m-d H:i:s');
    echo '"', $item['name'], '" от "', $date, '"', '<br>';
}

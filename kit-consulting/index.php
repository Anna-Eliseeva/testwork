<?php

/**
 * @param string $url
 * @return array|false
 */
function prepareURL(string $url)
{
    if (empty($url)) {
        return false;
    }

    if (!filter_var($url, FILTER_VALIDATE_URL)) {
        return false;
    }

    $result = [];

    [$result['scheme'], $url] = explode('://', $url, 2);
    [$result['host'], $url] = explode('/', $url, 2);
    [$result['path'], $result['query']] = explode('?', $url, 2);
    $result['path'] = '/' . $result['path'];

    $tmp = explode('&', $result['query']);
    foreach ($tmp as $item) {
        [$key, $value]  = explode('=', $item);
        $result[$key] = $value;
    }

    return $result;
}

prepareURL('http://example.com/app.php?id=10&type=payment&status=paid');
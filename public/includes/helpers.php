<?php

/**
 * Debug
 *
 * @param $object
 * @param bool $kill
 */
function d($object, $kill = true)
{
    echo '<pre style="text-align:left">';
    print_r($object);
    if ($kill) {
        die('END');
    }
    echo '</pre>';
}

/**
 * Get a value from $_POST / $_GET
 * if unavailable, take a default value
 *
 * @param $key
 * @param null $default
 *
 * @return bool|null|string
 */
function getValue($key, $default = null)
{
    if (!isset($key) || empty($key) || !is_string($key)) {
        return false;
    }

    $value = (isset($_POST[$key]) ? $_POST[$key] : (isset($_GET[$key]) ? $_GET[$key] : $default));

    if (is_string($value)) {
        return stripslashes(urldecode(preg_replace('/((\%5C0+)|(\%00+))/i', '', urlencode($value))));
    }

    return $value;
}

function redirect($url)
{
    ob_clean();
    header('Location:' . $url);
    exit;
}

/**
 * Show alerts. Use bootstrap type alerts. Default 'info'
 *
 * @param $message
 * @param string $type
 */
function flash($message, $type = 'info')
{
    $flash = [
        'message' => $message,
        'type' => $type
    ];

    $_SESSION['flash'][] = $flash;
}

function displayFlash()
{
    if (!empty($_SESSION['flash'])) {
        foreach ($_SESSION['flash'] as $flash) {
            echo '<div class="alert alert-' . $flash['type'] . '">' . $flash['message'] . '</div>';
        }
        unset($_SESSION['flash']);
    }
}
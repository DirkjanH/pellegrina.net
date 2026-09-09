<?php

// LP maintenance pages handle trusted admin workflows, but request data is still untrusted.
function lp_int($value, $default = 0)
{
    $validated = filter_var($value, FILTER_VALIDATE_INT);
    return $validated === false ? $default : $validated;
}

function lp_html($value)
{
    return htmlspecialchars((string) ($value ?? ''), ENT_QUOTES, 'UTF-8');
}

// Debug dumps can expose personal and financial data; never render them in production.
if (class_exists('Kint')) {
    Kint::$enabled_mode = false;
}

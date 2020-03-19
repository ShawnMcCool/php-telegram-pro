<?php

function d(...$targets): void
{
    echo '<pre>';
    var_dump(...$targets);
    echo '</pre>';
}

function dd(...$targets): void
{
    d(...$targets);
    exit;
}
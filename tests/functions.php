<?php

function d(...$targets): void
***REMOVED***
    echo '<pre>';
    var_dump(...$targets);
    echo '</pre>';
***REMOVED***

function dd(...$targets): void
***REMOVED***
    d(...$targets);
    exit;
***REMOVED***
<?php

declare(strict_types=1);

/**
 * Nicely formatted var_dump for WAMP / MAMP 
 * installations without nicely formatted var_dump functions.
 *
 * @param mixed $something
 * @return void - 'void' is like 'null', but literally means "does not return anything at all"
 */
function prettyDump($something)
{
    echo '<pre><code>';
    var_dump($something);
    echo '</code></pre>';
}
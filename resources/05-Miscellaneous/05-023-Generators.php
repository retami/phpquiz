<?php

// Generators
// --
// Write a generator function <code>abc()</code>that returns the characters of the english alphabet.
// php
foreach(abc() as $c) {
    echo $c.PHP_EOL;
}
// --
// php
function abc(): Generator
{
    for ($a = ord('a'), $i = 0; $i <= 25; $i++) {
        yield chr($a + $i);
    }
}



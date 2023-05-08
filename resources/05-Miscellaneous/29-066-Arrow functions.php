<?php

// Arrow functions
// --
// What will be the output of the following PHP code?

// php
$y = 1;
$fn = fn ($x) => $x + $y++;
$fn(3);
echo $y;
// --
// plain
// int(1)
// --
// text
// <quote>Arrow functions support the same features as anonymous functions, except that using variables from the parent scope is always automatic. When a variable used in the expression is defined in the parent scope it will be implicitly captured <em>by-value</em>.</quote>
// --
// www.php.net/manual/en/functions.arrow.php


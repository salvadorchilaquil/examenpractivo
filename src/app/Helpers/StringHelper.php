<?php

function shortText($text, $max_lenght = 25)
{
    return mb_strimwidth($text, 0, $max_lenght, "...");
}
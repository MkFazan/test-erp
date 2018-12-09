<?php

/**
 * @param $data
 * @return string
 */
function dateFormat($data)
{
    return \Carbon\Carbon::parse($data)->format('Y-m-d');
}
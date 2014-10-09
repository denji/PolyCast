<?php

/**
 * Returns the value as an int, or false if it cannot be safely cast
 * @param mixed $val
 * @return int
 */
function to_int($val)
{
    switch (gettype($val)) {
        case "integer":
            return $val;
        case "double":
            return ($val === (float) (int) $val) ? (int) $val : false;
        case "string":
            $val = trim($val, " \t\n\r\v\f"); // trim whitespace
            return filter_var($val, FILTER_VALIDATE_INT);
        default:
            return false;
    }
}

/**
 * Returns the value as a float, or false if it cannot be safely cast
 * @param mixed $val
 * @return float
 */
function to_float($val)
{
    switch (gettype($val)) {
        case "double":
            return $val;
        case "integer":
            return (float) $val;
        case "string":
            $val = trim($val, " \t\n\r\v\f"); // trim whitespace
            return filter_var($val, FILTER_VALIDATE_FLOAT);
        default:
            return false;
    }
}

/**
 * Returns the value as a string, or false if it cannot be safely cast
 * @param mixed $val
 * @return string
 */
function to_string($val)
{
    switch (gettype($val)) {
        case "string":
            return $val;
        case "integer":
        case "double":
            return (string) $val;
        case "object":
            if (method_exists($val, "__toString")) {
                return $val->__toString();
            } else {
                return false;
            }
        default:
            return false;
    }
}

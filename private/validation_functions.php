<?php 

function is_blank($value)
{
     return (!isset($value) || trim($value) ==='');
}

function  has_presence($value)
{
    return !is_blank($value);
}

function has_length_greater_than($value, $min)
{
    return strlen($value)>$min;
}

function has_length_less_than($value, $max)
{
    return strlen($value)<$max;
}

function has_length_equal($value, $exact)
{
    return strlen($value)== $exact;
}

function has_length($value, $options)
{
    if(isset($options['min']) && !has_length_greater_than($value,$options['min']-1 ))
    {
        return false;
    }
    elseif(isset($options['max']) && !has_length_less_than($value,$options['max']-1 ))
    {
        return false;
    }
    elseif(isset($options['exact']) && !has_length_equal($value,$options['exact'] ))
    {
        return false;
    }
    else
    {
        return true;
    }
}

function has_inclussion_of($value, $set)
{
    return in_array($value, $set);
}

function has_exclussion_of($value, $set)
{
    return !in_array($value, $set);
}

function has_string($value, $req_string)
{
    return strpos($value, $req_string)!==false;
}

function has_valid_email($email_address)
{
    $email_reqex='/\A[A-Z0-9._%+-]+@[A-z0-9.-]+\.[A-z]{2,}\Z/i';
    return preg_match($email_reqex, $email_address)===1;
}
?>
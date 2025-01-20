<?php
class MY_Output extends CI_Output {

function _display_cache(&$CFG, &$URI)
{
    /* Disable Globally */
    return FALSE;

    /* OR - Disable for a specific IP Address */
    if ( ($_SERVER['REMOTE_ADDR'] == '127.0.0.1') || (eregi("192.168.", $_SERVER['REMOTE_ADDR'])) )
    {
        return FALSE;
    }

    /* OR - disable based on a cookie value */
    if ( (isset($_COOKIE['nocache'])) && ( $_COOKIE['nocache'] > 0 ) )
    {
        return FALSE;
    }

    /* Call the parent function */
    return parent::_display_cache($CFG,$URI);
}
}

?>
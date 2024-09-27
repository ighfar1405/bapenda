<?php
if (!function_exists('format_idr')) {
    function format_idr($nominal, $withPrefix = false)
    {
        $rupiah = number_format($nominal, 2, ',', '.');

        if($withPrefix)
            return 'Rp. ' . $rupiah;
        
        return $rupiah;
    }
}
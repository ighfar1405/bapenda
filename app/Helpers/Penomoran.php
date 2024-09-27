<?php

if (!function_exists('nomor_fix')) {
    function nomor_fix($format, $nomor, $tahun)
    {
        $format = explode('/', $format);
        $nomorFix = '';
        foreach ($format as $key => $value) {
            $found = false;
            if (preg_match('/{nomor:/', $value)) {
                $awal = preg_replace("/[^0-9]/", "", $value);
                $nomorFix .= str_pad($nomor, $awal, "0", STR_PAD_LEFT);
                $found = true;
            }

            if (preg_match('/{tahun}/', $value)) {
                $tahun = str_replace('{tahun}', $tahun, $value);
                $nomorFix .= $tahun;
                $found = true;
            }

            if (!$found) {
                $nomorFix .= $value;
                if ($key != count($format)) {
                    $nomorFix .= '/';
                }
            } else {
                if (isset($format[$key + 1])) {
                    $nomorFix .= '/';
                }
            }
        }

        return $nomorFix;
    }
}

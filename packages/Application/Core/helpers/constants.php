<?php

if (!defined('OFFERS_MODULE_SCREEN_NAME')) {
    define('CORE_MODULE_SCREEN_NAME', 'CORE');
}

function check_database_connection()
{
    try {
        DB::connection()->reconnect();
        return true;
    } catch (Exception $ex) {
        return false;
    }
}

if (!function_exists('get_file_data')) {
    /**
     * @param $file
     * @param $convert_to_array
     * @return bool|mixed
     * @author Sang Nguyen
     */
    function get_file_data($file, $convert_to_array = true)
    {
        $file = File::get($file);
        if (!empty($file)) {
            if ($convert_to_array) {
                return json_decode($file, true);
            } else {
                return $file;
            }
        }
        return false;
    }
}

function save_file_data($path, $data, $json = true)
{
    try {
        if ($json) {
            $data = json_encode_prettify($data);
        }
        File::put($path, $data);
        return true;
    } catch (Exception $ex) {
        return false;
    }
}

if (!function_exists('json_encode_prettify')) {
    /**
     * @param $data
     * @return string
     */
    function json_encode_prettify($data)
    {
        return json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
    }
}

if (!function_exists('scan_folder')) {
    /**
     * @param $path
     * @param array $ignore_files
     * @return array
     */

    function scan_folder($path, $ignore_files = [])
    {
        try {
            if (is_dir($path)) {
                $data = array_diff(scandir($path), array_merge(['.', '..'], $ignore_files));
                natsort($data);
                return $data;
            }
            return [];
        } catch (Exception $ex) {
            return [];
        }
    }
}
<?php
/*
Plugin Name: Append File Hash
Plugin Group: Media Library
Plugin URI: https://github.com/lonelyplanet/append-file-hash
Version: 1.0.0
Description: Append a file hash to file names for media library uploads.
Author: Eric King
Author URI: http://webdeveric.com/
*/

namespace LonelyPlanet\AppendFileHash;

function shortFileHash($hash, $filepath)
{
    if (is_readable($filepath)) {
        return substr(md5_file($filepath), 0, 12);
    }

    return $hash;
}

function checkFiletypeAndExt(array $data, $filepath, $filename, $mimes)
{
    $hash = apply_filters('append-file-hash', false, $filepath);

    if ($hash !== false) {
        $clean_filename = sprintf(
            '%s-%s',
            pathinfo(sanitize_file_name($filename), PATHINFO_FILENAME),
            $hash
        );

        if (isset($data['ext']) && $data['ext']) {
            $clean_filename .= '.' . strtolower($data['ext']);
        }

        $data['proper_filename'] = $clean_filename;
    }

    return $data;
}

add_filter('wp_check_filetype_and_ext', __NAMESPACE__ . '\checkFiletypeAndExt', 10, 4);
add_filter('append-file-hash', __NAMESPACE__ . '\shortFileHash', 10, 2);

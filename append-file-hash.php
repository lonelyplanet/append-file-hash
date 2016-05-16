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

function md5FileHash($hash, $data, $filepath, $filename, $mimes)
{
    $md5Hash = md5_file($filepath);

    return $md5Hash !== false ? substr($md5Hash, 0, 12) : $hash;
}

function buildProperFilename($properFilename, $cleanFilename, $hash, $ext, $filepath, $mimes)
{
    $ext = $ext ? '.' . strtolower($ext) : '';

    return "{$cleanFilename}-{$hash}{$ext}";
}

function checkFiletypeAndExt(array $data, $filepath, $filename, $mimes)
{
    $hash = apply_filters('afh-file-hash', false, $data, $filepath, $filename, $mimes);

    if ($hash !== false) {
        $data['proper_filename'] = apply_filters(
            'afh-proper-filename',
            $data['proper_filename'],
            pathinfo(sanitize_file_name($filename), PATHINFO_FILENAME),
            $hash,
            $data['ext'],
            $filepath,
            $mimes
        );
    }

    return $data;
}

add_filter('wp_check_filetype_and_ext', __NAMESPACE__ . '\checkFiletypeAndExt', 10, 4);
add_filter('afh-file-hash', __NAMESPACE__ . '\md5FileHash', 10, 5);
add_filter('afh-proper-filename', __NAMESPACE__ . '\buildProperFilename', 10, 6);

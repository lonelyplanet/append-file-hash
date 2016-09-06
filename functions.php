<?php

namespace LonelyPlanet\AppendFileHash;

function md5FileHash($hash, $data, $filepath, $filename, $mimes)
{
    $md5Hash = md5_file($filepath);

    return $md5Hash !== false ? substr($md5Hash, 0, 12) : $hash;
}

function buildProperFilename($properFilename, $cleanFilename, $hash, $ext, $filepath, $mimes)
{
    $ext = $ext ? '.' . strtolower($ext) : '';

    $filename = $properFilename ?: $cleanFilename;

    return "{$filename}-{$hash}{$ext}";
}

function checkFiletypeAndExt(array $data, $filepath, $filename, $mimes)
{
    $hash = apply_filters('afh-file-hash', false, $data, $filepath, $filename, $mimes);

    if ($hash !== false) {
        $data['proper_filename'] = apply_filters(
            'afh-proper-filename',
            $data['proper_filename'] ? pathinfo($data['proper_filename'], PATHINFO_FILENAME) : false,
            pathinfo(sanitize_file_name($filename), PATHINFO_FILENAME),
            $hash,
            $data['ext'],
            $filepath,
            $mimes
        );
    }

    return $data;
}

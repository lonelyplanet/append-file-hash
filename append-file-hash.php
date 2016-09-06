<?php
/*
Plugin Name: Append File Hash
Plugin Group: Media Library
Plugin URI: https://github.com/lonelyplanet/append-file-hash
Version: 1.0.1
Description: Append a file hash to file names for media library uploads.
Author: Eric King
Author URI: http://webdeveric.com/
*/

namespace LonelyPlanet\AppendFileHash;

require 'functions.php';

add_filter('wp_check_filetype_and_ext', __NAMESPACE__ . '\checkFiletypeAndExt', 20, 4);
add_filter('afh-file-hash', __NAMESPACE__ . '\md5FileHash', 10, 5);
add_filter('afh-proper-filename', __NAMESPACE__ . '\buildProperFilename', 10, 6);

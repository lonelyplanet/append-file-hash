# Append File Hash

This WordPress plugin will append a file hash to file names for media library uploads.

## Installation

```shell
composer require lonelyplanet/append-file-hash
```

## Filters

### Customize the file hash

By default, this plugin will use the [md5_file](http://php.net/md5_file) hash and append it to the filename.
If you'd like to customize the hash, you can use the `afh-file-hash` filter.

In this example, the sha1 file hash is returned.

```php
function sha1FileHash($hash, $data, $filepath, $filename, $mimes)
{
    return sha1_file($filepath);
}

add_filter('afh-file-hash', 'sha1FileHash', 10, 5);
```

### Customize the proper filename

```php
function customProperFilename($properFilename, $cleanFilename, $hash, $ext, $filepath, $mimes)
{
    // Build your filename here.

    return $properFilename;
}

add_filter('afh-proper-filename', 'customProperFilename', 10, 6);
```

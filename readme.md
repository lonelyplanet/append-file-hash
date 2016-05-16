# Append File Hash

Append a file hash to file names for media library uploads.

## Installation

### Composer

If you're using Composer to manage dependencies, please add the following to your project's `composer.json` file.

```json
"repositories": [
  {
    "type": "git",
    "url": "https://github.com/lonelyplanet/append-file-hash.git"
  }
],
```

**AND**

```json
"require": {
  "lonelyplanet/append-file-hash": "1.0.0"
}
```

## Filters

### Customize the file hash

By default, this plugin will use the md5 file hash and append it to the filename.
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

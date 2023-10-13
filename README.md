# Composer Version Parser

This small library allows to parse the version requirements from a `composer.json` file, allowing to get the probable version of a package (useful when no `composer.lock` is present).

Examples:

| Input    | Output  |
| --       | --      |
| `v1.0.*` | `1.0`   |
| `1.0.*`  | `1.0`   |
| `^3.*`   | `3`     |
| `^3.4.*` | `3.4`   |
| `^3.4`   | `3`     |
| `^3.4.9` | `3.4`   |
| `~3`     | `3`     |
| `~3.4`   | `3`     |
| `~3.4.9` | `3.4`   |
| `3`      | `3`     |
| `3.4`    | `3.4`   |
| `3.4.9`  | `3.4.9` |
| `3.*`    | `3`     |
| `3.4.*`  | `3.4`   |
| `v3`     | `3`     |
| `v3.4`   | `3.4`   |
| `v3.4.9` | `3.4.9` |
| `v3.*`   | `3`     |
| `v3.4.*` | `3.4`   |

More complex cases are not handled for now.

| Input                               | Output |
| --                                  | --     |
| `>1.0.*`                            | `null` |
| `>=1.0`                             | `null` |
| <code>>=1.0 &#124;&#124; 8.*</code> | `null` |
| `>=1.0; <2.0`                       | `null` |

## Install

```
composer require einenlum/composer-version-parser
```

## Usage

```php
<?php

require_once __DIR__ . '/vendor/autoload.php';

use Einenlum\ComposerVersionParser\Parser;

$parser = new Parser();
$parser->parse('v3.4.*'); // '3.4'
```

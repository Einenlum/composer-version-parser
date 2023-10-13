<?php

declare(strict_types=1);

namespace Einenlum\ComposerVersionParser;

class Parser
{
    public function parse(string $requirement): ?string
    {
        if (!preg_match('#^(\^|~|v)?((?:\d+\.?)*)(\*)?$#', $requirement, $matches)) {
            return null;
        }

        if ($matches[1] !== '') {
            $version = substr($requirement, 1);

            if (mb_strpos($version, '.') === false) {
                return $version;
            }

            if (in_array($matches[1], ['^', '~'], true) || str_ends_with($requirement, '.*')) {
                return $this->removePartAfterLastDot($version);
            }

            return $version;
        }

        if (str_ends_with($requirement, '.*')) {
            return mb_substr($requirement, 0, -2);
        }

        return $matches[2];
    }

    private function removePartAfterLastDot(string $version): string
    {
        if (strpos($version, '.') === false) {
            return $version;
        }

        $parts = explode('.', $version);

        return implode('.', array_slice($parts, 0, -1));
    }
}

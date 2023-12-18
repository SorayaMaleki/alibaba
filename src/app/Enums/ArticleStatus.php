<?php

namespace App\Enums;
enum ArticleStatus: string
{

    case draft = 'draft';
    case published = 'published';

    /**
     * Returns cases value or if value is null would return all enum cases value
     * @param array|null $cases
     * @return array
     */
    public static function values(array $cases = null): array
    {
        return array_column($cases, 'value');
    }
}

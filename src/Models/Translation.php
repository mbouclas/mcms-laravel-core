<?php

namespace IdeaSeven\Core\Models;

use Barryvdh\TranslationManager\Models\Translation as BaseTranslation;
use IdeaSeven\Core\QueryFilters\Filterable;
use Illuminate\Database\Eloquent\Model;
use Themsaid\Multilingual\Translatable;

class Translation extends BaseTranslation
{
    use Filterable;

}

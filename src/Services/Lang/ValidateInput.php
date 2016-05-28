<?php

namespace IdeaSeven\Core\Services\Lang;

use IdeaSeven\Core\Exceptions\InvalidTranslationInputException;
use Validator;

/**
 * Validate a translation variable before saving
 * 
 * Class ValidateInput
 * @package IdeaSeven\Core\Services\Lang
 */
class ValidateInput
{
    protected $locales;
    /**
     * ValidateInput constructor.
     * @param array $locales
     */
    public function __construct(array $locales)
    {
        $this->locales = $locales;
    }

    /**
     * @param $input
     * @return bool
     */
    public function handle($input)
    {

        $check = Validator::make($input, [
            'key' => 'required',
            'group' => 'required'
//            'group' => 'required,filled'
        ]);

        if ($check->fails()){
            throw new InvalidTranslationInputException('Invalid input');
        }

        return true;
    }
}
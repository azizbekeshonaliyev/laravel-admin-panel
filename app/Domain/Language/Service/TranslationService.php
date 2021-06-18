<?php

namespace App\Domain\Language\Service;

use Illuminate\Support\Facades\DB;
use App\Exceptions\GeneralException;
use Domain\Language\Entities\Translation;
use App\Domain\Core\Interfaces\ServiceInterface;

class TranslationService implements ServiceInterface
{
    private $translation;

    public function __construct(Translation $translation)
    {
        $this->translation = $translation;
    }

    public function findAll(array $filter)
    {
        $translations = $this->translation;

        if (isset($filter['locale'])) {
            $locale = $filter['locale'];
            $translations = $translations->where('locale', $locale);
        }

        if (isset($filter['frontend_only'])) {
            $frontend_only = boolval($filter['frontend_only']);

            if ($frontend_only) {
                $translations = $translations->where('key', 'LIKE', 'frontend.%');
            }
        }

        return $translations;
    }

    public function create(array $input)
    {
        return DB::transaction(function () use ($input) {
            $input['created_by'] = auth()->id();

            $input['key'] = 'frontend.'.$input['key'];

            if ($language = Translation::create($input)) {
                return $language;
            }

            throw new GeneralException(__('exceptions.backend.translations.create_error'));
        });
    }
}

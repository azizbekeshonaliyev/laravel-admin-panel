<?php

namespace App\Domain\Language\Service;

use DB;
use App\Exceptions\GeneralException;
use Domain\Language\Entities\Language;
use App\Domain\Core\Interfaces\ServiceInterface;

class LanguageService implements ServiceInterface
{
    private $language;

    private $sortable = [
        'id',
        'active',
        'rank',
        'created_at',
        'updated_at',
    ];

    public function __construct(Language $language)
    {
        $this->language = $language;
    }

    public function findAll(array $filter)
    {
        $languages = $this->language;

        if (array_key_exists('active', $filter)) {
            $languages = $languages->active(boolval($filter['active']));
        }

        return $languages;
    }

    public function create(array $input)
    {
        return DB::transaction(function () use ($input) {
            $input['created_by'] = auth()->id();

            if (isset($input['active'])) {
                $input['active'] = boolval($input['active']);
            } else {
                $input['active'] = false;
            }

            if ($language = Language::create($input)) {
                return $language;
            }

            throw new GeneralException(__('exceptions.backend.blogs.create_error'));
        });
    }

    public function update(Language $language, array $input)
    {
        $input['updated_by'] = auth()->id();

        if (isset($input['active'])) {
            $input['active'] = boolval($input['active']);
        } else {
            $input['active'] = false;
        }

        return DB::transaction(function () use ($language, $input) {
            if ($language->update($input)) {
                return $language->fresh();
            }

            throw new GeneralException(__('exceptions.backend.languages.update_error'));
        });
    }

    public function retrieveList(array $options)
    {
        $languages = $this->findAll($options);

        $perPage = isset($options['per_page']) ? (int) $options['per_page'] : 20;
        $orderBy = isset($options['order_by']) && in_array($options['order_by'], $this->sortable) ? $options['order_by'] : 'rank';
        $order = isset($options['order']) && in_array($options['order'], ['asc', 'desc']) ? $options['order'] : 'desc';
        $languages = $languages->active()->orderBy($orderBy, $order);

        return $languages->paginate($perPage);
    }

    public function delete(Language $language)
    {
        if (in_array($language->locale, ['uz', 'ru', 'en'])) {
            throw new GeneralException(__('exceptions.backend.languages.delete_error'));
        }

        return $language->delete();
    }
}

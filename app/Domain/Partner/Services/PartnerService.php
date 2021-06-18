<?php

namespace App\Domain\Partner\Services;

use Illuminate\Support\Facades\DB;
use App\Exceptions\GeneralException;
use Domain\Partner\Entities\Partner;
use App\Domain\Core\Interfaces\ServiceInterface;

class PartnerService implements ServiceInterface
{
    private $partner;

    private $sortable = [
        'id',
        'active',
        'rank',
        'created_at',
        'updated_at',
    ];

    public function __construct(Partner $partner)
    {
        $this->partner = $partner;
    }

    public function findAll(array $filter)
    {
        $partners = $this->partner;

        if (isset($filter['search_text'])) {
            $search = $filter['search_text'];
            $partners = $partners->whereTranslationLike('name', "%$search%")
                ->orWhereTranslationLike('desc', "%$search%");
        }

        if (array_key_exists('active', $filter)) {
            $partners = $partners->active(boolval($filter['active']));
        }

        return $partners;
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

            $cover_image = $input['cover_image'] ?? null;
            unset($input['cover_image']);

            $translations = $input['translations'];
            unset($input['translations']);

            if ($partner = Partner::create($input)) {
                // Inserting associated translation's id in mapper table
                if (count($translations)) {
                    foreach ($translations as $locale => $values) {
                        if ($values['name'] || $values['desc']) {
                            $partner->translations()->createMany([
                                [
                                    'locale' => $locale,
                                    'name' => $values['name'],
                                    'desc' => $values['desc'],
                                ],
                            ]);
                        }
                    }
                }

                if ($cover_image) {
                    $partner->album->setImageAsCover($cover_image);
                }

                return $partner;
            }

            throw new GeneralException(__('exceptions.backend.partners.create_error'));
        });
    }

    public function update(Partner $partner, array $input)
    {
        $input['updated_by'] = auth()->id();

        $translations = $input['translations'];
        unset($input['translations']);

        if (isset($input['active'])) {
            $input['active'] = boolval($input['active']);
        } else {
            $input['active'] = false;
        }

        $cover_image = $input['cover_image'] ?? null;
        unset($input['cover_image']);

        return DB::transaction(function () use ($partner, $input, $translations, $cover_image) {
            if ($partner->update($input)) {
                if ($cover_image) {
                    $partner->album->setImageAsCover($cover_image);
                }

                $partner->translations()->delete();

                if (count($translations)) {
                    foreach ($translations as $locale => $values) {
                        if ($values['name'] || $values['desc']) {
                            $partner->translations()->createMany([
                                [
                                    'locale' => $locale,
                                    'name' => $values['name'],
                                    'desc' => $values['desc'],
                                ],
                            ]);
                        }
                    }
                }

                return $partner->fresh();
            }

            throw new GeneralException(__('exceptions.backend.partners.update_error'));
        });
    }

    public function delete(Partner $partner)
    {
        return $partner->delete();
    }

    public function retrieveList(array $options)
    {
        $partners = $this->findAll($options);

        $perPage = isset($options['per_page']) ? (int) $options['per_page'] : 20;
        $orderBy = isset($options['order_by']) && in_array($options['order_by'], $this->sortable) ? $options['order_by'] : 'rank';
        $order = isset($options['order']) && in_array($options['order'], ['asc', 'desc']) ? $options['order'] : 'desc';
        $partners = $partners->active()->orderBy($orderBy, $order);

        return $partners->paginate($perPage);
    }
}

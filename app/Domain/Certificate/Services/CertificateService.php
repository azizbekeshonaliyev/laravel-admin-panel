<?php

namespace App\Domain\Certificate\Services;

use Illuminate\Support\Facades\DB;
use App\Exceptions\GeneralException;
use Domain\Certificate\Entities\Certificate;
use App\Domain\Core\Interfaces\ServiceInterface;

/**
 * Class CertificateService.
 * @author Azizbek Eshonaliyev <1996azizbekeshonaliyev@email.com>
 */
class CertificateService implements ServiceInterface
{
    private $certificate;

    private $sortable = [
        'id',
        'active',
        'rank',
        'created_at',
        'updated_at',
    ];

    public function __construct(Certificate $certificate)
    {
        $this->certificate = $certificate;
    }

    public function findAll(array $filter)
    {
        return $this->certificate;
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

            if ($certificate = Certificate::create($input)) {
                // Inserting associated translation's id in mapper table
                if (count($translations)) {
                    foreach ($translations as $locale => $values) {
                        if ($values['name'] || $values['desc']) {
                            $certificate->translations()->createMany([
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
                    $certificate->album->setImageAsCover($cover_image);
                }

                return $certificate;
            }

            throw new GeneralException(__('exceptions.backend.certificates.create_error'));
        });

    }

    public function update(Certificate $certificate, array $input)
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

        return DB::transaction(function () use ($certificate, $input, $translations, $cover_image) {
            if ($certificate->update($input)) {
                if ($cover_image) {
                    $certificate->album->setImageAsCover($cover_image);
                }

                $certificate->translations()->delete();

                if (count($translations)) {
                    foreach ($translations as $locale => $values) {
                        if ($values['name'] || $values['desc']) {
                            $certificate->translations()->createMany([
                                [
                                    'locale' => $locale,
                                    'name' => $values['name'],
                                    'desc' => $values['desc'],
                                ],
                            ]);
                        }
                    }
                }

                return $certificate->fresh();
            }

            throw new GeneralException(__('exceptions.backend.certificates.update_error'));
        });
    }

    public function delete(Certificate $certificate)
    {
        return $certificate->delete();
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

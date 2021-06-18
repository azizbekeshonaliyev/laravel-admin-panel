<?php

namespace App\Domain\Topic\Services;

use Domain\Topic\Entities\Topic;
use Illuminate\Support\Facades\DB;
use App\Exceptions\GeneralException;
use App\Domain\Core\Interfaces\ServiceInterface;

/**
 * Class TopicService.
 * @author Azizbek Eshonaliyev <1996azizbekeshonaliyev@email.com>
 */
class TopicService implements ServiceInterface
{
    private $topics;

    private $sortable = [
        'id',
        'active',
        'rank',
        'published_at',
        'created_at',
        'updated_at',
    ];

    public function __construct(Topic $topics)
    {
        $this->topics = $topics;
    }

    public function findAll(array $filter)
    {
        $topics = $this->topics;

        if (isset($filter['category_id'])) {
            $category_id = $filter['category_id'];
            $topics = $topics->where('catalog_category_id', $category_id);
        }

        if (isset($filter['search_text'])) {
            $search = $filter['search_text'];
            $topics = $topics->whereTranslationLike('name', "%$search%")
                ->orWhereTranslationLike('desc', "%$search%");
        }

        if (array_key_exists('active', $filter)) {
            $topics = $topics->active(boolval($filter['active']));
        }

        return $topics;
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

            if ($topic = Topic::create($input)) {
                // Inserting associated translation's id in mapper table
                if (count($translations)) {
                    foreach ($translations as $locale => $values) {
                        if ($values['title'] || $values['desc'] || $values['meta_title'] || $values['meta_description'] || $values['meta_keywords']) {
                            $topic->translations()->createMany([
                                [
                                    'locale' => $locale,
                                    'title' => $values['title'],
                                    'desc' => $values['desc'],
                                    'meta_title' => $values['meta_title'],
                                    'meta_description' => $values['meta_description'],
                                    'meta_keywords' => $values['meta_keywords'],
                                ],
                            ]);
                        }
                    }
                }

                if ($cover_image) {
                    $topic->album->setImageAsCover($cover_image);
                }

                return $topic;
            }

            throw new GeneralException(__('exceptions.backend.topics.create_error'));
        });
    }

    public function update(topic $topic, array $input)
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

        return DB::transaction(function () use ($topic, $input, $translations, $cover_image) {
            if ($topic->update($input)) {
                if ($cover_image) {
                    $topic->album->setImageAsCover($cover_image);
                }

                $topic->translations()->delete();

                if (count($translations)) {
                    foreach ($translations as $locale => $values) {
                        if ($values['title'] || $values['desc'] || $values['meta_title'] || $values['meta_description'] || $values['meta_keywords']) {
                            $topic->translations()->createMany([
                                [
                                    'locale' => $locale,
                                    'title' => $values['title'],
                                    'desc' => $values['desc'],
                                    'meta_title' => $values['meta_title'],
                                    'meta_description' => $values['meta_description'],
                                    'meta_keywords' => $values['meta_keywords'],
                                ],
                            ]);
                        }
                    }
                }

                return $topic->fresh();
            }

            throw new GeneralException(__('exceptions.backend.topics.update_error'));
        });
    }

    public function retrieveList(array $options)
    {
        $topics = $this->findAll($options);

        $perPage = isset($options['per_page']) ? (int) $options['per_page'] : 20;
        $orderBy = isset($options['order_by']) && in_array($options['order_by'], $this->sortable) ? $options['order_by'] : 'created_at';
        $order = isset($options['order']) && in_array($options['order'], ['asc', 'desc']) ? $options['order'] : 'desc';
        $topics = $topics->active()->orderBy($orderBy, $order);

        return $topics->paginate($perPage);
    }

    public function delete(topic $topic)
    {
        return $topic->delete();
    }
}

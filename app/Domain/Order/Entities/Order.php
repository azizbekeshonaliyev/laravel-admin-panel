<?php

namespace Domain\Order\Entities;

use App\Models\Auth\User;
use App\Domain\Core\Entities\Entity;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Entity
{
    use SoftDeletes;

    protected $fillable = ['updated_by', 'status', 'name', 'phone', 'organization'];

    const STATUS_NEW = 'new';

    const STATUS_COMPLETED = 'completed';

    const STATUS_CANCELED = 'canceled';

    public function scopeStatus($query, $status = self::STATUS_NEW)
    {
        return $query->where('status', $status);
    }

    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
}

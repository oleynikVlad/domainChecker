<?php

namespace App\Modules\DomainChecker\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property int $user_id
 * @property string $url
 * @property int $check_interval
 * @property int $timeout
 * @property string $method
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Collection<int, \App\Modules\DomainChecker\Models\DomainCheck> $checks
 * @property-read int|null $checks_count
 * @property-read User $user
 * @method static Builder<static>|Domain newModelQuery()
 * @method static Builder<static>|Domain newQuery()
 * @method static Builder<static>|Domain query()
 * @method static Builder<static>|Domain whereCheckInterval($value)
 * @method static Builder<static>|Domain whereCreatedAt($value)
 * @method static Builder<static>|Domain whereId($value)
 * @method static Builder<static>|Domain whereMethod($value)
 * @method static Builder<static>|Domain whereTimeout($value)
 * @method static Builder<static>|Domain whereUpdatedAt($value)
 * @method static Builder<static>|Domain whereUrl($value)
 * @method static Builder<static>|Domain whereUserId($value)
 * @mixin \Eloquent
 */
class Domain extends Model
{
    protected $guarded = ['id'];

    protected static function booted()
    {
        static::creating(function ($domain) {
            $domain->user_id = auth()->id();
        });
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function checks(): HasMany
    {
        return $this->hasMany(DomainCheck::class);
    }
}

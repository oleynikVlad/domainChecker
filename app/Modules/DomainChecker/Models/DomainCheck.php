<?php

namespace App\Modules\DomainChecker\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property int $domain_id
 * @property int $status
 * @property int|null $http_code
 * @property int|null $response_time
 * @property string|null $error_message
 * @property string $checked_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder<static>|DomainCheck newModelQuery()
 * @method static Builder<static>|DomainCheck newQuery()
 * @method static Builder<static>|DomainCheck query()
 * @method static Builder<static>|DomainCheck whereCheckedAt($value)
 * @method static Builder<static>|DomainCheck whereCreatedAt($value)
 * @method static Builder<static>|DomainCheck whereDomainId($value)
 * @method static Builder<static>|DomainCheck whereErrorMessage($value)
 * @method static Builder<static>|DomainCheck whereHttpCode($value)
 * @method static Builder<static>|DomainCheck whereId($value)
 * @method static Builder<static>|DomainCheck whereResponseTime($value)
 * @method static Builder<static>|DomainCheck whereStatus($value)
 * @method static Builder<static>|DomainCheck whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class DomainCheck extends Model
{
    protected $guarded = ['id'];

    protected $casts = [
        'checked_at' => 'datetime',
        'status' => 'boolean',
    ];

    public function domain(): BelongsTo
    {
        return $this->belongsTo(Domain::class);
    }
}

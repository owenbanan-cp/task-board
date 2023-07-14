<?php

namespace Domain\Task\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $board_id
 * @property string $title
 * @property string $description
 * @property int $order
 */
class Task extends Model
{
    use SoftDeletes;
    use HasFactory;

    /**
     *  Set Attributes that are mass assignable
     *
     * @var array
     */
    protected $fillable = [
        'board_id',
        'title',
        'description',
        'due_date',
        'order',
    ];

    /**
     * Set relationship to Board Model
     *
     * @return BelongsTo
     */
    public function board(): BelongsTo
    {
        return $this->belongsTo(Board::class);
    }
}

<?php

namespace App\Models;

use Database\Factories\CardFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Card extends Model
{
    use HasFactory;

    /**
     * The table name.
     *
     * @var string
     */
    protected $table = 'cards';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'box_id',
        'question',
        'answer',
        'description'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [];

    /**
     * @return CardFactory
     */
    protected static function factory(): CardFactory
    {
        return CardFactory::new();
    }

    /**
     * return parent box
     *
     * @return BelongsTo
     */
    public function box(): BelongsTo
    {
        return $this->belongsTo(Box::class, 'box_id', 'id');
    }

    /**
     * return answers
     *
     * @return HasMany
     */
    public function answers(): HasMany
    {
        return $this->hasMany(UserAnswer::class, 'card_id', 'id');
    }

    /**
     * return last answer
     *
     * @return HasOne
     */
    public function last_answer(): HasOne
    {
        return $this->HasOne(UserAnswer::class, 'card_id', 'id');
    }
}

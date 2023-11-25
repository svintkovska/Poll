<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $question_id
 * @property int $user_id
 * @property Carbon|null $voted_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 */
class Vote extends Model
{
    use HasFactory;


    protected $fillable = [
        'question_id',
        'option_id',
        'user_id'
    ];

    public function getDates()
    {
        return [
            'voted_at'
        ];
    }

    public function question()
    {
        return $this->belongsTo(Question::class);
    }
    public function option()
    {
        return $this->belongsTo(Option::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}

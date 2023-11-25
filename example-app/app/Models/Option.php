<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $title
 * @property int $question_id
 * @property int $image_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 */
class Option extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'question_id',
        'image_id'
    ];

    public function question()
    {
        return $this->belongsTo(Question::class);
    }
    public function image()
    {
        return $this->belongsTo(Image::class);
    }
    public function votesCount()
    {
        return $this->votes()->count();
    }
    public function votes()
    {
        return $this->hasMany(Vote::class);
    }
}

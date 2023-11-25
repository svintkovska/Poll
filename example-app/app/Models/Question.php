<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $title
 * @property string $description
 * @property string $search
 * @property Carbon|null $start_at
 * @property Carbon|null $end_at
 * @property Image|null $image;
 * @property int $user_id
 * @property int $image_id
 * @property bool $active
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 */
class Question extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'start_at',
        'end_at',
        'user_id',
        'image_id',
        'active'
    ];
    public function getDates()
    {
        return [
            'start_at',
            'end_at',
            'created_at',
            'updated_at'
        ];
    }

    protected $casts = [
        'active' => 'boolean'

    ];

    public function image()
    {
        return $this->belongsTo(Image::class);
    }

    public function options()
    {
        return $this->hasMany(Option::class);
    }
    public function votes()
    {
        return $this->hasMany(Vote::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public function vote(User $user, $optionId)
    {
        if ($this->hasUserVoted($user)) {
            return 'already_voted';
        }

        $option = $this->options()->findOrFail($optionId);

        $vote = new Vote([
            'user_id' => $user->id,
            'option_id' => $option->id,
            'voted_at' => now(),
        ]);

        $this->votes()->save($vote);
        return 'voted_successfully';

    }
    public function hasUserVoted(User $user)
    {
        return $this->votes()->where('user_id', $user->id)->exists();
    }

    public function totalVotes()
    {
        return $this->votes()->count();
    }

    public function percentageVotes(Option $option)
    {
        return $this->totalVotes() > 0 ? ($option->votesCount() / $this->totalVotes()) * 100 : 0;
    }
    public function getUserVote(User $user)
    {
        return $this->votes()->where('user_id', $user->id)->first();
    }
}

<?php
declare(strict_types=1);

namespace App\Models;

use App\Models\Enum\TodoStatus;
use Illuminate\Database\Concerns\BuildsQueries;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    use HasFactory, BuildsQueries;

    public const string USER_ID = 'user_id';
    public const string TITLE = 'title';
    public const string DESCRIPTION = 'description';
    public const string STATUS = 'status';

    protected $fillable = [self::USER_ID, self::TITLE, self::DESCRIPTION, self::STATUS];

    protected $casts = [
        self::USER_ID => 'int',
        self::TITLE => 'string',
        self::DESCRIPTION => 'string|null',
        self::STATUS => TodoStatus::class,
    ];

    public function scopeByStatus(Builder $query, TodoStatus $status): Builder
    {
        return $query->where(self::STATUS, $status->asString());
    }

    public function getTitle(): string
    {
        return $this->{self::TITLE};
    }

    public function getDescription(): ?string
    {
        return $this->{self::DESCRIPTION};
    }

    public function getStatus(): TodoStatus
    {
        return $this->{self::STATUS};
    }

    public function getUser(): User
    {
        return $this->belongsTo(User::class)->limit(1)->first();
    }
}

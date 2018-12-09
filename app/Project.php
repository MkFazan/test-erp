<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    public const WORK = 'work';
    public const BOOK = 'book';
    public const COURSE = 'course';
    public const BLOG = 'blog';
    public const OTHER = 'other';

    /**
     * @return array
     */
    public static function getType()
    {
        return [
            self::WORK => 1,
            self::BOOK => 2,
            self::COURSE => 3,
            self::OTHER => 4,
        ];
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'user_id',
        'description',
        'organization',
        'start',
        'end',
        'role',
        'link',
        'skill_id',
        'type_id',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function skill()
    {
        return $this->belongsToMany(Skill::class, 'project_skills');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}

<?php

namespace App;

use App\Traits\HasCoins;
use App\Traits\Uuids;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use App\Traits\Referable;
use Laravel\Passport\HasApiTokens;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class User extends Authenticatable
{
    use Notifiable, HasRoles, Uuids, Referable, HasApiTokens, HasCoins;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * @return BelongsTo
     */
    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class);
    }

    public function version_users() : BelongsToMany {
        return $this->belongsToMany(Version_User::class);
    }
}

class Player extends Model
{
    public function user()
    {
        return $this->morphOne('App\User', 'userable');
    }

    protected $fillable = [
        'school',
        'education_id',
        'grade_id',
        'country',
        'state',
        'city_id'
    ];

    public function education() : HasOne {
        return $this->HasOne(Education::class);
    }

    public function grade() : HasOne {
        return $this->HasOne(Grade::class);
    }
}

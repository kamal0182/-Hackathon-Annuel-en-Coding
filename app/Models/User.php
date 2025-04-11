<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Laravel\Sanctum\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable  implements JWTSubject
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array&lt;int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array&lt;int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array&lt;string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }
    public function roles()
    {
        return $this->belongsToMany(Role::class,'user_roles');
    }
    public function teams()
    {
        return $this->belongsTo(Team::class);
    }
    public function hackathons()
    {
        return $this->hasMany(Hackathon::class);
    }
    public function team()
    {
        return $this->hasMany(Team::class,'creator_id');
    }
    public function hasRole($builder)
    {
        // return "dacac";
        $roles =  DB::table('user_roles')->join('users','user_roles.user_id','=' ,'users.id' )->join('roles','user_roles.role_id','=' ,'roles.id' )->where('users.id', '=' ,$builder->id)->select('users.name')->get();
        return $roles ;
        // $->whereHas('role',function (Builder $query){
        //     $query->where('name', 'admin');
        // })->get;
    }
    public function hasTeam()
    {
        return $this->team ;
        if($this->team)  {
            return true ;
        }
    }
    public function message()
    {
        return $this->hasMany(Message::class);
    }
}

<?php namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Application\Core\Models\Users\Roles;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','active'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = ['active' => 'boolean'];

    public function roles()
    {
        return $this->belongsToMany(Roles::class,'users_roles','user_id','role_id');
    }

    /**
     * Assign role to user.
     *
     * @param string $role
     *
     * @return Role
     */
    public function assignRole($role)
    {
        return $this->roles()->save(
            Roles::whereName($role)->firstOrFail()
        );
    }

    /**
     * Return true if user has given role.
     *
     * @param string|Collection $role
     *
     * @return bool
     */
    public function hasRole($role)
    {
        if (is_string($role)) {
            return $this->roles->contains('name', $role);
        }

        return !! $role->intersect($this->roles)->count();
    }

    public function findForPassport($identifier) {
        return User::orWhere("email", $identifier)->where("active", 1)->first();
    }




}

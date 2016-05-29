<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

use App\Traits\UserTrait;
use Laravel\Cashier\Billable;

class User extends Model implements AuthenticatableContract,
                                    AuthorizableContract,
                                    CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword;
    use UserTrait, Billable;
    use SoftDeletes;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['first_name', 'last_name', 'email', 'password', 'phone'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];
    
    /**
     * DB Relation Function
     *
     * @return void
     **/
    public function company()
    {
        return $this->belongsTo('App\Company');
    }

    /**
     * DB Relation Function
     *
     * @return void
     **/
    public function tickets()
    {
        return $this->hasMany('App\Ticket');
    }

    /**
     * DB Relation Function
     *
     * @return void
     **/
    public function rents()
    {
        return $this->hasMany('App\Rent');
    }

    /**
     * DB Relation Function
     *
     * @return void
     **/
    public function photos()
    {
        return $this->morphMany('App\Photo', 'imageable');
    }

    /**
     * DB Relation Function
     *
     * @return void
     **/
    public function transaction()
    {
        return $this->hasMany('App\Transaction');
    }

    /**
     * get Full name of the user
     *
     * @return string
     **/
    public function fullName()
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    /**
     * Query Users throught Emails
     *
     * @return $user
     * @author 
     **/
    public static function getByEmail($email)
    {
        return static::where('email', '=', $email)->first();
    }

    /**
     * get user if exist else create anomymous
     *
     * @return user
     * @author 
     **/
    public static function getUserOrCreateAnonymous($first, $last, $email, $phone)
    {
        $photo = new static;
        if (auth()->check()){
            $user = auth()->user();
        } else {
            if (is_null($user = User::getByEmail($email)) ) {
                $user = new static;
                $user->first_name = $first;
                $user->last_name = $last;
                $user->email = $email;
                $user->phone = $phone;
                $user->save();
            } 
        }
        return $user;
    }

}

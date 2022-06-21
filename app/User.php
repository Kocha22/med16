<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Notifications\CustomSendEmailVerificationNotification;


class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'surname'
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

    public function posts(){
        return $this->hasOne(Applicant::class, 'id', 'user_id');
    }

    public function roles() {
        return $this->belongsToMany('App\Models\Role'::class);
    }

    public function comments() {
        return $this->belongsToMany('App\Models\Comment'::class);
    }

    public function hasRole($roles) {
        if($this->roles()->where('name', $roles)->first()){
            return true;
        }
        return false;
    }

    public function isAdministrator() {
        return $this->roles()->where('name', 'Администратор')->exists();
     }

     public function isUser() {
        return $this->roles()->where('name', 'Менеджер')->exists();
     }

     public function isUser2() {
        return $this->roles()->where('name', 'Пользователь')->exists();
     }

     public function usersapp() {
        return $this->belongsToMany('App\Models\Applicant'::class);
    }

    public function usersatt() {
        return $this->belongsToMany('App\Models\Attestation'::class);
    }

    public function usersexp() {
        return $this->belongsToMany('App\Models\Experience'::class);
    }

    public function usersed() {
        return $this->belongsToMany('App\Models\Education'::class);
    }

    public function usersext() {
        return $this->belongsToMany('App\Models\Extra'::class);
    }

    public function usersformation() {
        return $this->belongsToMany('App\Models\Formation'::class);
    }

    public function sendEmailVerificationNotification()
    {
        $this->notify(new CustomSendEmailVerificationNotification); // my notification
    }

}

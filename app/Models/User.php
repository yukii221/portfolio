<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory;
    
    protected $fillable = [
        'name',
        'email',
        'password',
        'profile',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    
     public static $rules = array(
        'name' => 'required',
        'email' => 'required',
        );
        
    public function isAdmin()
    {
        // 管理者であるかを判定するロジックを実装する
        // 例えば、管理者フラグがtrueの場合などを判定する
        return $this->email === 'sakura.02.sksb@gmail.com';
    }
}

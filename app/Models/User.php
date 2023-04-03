<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'username'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function posts()
    {
        // One to Many
        return $this->hasMany(Post::class);
    }
    public function likes()
    {
        // One to Many
        return $this->hasMany(Like::class);
    }
    public function followers()
    {
        
        return $this->belongsToMany(User::class, 'followers', 'user_id', 'follower_id');
    }
    //En el caso de arriba estamos tenemos que definir las llaves foraneas y la tabla de donde sacara la relacion ya que nos estamos saliendo un poco de las convenciones de Larave

    // Comprobate if a user follow

    public function following(User $user)
    {
        return $this->followers->contains($user->id);
    }

    public function follow()
    {
        
        return $this->belongsToMany(User::class, 'followers', 'follower_id', 'user_id');
    }
    // Es exactamente igual al metodo "followers" solo que se cambia el roden de las columnas, antes era primer 'user_id' -> 'follower_id' ahora es 'follower_id' -> 'user_id'
    
    // Almacenar seguidores de un usuario



    // Almancenar los que seguimos
}

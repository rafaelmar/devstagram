<?php

namespace App\Http\Livewire;

use Livewire\Component;

class LikePost extends Component
{

    
    public $post; // Es necesario declarar la variable en php para poder usarla en el template
    public $isLiked;
    public $likes;

    public function mount($post) // El mount es exactamente igual a un constructor de PHP solo que en LiveWire y se le pasa el "post" para que sepa que informacion procesar
    {
        $this->isLiked = $post->checkLike(auth()->user());
        $this->likes = $post->likes->count();
    }

    //Deno hacer referencia al post actual y por eso le debo colocar $this antes de "post"

    public function like()
    {
        if($this->post->checkLike(auth()->user())){
            $this->post->likes()->where('post_id', $this->post->id)->delete(); // el This porque es la instancia que se esta pasando al LiveWire
            $this->isLiked = false; // es necesario sacar el resultado del "mount" ya que solo se cambia cuando es instanciado, al colocarlo dentro del evento "wire" ya se hara en render automatico
            $this->likes--;
        } else {
            $this->post->likes()->create([
                'user_id' => auth()->user()->id]);
            $this->isLiked = true;
            $this->likes++;
            
        }
        
    }

    public function render()
    {
        return view('livewire.like-post');
    }
}

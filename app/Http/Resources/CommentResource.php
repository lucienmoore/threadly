<?php

namespace App\Http\Resources;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

class CommentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request) : array
    {

        $avatarPath = $this->user->avatar ? "public/{$this->user->avatar}" : "avatars/user.svg";
        
        $avatarUrl = Storage::exists($avatarPath) ? Storage::url($this->user->avatar) : asset('storage/' . $avatarPath);

        // dd(Auth::user(), $this->user->can('update', $this));

        return [
            'id' => $this->id,
            'user_id' => $this->user_id,
            'name' => $this->user->name,
            'content' => $this->content,
            'created_at' => $this->created_at->diffForHumans(),
            'avatar_url' => $avatarUrl,
            'can_update' => Auth::user() ? Auth::user()->can('update', $this) : false,
            'can_delete' => Auth::user() ? Auth::user()->can('delete', $this) : false,
        ];
    }
}

<?php

namespace App\Http\Resources;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

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

        return [
            'name' => $this->user->name,
            'content' => $this->content,
            'created_at' => $this->created_at->diffForHumans(),
            'avatar_url' => $avatarUrl,
        ];
    }
}

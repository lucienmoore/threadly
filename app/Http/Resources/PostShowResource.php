<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostShowResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request) : array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'image' => $this->image,
            'name' => $this->user->name,
            'slug' => $this->slug,
            'votes' => $this->votes,
            'comments' => CommentResource::collection($this->whenLoaded('comments')),
            'postVotes' => $this->whenLoaded('postVotes'),
            'created_at' => $this->created_at->diffForHumans(),
        ];
    }
}

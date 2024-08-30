<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {

        $this->publish_date = date('Y-m-d',strtotime($this->publish_date));
    
        return [
            'id' => $this->id,
            'title' => $this->title,
            'body' => $this->body,
            'published' => $this->published,
            'excerpt' => $this->excerpt,
            'description' => $this->description,
            'user_id' => $this->user_id,
            'tags'=> $this->tags,
            'keywords'=> $this->keywords,
            'thumbnail_id' => $this->thumbnail_id,
            'publish_date' => $this->publish_date,
            'created_at' => $this->created_at->format('d/m/Y'),
            'updated_at' => $this->updated_at->format('d/m/Y'),
        ];
    }
}

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
  
        dd($request->all(),$this);
        return [
            'id' => $this->id,
            'title' => $this->title,
            'body' => $this->body,
            'published' => $this->published,
            'excerpt' => $this->excerpt,
            'description' => $this->description,
            'keywords' => $this->keywords,
            'user_id' => $this->user_id,
            'created_at' => $this->created_at->format('d/m/Y'),
            'updated_at' => $this->updated_at->format('d/m/Y'),
        ];
    }
}

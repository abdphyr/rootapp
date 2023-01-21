<?php

namespace App\Http\Resources\Ecommerce;

use Illuminate\Http\Resources\Json\JsonResource;

class TagResource extends JsonResource
{
  public function toArray($request)
  {
    return [
      'id' => $this->id,
      "name" => $this->name
    ];
  }
}
<?php

namespace Modules\Ibanners\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;
use Modules\User\Transformers\UserProfileTransformer;

class PositionApiTransformer extends JsonResource
{
  public function toArray($request)
  {
    return [
      'id' => $this->id,
      'name' => $this->name,
      'systemName' => $this->system_name,
      'active' => $this->active == 1 ? true : false,
      'options' => $this->when($this->options, $this->options),
      'createdAt' => $this->created_at,
      'banners' => BannerApiTransformer::collection($this->Banners),
    ];
  }
}

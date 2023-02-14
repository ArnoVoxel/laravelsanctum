<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\PartyUser;

class PartyResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $return = [
            'id' => $this->id,
            'label' => $this->label,
            'description' => $this->description,
            'date' => $this->date,
            'user_id' => $this->user_id,
            'table_members' => PartyUser::where('party_id', $this->id)->get(),
            'updated_at' => $this->updated_at,
        ];
        return $return;
    }
}

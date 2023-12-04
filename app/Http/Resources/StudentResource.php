<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StudentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'matricula' => $this->matricula,
            'nome' => $this->nome,
            'curso' => $this->curso,
            'email' => $this->email,
        ];
    }
}

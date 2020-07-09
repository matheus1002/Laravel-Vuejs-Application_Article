<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ArtigoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'titulo' => $this->titulo,
            'descricao' => $this->descricao
        ];
    }

    public function with($request)
    {
        return [
            'version' => '1.0.0',
            'author_url' => url('https://github.com/matheus1002')
        ];
    }
}

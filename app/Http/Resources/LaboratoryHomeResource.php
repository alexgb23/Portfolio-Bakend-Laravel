<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LaboratoryHomeResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            "summary" => $this->resource["summary"] ?? [],
            "featured_items" => $this->resource["featured_items"] ?? [],
            "clusters" => $this->resource["clusters"] ?? [],
            "servers" => $this->resource["servers"] ?? [],
            "nodes" => $this->resource["nodes"] ?? [],
            "metrics" => $this->resource["metrics"] ?? [],
            "home_assistant" => $this->resource["home_assistant"] ?? [],
            "local_ai" => $this->resource["local_ai"] ?? [],
            "capabilities" => $this->resource["capabilities"] ?? [],
        ];
    }
}

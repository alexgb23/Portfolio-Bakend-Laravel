<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ResearchMetricResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            "id" => $this->id,
            "research_source_id" => $this->research_source_id,
            "metric_name" => $this->metric_name,
            "metric_value" => $this->metric_value,
            "metric_unit" => $this->metric_unit,
            "measured_on" => $this->measured_on,
            "notes" => $this->notes,
            "status" => $this->status,
            "is_featured" => (bool) $this->is_featured,
            "sort_order" => (int) $this->sort_order,
        ];
    }
}

<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return array
     */
    public function toArray($request)
    {
        $pivotAttributes = $this->whenPivotLoaded('orderdetails', function () {
            return [
                'unit_price' => $this->pivot->priceEach,
                'qty'        => $this->pivot->quantityOrdered,
                'line_total' => $this->pivot->lineTotal,
            ];
        });

        return [
            'product'      => $this->productName,
            'product_line' => $this->productLine,
            'unit_price'   => (float)$pivotAttributes['unit_price'],
            'qty'   => $pivotAttributes['qty'],
            'line_total'   => $pivotAttributes['line_total'],
        ];
    }
}

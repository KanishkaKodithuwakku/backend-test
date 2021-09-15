<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class OrderResource extends JsonResource
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
             'order_id' => $this->orderNumber,
             'order_date' => $this->orderDate,
             'status' => $this->status,
             'order_details' => ProductResource::collection($this->whenLoaded('products')),
             'bill_total' => $this->billTotal,
             'customer' =>  new CustomerResource($this->whenLoaded('customer')),
        ];
    }
}

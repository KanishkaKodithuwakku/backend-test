<?php

namespace App\Http\Controllers;
use App\Http\Resources\OrderResource;
use Illuminate\Http\Request;
use App\Repository\QueryBuilder\OrderRepositoryInterface;
use App\Services\OrderService;

class OrdersController extends Controller
{
    private $orderRepository;
    private $orderService;

    public function __construct(OrderRepositoryInterface $orderRepository,OrderService $orderService) {
        $this->orderRepository = $orderRepository;
        $this->orderService    = $orderService;
    }
    /**
     * fetch order details
     * @param $id
     * @return array
     */
    public function fetchOrderData($id)
    {
        $payload = $this->orderRepository->findById($id, ['*'], ['products', 'customer']);
        //calculate the bill
        $billTotal = $this
            ->orderService
            ->calcBill($payload->products->pluck('pivot.line_total'));

        //apeend bill data to model
        $payload = $this->orderService->appendDatatoModel($payload,
            ['billTotal' => $billTotal]);

        return new OrderResource($payload);
    }

    public function fetchOrderDataUsingQueryBuilder($id)
    {
        $payload = $this->orderRepository->fetchOrderData((int)$id);

        return response()->json($payload, 200);
    }
}

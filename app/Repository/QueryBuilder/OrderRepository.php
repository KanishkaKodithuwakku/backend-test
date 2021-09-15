<?php

namespace App\Repository\QueryBuilder;

use Illuminate\Support\Facades\DB;

class OrderRepository extends BaseRepository implements OrderRepositoryInterface
{

    protected $table;

    public function __construct(string $table)
    {
        $this->table = $table;
    }

    public function fetchOrderData(int $id)
    {
        $result = [];

        $condition = [
            'key'   => 'orders.orderNumber', 'operator' => '=',
            'value' => $id,
        ];

        $orderData = $this->getOrderDeta($condition);

        if (is_null($orderData)) {
            return null;
        }

        $orderProductData  = $this->getOrderProductData($condition);
        $orderBillAmount   = $this->getOrderBillAmount($orderProductData);
        $orderCustomerData = $this->getOrderCustomerData($condition);

        $result['order_id']   = $id;
        $result['order_date'] = $orderData->order_date;
        $result['status']     = $orderData->status;

        $result['order_details'] = $orderProductData;

        $billAmount            = number_format($orderBillAmount, '2', '.', '');
        $result['bill_amount'] = $billAmount;

        $result['customer'] = $orderCustomerData;

        return $result;
    }

    public function getOrderDeta(array $condition)
    {

        $orderDataColumns = ['orderDate as order_date', 'status'];

        $orderData = $this->findById($condition, $orderDataColumns);

        return $orderData;
    }

    public function getOrderProductData(array $condition)
    {
        $orderDetailsColumns = [
            'products.productName as product',
            'products.productLine as product_line',
            'orderdetails.priceEach as unit_price',
            'orderdetails.quantityOrdered as qty',
            DB::raw('orderdetails.quantityOrdered*orderdetails.priceEach as line_total'),
        ];

        $OrderDetailsrelations = [
            [
                'table' => 'orderdetails',
                'keys'  => ['orders.orderNumber', 'orderdetails.orderNumber'],
            ],
            [
                'table' => 'products',
                'keys'  => ['products.productcode', 'orderdetails.productcode'],
            ],
        ];

        $orderDetailsData = $this->findAllById($condition, $orderDetailsColumns,
            $OrderDetailsrelations);

        //formatting numeric data
        foreach ($orderDetailsData as $data) {
            $data->line_total = number_format($data->line_total, '2', '.', '');
            $data->unit_price = (float) $data->unit_price;
        }

        return $orderDetailsData;
    }

    public function getOrderBillAmount($orderDetailsData)
    {
        $billAmount = 0;

        foreach ($orderDetailsData as $data) {
            $billAmount += $data->line_total;
        }

        return $billAmount;
    }

    public function getOrderCustomerData(array $condition)
    {
        $orderCustomerColumns = [
            'customers.contactFirstName as first_name',
            'customers.contactLastName as last_name', 'customers.phone',
            'customers.country as country_code',
        ];

        $orderCustomerRelations = [
            [
                'table' => 'customers',
                'keys'  => [
                    'orders.customerNumber', 'customers.customerNumber',
                ],
            ],
        ];

        $orderCustomerData = $this->findById($condition, $orderCustomerColumns,
            $orderCustomerRelations);

        return $orderCustomerData;
    }

}

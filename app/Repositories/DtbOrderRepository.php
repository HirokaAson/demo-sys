<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;

class DtbOrderRepository extends BaseRepository
{
    public function __construct()
    {
        parent::__construct('dtb_order');
    }

    public function getAll()
    {
        return $this->table->get();
    }

    public function find($order_id)
    {
        return $this->table->find($order_id);
    }

    public function getByStatusWithPageinate($search_param)
    {
        $query = $this->table;
        
        if (isset($search_param['customer_name'])) {
            $query
            ->where(DB::raw('CONCAT(name01, name02)'), 'like', "%{$search_param['customer_name']}%");
        }
        
        if (isset($search_param['order_status_id'])) {
            $query
            ->where('order_status_id', $search_param['order_status_id']);
        } else {
            $query
            ->whereIn('order_status_id',
            [
                config('ec_cube_order.status_id.paid'),
                config('ec_cube_order.status_id.delivered')
            ]);
        }

        return $query
        ->orderBy('id', 'desc')
        ->simplePaginate(20);
    }

    public function getSales($format, $limit = '')
    {
        $status_id_cancel = config('ec_cube_order.status_id.cancel');
        $status_id_pending = config('ec_cube_order.status_id.pending');
        $status_id_processing = config('ec_cube_order.status_id.processing');
        $status_id_returned = config('ec_cube_order.status_id.returned');

        if ($limit) {
            return DB::select(
                "
                SELECT
                    sum(payment_total) as payment_total, date_format(order_date, '{$format}') as order_date
                FROM
                    dtb_order
                WHERE
                    order_status_id NOT IN({$status_id_cancel}, {$status_id_pending}, {$status_id_processing}, {$status_id_returned})
                GROUP BY
                    date_format(order_date, '{$format}')
                ORDER BY
                    date_format(order_date, '{$format}') DESC
                LIMIT
                    {$limit}
                "
            );
        } else {
            return DB::select(
                "
                SELECT
                    sum(payment_total) as payment_total, date_format(order_date, '{$format}') as order_date
                FROM
                    dtb_order
                WHERE
                    order_status_id NOT IN({$status_id_cancel}, {$status_id_pending}, {$status_id_processing}, {$status_id_returned})
                GROUP BY
                    date_format(order_date, '{$format}')
                ORDER BY
                    date_format(order_date, '{$format}') DESC
                "
            );
        }
    }

    public function getSalesProduct($limit = '')
    {
        $status_id_cancel = config('ec_cube_order.status_id.cancel');
        $status_id_pending = config('ec_cube_order.status_id.pending');
        $status_id_processing = config('ec_cube_order.status_id.processing');
        $status_id_returned = config('ec_cube_order.status_id.returned');

        if ($limit) {
            return DB::select(
                "
                SELECT
                    oi.product_name, sum(o.payment_total) as payment_total, sum(oi.quantity) as quantity
                FROM
                    dtb_order o
                INNER JOIN
                    dtb_order_item oi
                ON
                    o.id = oi.order_id
                WHERE
                    o.order_status_id NOT IN({$status_id_cancel}, {$status_id_pending}, {$status_id_processing}, {$status_id_returned})
                AND
                    oi.product_id IS NOT NULL
                GROUP BY
                    oi.product_name
                ORDER BY
                    payment_total DESC
                LIMIT
                    {$limit}
                "
            );
        } else {
            return DB::select(
                "
                SELECT
                    oi.product_name, sum(o.payment_total) as payment_total, sum(oi.quantity) as quantity
                FROM
                    dtb_order o
                INNER JOIN
                    dtb_order_item oi
                ON
                    o.id = oi.order_id
                WHERE
                    o.order_status_id NOT IN({$status_id_cancel}, {$status_id_pending}, {$status_id_processing}, {$status_id_returned})
                AND
                    oi.product_id IS NOT NULL
                GROUP BY
                    oi.product_name
                ORDER BY
                    payment_total DESC
                "
            );
        }
    }

    public function getSalesPref($limit = '')
    {
        $status_id_cancel = config('ec_cube_order.status_id.cancel');
        $status_id_pending = config('ec_cube_order.status_id.pending');
        $status_id_processing = config('ec_cube_order.status_id.processing');
        $status_id_returned = config('ec_cube_order.status_id.returned');

        if ($limit) {
            return DB::select(
                "
                SELECT
                     sum(payment_total) as payment_total, p.name as pref_name
                FROM
                    dtb_order o
				INNER JOIN
					mtb_pref p
				ON
					o.pref_id = p.id
                WHERE
                    o.order_status_id NOT IN({$status_id_cancel}, {$status_id_pending}, {$status_id_processing}, {$status_id_returned})
                GROUP BY
                    p.name
                ORDER BY
                    payment_total DESC
                LIMIT
                    {$limit}
                "
            );
        } else {
            return DB::select(
                "
                SELECT
                     sum(payment_total) as payment_total, p.name as pref_name
                FROM
                    dtb_order o
				INNER JOIN
					mtb_pref p
				ON
					o.pref_id = p.id
                WHERE
                    o.order_status_id NOT IN({$status_id_cancel}, {$status_id_pending}, {$status_id_processing}, {$status_id_returned})
                GROUP BY
                    p.name
                ORDER BY
                    payment_total DESC
                "
            );
        }
    }
}
<?php

namespace App\Services;

use App\Http\Traits\Csv;
use App\Services\YamatoService;
use App\Services\SagawaService;
use App\Services\YuPackService;
use App\Services\SeinoService;
use App\Services\YayoiService;

class CsvService
{
    use Csv;

    public function __construct()
    {
    }

    public function export($order_id, $csv_export_type)
    {
        $derivery_service = $this->getCompanyService($csv_export_type);
        $res = $derivery_service->getShipmentList($order_id);

        $filename = $res['filename'];
        $file = Csv::createCsv($filename);

        // ヘッダー
        Csv::write($file, $res['header']); 

        // リスト
        $lists = $res['body'];
        if ($lists === config('status_code.error.error_yayoi_sales_integration')) {
          return config('status_code.error.error_yayoi_sales_integration');
        }

        // 値を入れる
        foreach ($lists as $list) {
            Csv::write($file, $list);
        }

        $response = file_get_contents($file);

        // ストリームに入れたら実ファイルは削除
        Csv::purge($filename);

        return [
            'response' => $response,
            'filename' => $filename,
        ];
    }

    private function getCompanyService($csv_export_type)
    {
        if ($csv_export_type === config('csv_export_type.yamato')) {
          return new YamatoService();
        } elseif ($csv_export_type === config('csv_export_type.sagawa')) {
          return new SagawaService();
        } elseif ($csv_export_type === config('csv_export_type.seino')) {
          return new SeinoService();
        } elseif ($csv_export_type === config('csv_export_type.yu_pack')) {
          return new YuPackService();
        } elseif ($csv_export_type === config('csv_export_type.yayoi')) {
          return new YayoiService();
        } elseif ($csv_export_type === config('csv_export_type.order_form')) {
          return new OrderFormService();
        }
    }
}
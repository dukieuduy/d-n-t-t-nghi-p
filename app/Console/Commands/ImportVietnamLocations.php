<?php
namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Province;
use App\Models\District;
use App\Models\Ward;
use Illuminate\Support\Facades\File;

class ImportVietnamLocations extends Command
{
    protected $signature = 'import:vietnam-locations';
    protected $description = 'Import Vietnam locations (Provinces, Districts, Wards) from JSON';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $this->info('Starting import...');

        // Đọc nội dung của file JSON
        $json = File::get(base_path('database/data/tree.json')); // Đảm bảo rằng đường dẫn đúng
        $data = json_decode($json, true);

        foreach ($data as $provinceData) {
            // Tạo tỉnh (Province)
            $province = Province::create([
                'name' => $provinceData['name'],
                'slug' => $provinceData['slug'],
                'type' => $provinceData['type'],
                'name_with_type' => $provinceData['name_with_type'],
                'code' => $provinceData['code'],
            ]);

            // Kiểm tra nếu có quận/huyện (quan-huyen)
            if (isset($provinceData['quan-huyen'])) {
                foreach ($provinceData['quan-huyen'] as $districtData) {
                    // Tạo quận/huyện (District)
                    $district = $province->districts()->create([
                        'name' => $districtData['name'],
                        'slug' => $districtData['slug'],
                        'type' => $districtData['type'],
                        'name_with_type' => $districtData['name_with_type'],
                        'path' => $districtData['path'],
                        'path_with_type' => $districtData['path_with_type'],
                        'code' => $districtData['code'],
                        'parent_code' => $districtData['parent_code'],
                    ]);

                    // Kiểm tra nếu có phường/xã (xa-phuong)
                    if (isset($districtData['xa-phuong'])) {
                        foreach ($districtData['xa-phuong'] as $wardData) {
                            // Tạo phường/xã (Ward)
                            $district->wards()->create([
                                'name' => $wardData['name'],
                                'slug' => $wardData['slug'],
                                'type' => $wardData['type'],
                                'name_with_type' => $wardData['name_with_type'],
                                'path' => $wardData['path'],
                                'path_with_type' => $wardData['path_with_type'],
                                'code' => $wardData['code'],
                                'parent_code' => $wardData['parent_code'],
                            ]);
                        }
                    }
                }
            }
        }

        $this->info('Import completed!');
    }
}

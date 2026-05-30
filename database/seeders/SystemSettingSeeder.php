<?php

namespace Database\Seeders;

use App\Models\SystemSetting;
use Illuminate\Database\Seeder;

class SystemSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $settings = [
            'company_name' => 'HỘ KINH DOANH THM',
            'representative' => 'TRẦN THỊ HẬU',
            'tax_code' => '040302000847',
            'address' => 'Số 12 Phạm Xuân Phong, Xóm Phúc Trung, Xã Yên Thành, Tỉnh Nghệ An, Việt Nam',
            'hotline' => '0986039287',
            'email' => 'tthau10032002@gmail.com',
            'slogan' => 'CHUẨN MỰC KẾ TOÁN | TRỌN VẸN NIỀM TIN',
        ];

        foreach ($settings as $key => $value) {
            SystemSetting::updateOrCreate(
                ['key' => $key],
                ['value' => $value]
            );
        }
    }
}

<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $services = [
            [
                'name' => 'Tư vấn thuế',
                'short_description' => 'Hỗ trợ doanh nghiệp tối ưu hóa nghĩa vụ thuế, lập báo cáo quyết toán và giải trình với cơ quan thuế chuyên nghiệp.',
                'description' => 'Dịch vụ tư vấn thuế toàn diện giúp doanh nghiệp giảm thiểu rủi ro pháp lý và tối ưu hóa số thuế phải nộp. Nội dung công việc bao gồm: tư vấn chính sách thuế mới, rà soát sổ sách thuế trước khi thanh tra, thiết lập hồ sơ giao dịch liên kết, thực hiện thủ tục hoàn thuế, hỗ trợ quyết toán thuế thu nhập doanh nghiệp (TNDN) và thuế thu nhập cá nhân (TNCN) định kỳ.',
                'is_active' => true,
            ],
            [
                'name' => 'Kế toán trọn gói',
                'short_description' => 'Giải pháp kế toán toàn diện từ ghi nhận chứng từ, lập báo cáo tài chính đến kê khai thuế hàng tháng/quý.',
                'description' => 'Hỗ trợ hộ kinh doanh và doanh nghiệp giải quyết triệt để các vấn đề kế toán mà không cần thuê nhân sự quản lý trực tiếp. Chúng tôi thực hiện: tiếp nhận chứng từ, phân loại và xử lý nghiệp vụ kế toán, khai báo hóa đơn, lập sổ sách kế toán định kỳ, báo cáo tình hình sử dụng hóa đơn, làm việc trực tiếp với cơ quan quản lý khi có yêu cầu và lập báo cáo tài chính năm.',
                'is_active' => true,
            ],
            [
                'name' => 'Kiểm toán nội bộ',
                'short_description' => 'Đánh giá độc lập hệ thống kiểm soát nội bộ, quản trị rủi ro và cải tiến quy trình vận hành tài chính.',
                'description' => 'Giúp ban lãnh đạo doanh nghiệp kiểm soát chặt chẽ tài sản, tối ưu hóa quy trình tài chính kế toán và giảm thiểu thất thoát rủi ro hoạt động. Dịch vụ bao gồm: rà soát quy trình quản lý tài chính, kiểm tra tính tuân thủ quy chế nội bộ, đánh giá hiệu quả kiểm soát dòng tiền, phát hiện và phòng ngừa gian lận, kiến nghị giải pháp cải thiện hệ thống quản trị nội bộ.',
                'is_active' => true,
            ],
            [
                'name' => 'Tư vấn quản lý doanh nghiệp',
                'short_description' => 'Đồng hành xây dựng cơ cấu tổ chức, thiết lập hệ thống KPI và tái cấu trúc tài chính kế toán.',
                'description' => 'Tư vấn giải pháp quản lý chiến lược tài chính doanh nghiệp giúp nâng cao năng lực cạnh tranh và phát triển bền vững. Công việc bao gồm: phân tích cấu trúc tài chính, xây dựng hệ thống báo cáo quản trị nội bộ cho ban lãnh đạo, tư vấn quy trình quản lý hàng tồn kho, công nợ, hỗ trợ thủ tục thành lập doanh nghiệp, thay đổi đăng ký kinh doanh và tái cấu trúc tài chính doanh nghiệp.',
                'is_active' => true,
            ],
        ];

        foreach ($services as $service) {
            Service::updateOrCreate(
                ['slug' => Str::slug($service['name'])],
                $service
            );
        }
    }
}

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Yeu cau tu van moi</title>
</head>
<body style="font-family: Arial, sans-serif; color: #1a2530; line-height: 1.6;">
    <h2 style="margin-bottom: 16px;">Yeu cau tu van moi</h2>

    <p>Website vua nhan mot yeu cau tu van moi. Thong tin chi tiet:</p>

    <table cellpadding="8" cellspacing="0" border="0" style="border-collapse: collapse; width: 100%; max-width: 680px;">
        <tr>
            <td style="font-weight: bold; width: 180px; background: #f5f8fc;">Ho va ten</td>
            <td>{{ $consultationRequest->full_name }}</td>
        </tr>
        <tr>
            <td style="font-weight: bold; background: #f5f8fc;">So dien thoai</td>
            <td><a href="tel:{{ $consultationRequest->phone }}">{{ $consultationRequest->phone }}</a></td>
        </tr>
        <tr>
            <td style="font-weight: bold; background: #f5f8fc;">Email</td>
            <td>
                @if($consultationRequest->email)
                    <a href="mailto:{{ $consultationRequest->email }}">{{ $consultationRequest->email }}</a>
                @else
                    Khong cung cap
                @endif
            </td>
        </tr>
        <tr>
            <td style="font-weight: bold; background: #f5f8fc;">Doanh nghiep / HKD</td>
            <td>{{ $consultationRequest->company_name ?: 'Khong cung cap' }}</td>
        </tr>
        <tr>
            <td style="font-weight: bold; background: #f5f8fc;">Dich vu can tu van</td>
            <td>{{ optional($consultationRequest->service)->name ?: 'Chua xac dinh' }}</td>
        </tr>
        <tr>
            <td style="font-weight: bold; background: #f5f8fc;">Trang thai</td>
            <td>{{ $consultationRequest->status }}</td>
        </tr>
        <tr>
            <td style="font-weight: bold; background: #f5f8fc;">Thoi gian gui</td>
            <td>{{ optional($consultationRequest->created_at)->format('d/m/Y H:i') }}</td>
        </tr>
        <tr>
            <td style="font-weight: bold; background: #f5f8fc; vertical-align: top;">Noi dung</td>
            <td>{{ $consultationRequest->message }}</td>
        </tr>
    </table>
</body>
</html>

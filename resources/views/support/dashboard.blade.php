<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>داشبورد پشتیبانی</title>

    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
    <style>
        body {
            font-family: 'Vazirmatn', sans-serif;
            background-color: #f4f6f9;
            overflow-x: hidden;
            margin: 0;
        }
        .sidebar {
            min-height: 100vh;
            background-color: #2c3136;
            color: #fff;
            padding: 25px 15px;
            position: sticky;
            top: 0;
            height: 100vh;
            overflow-y: auto;
        }

        .sidebar .brand {
            text-align: center;
            font-weight: bold;
            font-size: 1.2rem;
            margin-bottom: 30px;
            color: #fff;
        }

        .sidebar a {
            color: #b8bfc6;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 12px 15px;
            border-radius: 8px;
            margin-bottom: 5px;
            transition: all 0.3s ease;
            font-size: 0.95rem;
        }

        .sidebar a:hover,
        .sidebar a.active {
            background-color: #3d444b;
            color: #fff;
        }

        .sidebar form button {
            color: #ff6b6b;
            background: none;
            border: none;
            width: 100%;
            text-align: right;
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 12px 15px;
            border-radius: 8px;
            margin-top: 20px;
            border-top: 1px solid #444;
            padding-top: 20px;
            font-family: inherit;
            font-size: 0.95rem;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .sidebar form button:hover {
            background-color: #3d444b;
            color: #ff8787;
        }

        .top-navbar {
            background-color: #fff;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
            padding: 15px 25px;
            margin-bottom: 25px;
            border-radius: 10px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .top-navbar h4 {
            margin: 0;
            font-weight: bold;
            color: #2c3136;
        }

        .top-navbar .welcome {
            color: #6c757d;
            font-size: 0.9rem;
        }

        .stat-card {
            background: #fff;
            border: none;
            border-radius: 12px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.04);
            padding: 18px 12px;
            text-align: center;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .stat-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.08);
        }

        .stat-card .stat-title {
            color: #6c757d;
            font-size: 0.85rem;
            margin-bottom: 8px;
            font-weight: normal;
        }

        .stat-card .stat-number {
            font-size: 1.7rem;
            font-weight: bold;
            margin: 0;
        }

        .chart-card {
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.04);
            padding: 20px;
            display: flex;
            flex-direction: column;
            height: 95%;
        }

        .chart-card h6 {
            font-weight: bold;
            color: #2c3136;
            margin-bottom: 15px;
            text-align: center;
        }

        .chart-wrapper {
            position: relative;
            flex: 1;
            min-height: 220px;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .section-title {
            font-weight: bold;
            margin-bottom: 20px;
            color: #2c3136;
        }

        .ticket-item {
            background: #fff;
            border-radius: 10px;
            padding: 15px 18px;
            margin-bottom: 12px;
            border-right: 4px solid #0d6efd;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.04);
            transition: box-shadow 0.2s ease, transform 0.2s ease;
        }

        .ticket-item:hover {
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            transform: translateX(-2px);
        }

        .ticket-item .ticket-subject {
            font-weight: bold;
            font-size: 1rem;
            color: #2c3136;
            margin-bottom: 6px;
        }

        .ticket-item .ticket-user {
            color: #6c757d;
            font-size: 0.82rem;
            margin-bottom: 8px;
            line-height: 1.7;
        }

        .badge-status {
            padding: 5px 12px;
            border-radius: 6px;
            font-size: 0.78rem;
            font-weight: normal;
            display: inline-block;
        }

        .status.open {
            background-color: #cfe2ff;
            color: #084298;
        }

        .status.answered {
            background-color: #e2f0d9;
            color: #385723;
        }

        .status.closed {
            background-color: #d1e7dd;
            color: #0f5132;
        }

        .ticket-item.status-open {
            border-right-color: #0dcaf0 !important;
        }

        .ticket-item.status-answered {
            border-right-color: #7cb342 !important;
        }

        .ticket-item.status-closed {
            border-right-color: #198754 !important;
        }

        @media (max-width: 768px) {
            .sidebar {
                position: fixed;
                right: -100%;
                width: 250px;
                z-index: 1000;
                transition: right 0.3s ease;
            }

            .sidebar.show {
                right: 0;
            }

            .top-navbar {
                padding: 12px 15px;
            }

            .top-navbar h4 {
                font-size: 1rem;
            }

            .top-navbar .welcome {
                font-size: 0.78rem;
            }
        }
    </style>
</head>
<body>

<div class="container-fluid">
    <div class="row g-0">

        <div class="col-md-3 col-lg-2 sidebar" id="sidebarMenu">
            <div class="brand">پنل مدیریت</div>
            <nav>
                <a href="{{ route('support.dashboard') }}" class="active">🏠 داشبورد</a>
                <a href="{{ route('support.tickets.index') }}">🎫 تیکت‌ها</a>
                <a href="{{ route('support.users') }}">👥 کاربران</a>
                <a href="#">⚙️ تنظیمات</a>

                <form action="{{ route('auth.logout') }}" method="POST">
                    @csrf
                    <button type="submit">🚪 خروج</button>
                </form>
            </nav>
        </div>

        <main class="col-md-9 col-lg-10 p-4">

            <div class="top-navbar">
                <h4>داشبورد پشتیبانی</h4>
                <span class="welcome">خوش آمدید 👋</span>
            </div>

            <div class="row g-3 mb-4">

                <div class="col-lg-4">
                    <div class="chart-card">
                        <h6>📊 وضعیت تیکت‌ها</h6>
                        <div class="chart-wrapper">
                            <canvas id="ticketChart"></canvas>
                        </div>
                    </div>
                </div>

                <div class="col-lg-8">
                    <div class="row g-3 h-100">
                        <div class="col-6">
                            <div class="stat-card h-100 d-flex flex-column justify-content-center">
                                <div class="stat-title">کل تیکت‌ها</div>
                                <div class="stat-number text-dark">{{ $allTickets->count() }}</div>
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="stat-card h-100 d-flex flex-column justify-content-center">
                                <div class="stat-title">در انتظار پاسخ</div>
                                <div class="stat-number text-info">{{ $allTickets->where('status', 'open')->count() }}</div>
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="stat-card h-100 d-flex flex-column justify-content-center">
                                <div class="stat-title">پاسخ داده شده</div>
                                <div class="stat-number text-success">{{ $allTickets->where('status', 'answered')->count() }}</div>
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="stat-card h-100 d-flex flex-column justify-content-center">
                                <div class="stat-title">بسته شده</div>
                                <div class="stat-number text-secondary">{{ $allTickets->where('status', 'closed')->count() }}</div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <h5 class="section-title">آخرین تیکت‌ها</h5>

            @forelse($latestTickets as $latestTicket)

                @php
                    $status = match ($latestTicket->status) {
                        'open' => 'در انتظار پاسخ',
                        'answered' => 'پاسخ داده شده',
                        'closed' => 'بسته شده',
                        default => $latestTicket->status,
                    };
                @endphp

                <div class="ticket-item status-{{ $latestTicket->status }} d-flex justify-content-between align-items-center flex-wrap gap-3">

                    <div>
                        <div class="ticket-subject">موضوع: {{ $latestTicket->subject }}</div>
                        <div class="ticket-user">
                            کاربر: {{ $latestTicket->user->name }} <br>
                            تاریخ:
                            {{ str_replace(
                                ['0','1','2','3','4','5','6','7','8','9'],
                                ['۰','۱','۲','۳','۴','۵','۶','۷','۸','۹'],
                                \Morilog\Jalali\Jalalian::fromDateTime($latestTicket->created_at)->format('Y/m/d H:i')
                            ) }}
                        </div>
                        <span class="badge-status status {{ $latestTicket->status }}">
                            وضعیت: {{ $status }}
                        </span>
                    </div>

                    <a href="{{ route('support.tickets.show', $latestTicket) }}" class="btn btn-primary btn-sm px-3">
                        مشاهده تیکت
                    </a>

                </div>

            @empty
                <div class="alert alert-info text-center">
                    هنوز هیچ تیکتی ثبت نشده است.
                </div>
            @endforelse

        </main>
    </div>
</div>

<script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>

<script>
    const ctx = document.getElementById('ticketChart');

    const openCount     = {{ $latestTicket->where('status', 'open')->count() }};
    const answeredCount = {{ $latestTicket->where('status', 'answered')->count() }};
    const closedCount   = {{ $latestTicket->where('status', 'closed')->count() }};

    new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: ['در انتظار پاسخ', 'پاسخ داده شده', 'بسته شده'],
            datasets: [{
                data: [openCount, answeredCount, closedCount],
                backgroundColor: [
                    '#0dcaf0',
                    '#7cb342',
                    '#198754'
                ],
                borderColor: '#fff',
                borderWidth: 3,
                hoverOffset: 8
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            cutout: '65%',
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: {
                        font: { family: 'Vazirmatn', size: 12 },
                        padding: 12,
                        usePointStyle: true,
                        pointStyle: 'circle'
                    }
                },
                tooltip: {
                    titleFont: { family: 'Vazirmatn' },
                    bodyFont: { family: 'Vazirmatn' },
                    callbacks: {
                        label: function(context) {
                            const total = context.dataset.data.reduce((a, b) => a + b, 0);
                            const value = context.parsed;
                            const percent = total > 0 ? ((value / total) * 100).toFixed(1) : 0;
                            return ' ' + context.label + ': ' + value + ' (' + percent + '%)';
                        }
                    }
                }
            }
        }
    });
</script>

</body>
</html>

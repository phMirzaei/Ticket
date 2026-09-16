<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>داشبورد من</title>

    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">

    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>

    <style>
        body {
            background-color: #f4f6f9;
            overflow-x: hidden;
            margin: 0;
            min-height: 100vh;
        }

        .user-navbar {
            background: #fff;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
            padding: 15px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .user-navbar .brand {
            font-weight: bold;
            font-size: 1.1rem;
            color: #2c3136;
        }

        .user-navbar .user-info {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .user-avatar {
            width: 42px;
            height: 42px;
            border-radius: 50%;
            background: #0d6efd;
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            font-size: 1.1rem;
        }

        .user-name {
            color: #2c3136;
            font-weight: 500;
            font-size: 0.92rem;
        }

        .btn-logout {
            background: none;
            border: 1px solid #dc3545;
            color: #dc3545;
            padding: 7px 15px;
            border-radius: 8px;
            font-family: inherit;
            font-size: 0.85rem;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .btn-logout:hover {
            background: #dc3545;
            color: #fff;
        }

        .main-container {
            max-width: 1100px;
            margin: 0 auto;
            padding: 30px 20px;
        }

        .welcome-card {
            background: linear-gradient(135deg, #2c3136 0%, #4a545e 100%);
            color: #fff;
            border-radius: 16px;
            padding: 30px;
            margin-bottom: 25px;
            position: relative;
            overflow: hidden;
        }

        .welcome-card::before {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            left: 0;
            height: 5px;
            background: linear-gradient(90deg, #0dcaf0, #7cb342, #198754);
        }

        .welcome-card h1 {
            margin: 0 0 10px;
            font-size: 1.6rem;
            font-weight: bold;
        }

        .welcome-card p {
            margin: 0 0 20px;
            opacity: 0.85;
            font-size: 0.95rem;
        }

        .btn-new-ticket {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 12px 24px;
            background: #fff;
            color: #2c3136;
            text-decoration: none;
            border-radius: 10px;
            font-weight: 500;
            font-size: 0.9rem;
            transition: all 0.2s ease;
        }

        .btn-new-ticket:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
            color: #2c3136;
        }

        .chart-card {
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.04);
            padding: 22px;
            margin-bottom: 25px;
            height: 100%;
        }

        .chart-card h6 {
            font-weight: bold;
            color: #2c3136;
            margin-bottom: 18px;
            text-align: center;
            font-size: 0.95rem;
        }

        .chart-wrapper {
            position: relative;
            height: 240px;
            width: 100%;
        }

        .stat-card {
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.04);
            padding: 20px;
            text-align: center;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
            height: 100%;
        }

        .stat-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.08);
        }

        .stat-card .stat-icon {
            font-size: 1.8rem;
            margin-bottom: 8px;
        }

        .stat-card .stat-title {
            color: #6c757d;
            font-size: 0.82rem;
            margin-bottom: 8px;
        }

        .stat-card .stat-number {
            font-size: 1.7rem;
            font-weight: bold;
            margin: 0;
        }

        .section-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .section-header h2 {
            margin: 0;
            font-size: 1.2rem;
            font-weight: bold;
            color: #2c3136;
        }

        .tickets-card {
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.04);
            padding: 25px;
        }

        .ticket-item {
            border-bottom: 1px solid #f1f3f5;
            padding: 18px 0;
            transition: all 0.2s ease;
        }

        .ticket-item:last-child {
            border-bottom: none;
            padding-bottom: 0;
        }

        .ticket-item:first-child {
            padding-top: 0;
        }

        .ticket-subject {
            font-weight: bold;
            color: #2c3136;
            font-size: 1rem;
            margin-bottom: 8px;
        }

        .ticket-message {
            color: #6c757d;
            font-size: 0.88rem;
            line-height: 1.7;
            margin-bottom: 10px;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .ticket-meta {
            color: #adb5bd;
            font-size: 0.78rem;
            margin-bottom: 10px;
        }

        .ticket-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 10px;
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

        .btn-show {
            display: inline-block;
            padding: 8px 18px;
            background: #2c3136;
            color: #fff;
            text-decoration: none;
            border-radius: 8px;
            font-size: 0.83rem;
            transition: all 0.2s ease;
        }

        .btn-show:hover {
            background: #1a1e22;
            color: #fff;
        }

        .empty-state {
            text-align: center;
            padding: 50px 20px;
            color: #6c757d;
        }

        .empty-state .empty-icon {
            font-size: 3rem;
            margin-bottom: 15px;
            opacity: 0.5;
        }

        .empty-state p {
            margin: 0 0 20px;
            font-size: 0.95rem;
        }

        @media (max-width: 768px) {
            .user-navbar {
                padding: 12px 15px;
            }

            .user-navbar .brand {
                font-size: 0.95rem;
            }

            .user-name {
                display: none;
            }

            .welcome-card {
                padding: 22px 20px;
            }

            .welcome-card h1 {
                font-size: 1.2rem;
            }

            .tickets-card {
                padding: 18px;
            }

            .ticket-footer {
                flex-direction: column;
                align-items: flex-start;
            }
        }
    </style>
</head>
<body>

<nav class="user-navbar">
    <div class="brand">
        🎫 پشتیبانی آنلاین
    </div>

    <div class="user-info">
        <div class="user-avatar">
            {{ mb_substr($user->name, 0, 1) }}
        </div>
        <span class="user-name">{{ $user->name }}</span>

        <form action="{{ route('auth.logout') }}" method="POST">
            @csrf
            <button type="submit" class="btn-logout">
                خروج
            </button>
        </form>
    </div>
</nav>

<div class="main-container">

    <div class="welcome-card">
        <h1>سلام {{ $user->name }} 👋</h1>
        <p>به داشبورد خودت خوش آمدی. از اینجا می‌تونی تیکت‌هات رو مدیریت کنی.</p>

        <a href="{{ route('tickets.create') }}" class="btn-new-ticket">
            ✏️ ثبت تیکت جدید
        </a>
    </div>

    <div class="row g-3 mb-4">
        <div class="col-lg-8">
            <div class="row g-3 h-100">
                <div class="col-6">
                    <div class="stat-card h-100 d-flex flex-column justify-content-center">
                        <div class="stat-icon">📨</div>
                        <div class="stat-title">کل تیکت‌ها</div>
                        <div class="stat-number text-dark">{{ $tickets->count() }}</div>
                    </div>
                </div>

                <div class="col-6">
                    <div class="stat-card h-100 d-flex flex-column justify-content-center">
                        <div class="stat-icon">⏳</div>
                        <div class="stat-title">در انتظار پاسخ</div>
                        <div class="stat-number text-info">{{ $tickets->where('status', 'open')->count() }}</div>
                    </div>
                </div>

                <div class="col-6">
                    <div class="stat-card h-100 d-flex flex-column justify-content-center">
                        <div class="stat-icon">✅</div>
                        <div class="stat-title">پاسخ داده شده</div>
                        <div class="stat-number text-success">{{ $tickets->where('status', 'answered')->count() }}</div>
                    </div>
                </div>

                <div class="col-6">
                    <div class="stat-card h-100 d-flex flex-column justify-content-center">
                        <div class="stat-icon">🔒</div>
                        <div class="stat-title">بسته شده</div>
                        <div class="stat-number text-secondary">{{ $tickets->where('status', 'closed')->count() }}</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="chart-card">
                <h6>📊 وضعیت تیکت‌های من</h6>
                <div class="chart-wrapper">
                    <canvas id="userTicketChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <div class="section-header">
        <h2>🎫 تیکت‌های من</h2>
    </div>

    <div class="tickets-card">

        @forelse($tickets as $ticket)

            @php
                $status = match ($ticket->status) {
                    'open' => 'در انتظار پاسخ',
                    'answered' => 'پاسخ داده شده',
                    'closed' => 'بسته شده',
                    default => $ticket->status,
                };
            @endphp

            <div class="ticket-item">

                <div class="ticket-subject">
                    موضوع: {{ $ticket->subject }}
                </div>

                <div class="ticket-message">
                    {{ $ticket->message }}
                </div>

                <div class="ticket-meta">
                    تاریخ ثبت:
                    {{ str_replace(
                        ['0','1','2','3','4','5','6','7','8','9'],
                        ['۰','۱','۲','۳','۴','۵','۶','۷','۸','۹'],
                        \Morilog\Jalali\Jalalian::fromDateTime(
                            $ticket->created_at->setTimezone('Asia/Tehran')
                        )->format('Y/m/d H:i')
                    ) }}
                </div>

                <div class="ticket-footer">
                    <span class="badge-status status {{ $ticket->status }}">
                        وضعیت: {{ $status }}
                    </span>

                    <a href="{{ route('tickets.show', $ticket) }}" class="btn-show">
                        مشاهده تیکت
                    </a>
                </div>

            </div>

        @empty

            <div class="empty-state">
                <div class="empty-icon">📭</div>
                <p>هنوز هیچ تیکتی ثبت نکرده‌اید.</p>
                <a href="{{ route('tickets.create') }}" class="btn-new-ticket" style="background: #2c3136; color: #fff;">
                    ✏️ ثبت اولین تیکت
                </a>
            </div>

        @endforelse

    </div>

</div>

<script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>

<script>
    Chart.defaults.font.family = 'inherit';

    const ctx = document.getElementById('userTicketChart');

    if (ctx) {
        const openCount     = {{ $tickets->where('status', 'open')->count() }};
        const answeredCount = {{ $tickets->where('status', 'answered')->count() }};
        const closedCount   = {{ $tickets->where('status', 'closed')->count() }};

        new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: ['در انتظار پاسخ', 'پاسخ داده شده', 'بسته شده'],
                datasets: [{
                    data: [openCount, answeredCount, closedCount],
                    backgroundColor: ['#0dcaf0', '#7cb342', '#198754'],
                    borderColor: '#fff',
                    borderWidth: 3,
                    hoverOffset: 8
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                animation: { duration: 0 },
                cutout: '65%',
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            padding: 12,
                            usePointStyle: true,
                            pointStyle: 'circle'
                        }
                    },
                    tooltip: {
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
    }
</script>

</body>
</html>

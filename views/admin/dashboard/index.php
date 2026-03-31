<?php require './views/admin/layouts/header.php'; ?>

<div class="container-fluid p-4">
    <h2 class="mb-4">📊 Dashboard - Báo cáo</h2>

    <!-- Tổng quan -->
    <div class="row mb-4">
        <div class="col-md-6">
            <div class="card text-bg-success shadow">
                <div class="card-body">
                    <h5>Tổng doanh thu</h5>
                    <h3><?= number_format($totalRevenue['total'] ?? 0, 0, ',', '.') ?> đ</h3>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card text-bg-primary shadow">
                <div class="card-body">
                    <h5>Tổng đơn hàng</h5>
                    <h3><?= $totalOrders['total'] ?? 0 ?></h3>
                </div>
            </div>
        </div>
    </div>

    <!-- Tabs -->
    <ul class="nav nav-tabs mb-3">
        <li class="nav-item"><button class="nav-link active" data-bs-toggle="tab" data-bs-target="#day">Theo ngày</button></li>
        <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#month">Theo tháng</button></li>
        <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#order">Đơn hàng</button></li>
    </ul>

    <div class="tab-content">

        <!-- TAB NGÀY -->
        <div class="tab-pane fade show active" id="day">
            <canvas id="chartDay"></canvas>
        </div>

        <!-- TAB THÁNG -->
        <div class="tab-pane fade" id="month">
            <canvas id="chartMonth"></canvas>
        </div>

        <!-- TAB ĐƠN -->
        <div class="tab-pane fade" id="order">
            <table class="table table-bordered">
                <tr><th>Ngày</th><th>Số đơn</th></tr>
                <?php foreach ($ordersByDay as $row): ?>
                <tr>
                    <td><?= $row['date'] ?></td>
                    <td><?= $row['total'] ?></td>
                </tr>
                <?php endforeach; ?>
            </table>
        </div>

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
new Chart(document.getElementById('chartDay'), {
    type: 'line',
    data: {
        labels: <?= json_encode(array_column($revenueByDay, 'date')) ?>,
        datasets: [{
            label: 'Doanh thu',
            data: <?= json_encode(array_column($revenueByDay, 'total')) ?>
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false
    }
});

new Chart(document.getElementById('chartMonth'), {
    type: 'bar',
    data: {
        labels: <?= json_encode(array_map(fn($m) => "Tháng $m", array_column($revenueByMonth, 'month'))) ?>,
        datasets: [{
            label: 'Doanh thu',
            data: <?= json_encode(array_column($revenueByMonth, 'total')) ?>
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false
    }
});
</script>


<?php require './views/admin/layouts/footer.php'; ?>
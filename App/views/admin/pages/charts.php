<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Charts</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/css/bootstrap.min.css">
<script src="https://cdn.jsdelivr.net/npm/chart.js@3.6.2"></script>

</head>
<body>
    <div class="content-wrapper">
        <?php
        use App\controllers\AdminController;
        $adminController = new AdminController();
        $result = $adminController->getChartDatas();
        $data = json_decode($result, true);
        ?>
        <canvas id="registrationOrderChart"></canvas>
    </div>



<script>
const userData = <?php echo json_encode($data['userData']); ?>;
const orderData = <?php echo json_encode($data['orderData']); ?>;
const labels = <?php echo json_encode($data['labels']); ?>;

// Get the chart canvas element
const chartCanvas = document.getElementById('registrationOrderChart');

// Create the chart
new Chart(chartCanvas, {
  type: 'bar',
  data: {
    labels: labels,
    datasets: [
      {
        label: 'Member Registration',
        data: userData,
        backgroundColor: 'rgba(75, 192, 192, 0.5)', // Customize the color as needed
        borderColor: 'rgba(75, 192, 192, 1)',
        borderWidth: 1
      },
      {
        label: 'Order Created',
        data: orderData,
        backgroundColor: 'rgba(255, 99, 132, 0.5)', // Customize the color as needed
        borderColor: 'rgba(255, 99, 132, 1)',
        borderWidth: 1
      }
    ]
  },
  options: {
    responsive: true,
    plugins: {
      legend: {
        position: 'top',
      },
      title: {
        display: true,
        text: 'Member Registrations and Orders Created (Last 7 Days)'
      }
    }
  }
});

</script>

</body>
</html>
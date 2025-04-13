// Ambil data dari global window
var labels = window.chartData.labels;
var values = window.chartData.values;
var backgroundColors = [
  '#007bff', '#dc3545', '#ffc107', '#28a745',
  '#6f42c1', '#fd7e14', '#20c997', '#17a2b8',
  '#6610f2', '#e83e8c', '#343a40', '#adb5bd'
];
var pieColors = backgroundColors.slice(0, labels.length);

// Pie Chart Example
var ctx = document.getElementById("myPieChart");
var myPieChart = new Chart(ctx, {
  type: 'pie',
  data: {
    labels: labels,
    datasets: [{
      data: values,
      backgroundColor: pieColors,
    }],
  },
});

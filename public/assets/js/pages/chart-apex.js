'use strict';
document.addEventListener('DOMContentLoaded', function () {
  setTimeout(function () {
    floatchart();
  }, 500);
});

function floatchart () {
  // pie chart 1
  (function () {
    var labels = window.chartData.labels;
    var values = window.chartData.values.map(Number);
    var backgroundColors = [
      '#007bff', '#dc3545', '#ffc107', '#28a745',
      '#6f42c1', '#fd7e14', '#20c997', '#17a2b8',
      '#6610f2', '#e83e8c', '#343a40', '#adb5bd'
    ];
    var pieColors = backgroundColors.slice(0, labels.length);
    var options_pie_chart_1 = {
      chart: {
        height: 250,
        type: 'pie'
      },
      labels: labels,
      series: values,
      backgroundColors: pieColors,
      legend: {
        show: true,
        position: 'bottom'
      },
      dataLabels: {
        enabled: true,
        dropShadow: {
          enabled: false
        }
      },
      responsive: [
        {
          breakpoint: 480,
          options: {
            legend: {
              position: 'bottom'
            }
          }
        }
      ]
    };
    var chart_pie_chart_1 = new ApexCharts(document.querySelector('#pie-chart-1'), options_pie_chart_1);
    chart_pie_chart_1.render();
  })();

  // pie chart 2
  (function () {
    var labelspemasukan = window.chartData.labelspemasukan;
    var valuespemasukan = window.chartData.valuespemasukan.map(Number);
    console.log(labelspemasukan);
    console.log(valuespemasukan);
    var backgroundColors = [
      '#007bff', '#dc3545', '#ffc107', '#28a745',
      '#6f42c1', '#fd7e14', '#20c997', '#17a2b8',
      '#6610f2', '#e83e8c', '#343a40', '#adb5bd'
    ];
    var pieColors = backgroundColors.slice(0, labelspemasukan.length);
    var options_pie_chart_2 = {
      chart: {
        height: 250,
        type: 'pie'
      },
      labels: labelspemasukan,
      series: valuespemasukan,
      backgroundColors: pieColors,
      legend: {
        show: true,
        position: 'bottom'
      },
      dataLabels: {
        enabled: true,
        dropShadow: {
          enabled: false
        }
      },
      responsive: [
        {
          breakpoint: 480,
          options: {
            legend: {
              position: 'bottom'
            }
          }
        }
      ]
    };
    var chart_pie_chart_2 = new ApexCharts(document.querySelector('#pie-chart-2'), options_pie_chart_2);
    chart_pie_chart_2.render();
  })();

  (function () {
    // radial bar chart 1
    var valuespengeluaran = window.chartData.values.map(Number);
    var valuespemasukan = window.chartData.valuespemasukan.map(Number);
    var totalPengeluaran = 0
    for (let i = 0; i < valuespengeluaran.length; i++) {
      totalPengeluaran += valuespengeluaran[i]
    }
    var totalPemasukan = 0
    for (let i = 0; i < valuespemasukan.length; i++) {
      totalPemasukan += valuespemasukan[i]
    }
    var persentase = Math.floor((totalPengeluaran * 100) / totalPemasukan)
    var options_radialbar_1 = {
      chart: {
        height: 250,
        type: 'radialBar'
      },
      plotOptions: {
        radialBar: {
          hollow: {
            size: '60%'
          },
          dataLabels: {
            value: {
              show: true,
              fontSize: '28px',
              color: '#1890ff',
              offsetY: -10
            },
            name: {
              color: '#000000',
              fontSize: '12px',
              offsetY: 24
            }
          }
        }
      },
      colors: ['#1890ff'],
      series: [persentase],
      labels: ['Pengeluaran']
    };
    var chart_radialbar_1 = new ApexCharts(document.querySelector('#radialBar-chart-1'), options_radialbar_1);
    chart_radialbar_1.render();
  })();
}

let listday =   $("#container").attr("data-list-day");
listday = JSON.parse(listday);

Highcharts.chart('container', {
    chart: {
        type: 'spline'
    },
    title: {
        text: 'Tổng doanh thu hàng ngày'
    },
    subtitle: {
        text: ''
    },
    xAxis: {
        categories: listday
    },
    yAxis: {
        title: {
            text: ''
        },
        labels: {
            formatter: function () {
                return this.value + 'vnđ';
            }
        }
    },
    tooltip: {
        crosshairs: true,
        shared: true
    },
    plotOptions: {
        spline: {
            marker: {
                radius: 4,
                lineColor: '#666666',
                lineWidth: 1
            }
        }
    },
    series: [{
        name: 'Tháng 9',
        marker: {
            symbol: ''
        },
        data: [7.0, 6.9, 9.5, 14.5, 18.2, 21.5, 25.2, 23, 24, 24, 25, 27, 28, 29, 23, 27, 25, 26, 21, 32, 31, 29, 21, 35, 32, 35, {
            y: 26.5,
            marker: {
                symbol: 'url(https://www.highcharts.com/samples/graphics/sun.png)'
            }
        }, 23.3, 32, 33, 32]

    }, ]
});
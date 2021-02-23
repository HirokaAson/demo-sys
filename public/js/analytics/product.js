const productChart = (label, data) => {
    const ctx = document.getElementById('productChart').getContext('2d');
    const border_color = [
        'rgba(255, 99, 132, 1)', // red
        'rgba(54, 162, 235, 1)', // blue
        'rgba(255, 206, 86, 1)', // yellow
        'rgba(181, 255, 20, 1)', // yellow-green
        'rgba(0, 102, 102, 1)', // green-blue
        'rgba(0, 136, 136, 1)', // green-deep-blue
        'rgba(75, 192, 192, 1)', // green
        'rgba(153, 102, 255, 1)', // purple
        'rgba(56, 8, 120, 1)', // blue-purple
        'rgba(136, 34, 85, 1)', // red-purple
        'rgba(234, 85, 4, 1)', // red-orange
        'rgba(240, 131, 0, 1)', // orange
    ];
    const background_color = [
        'rgba(255, 99, 132, 1)', // red
        'rgba(54, 162, 235, 1)', // blue
        'rgba(255, 206, 86, 1)', // yellow
        'rgba(181, 255, 20, 1)', // yellow-green
        'rgba(0, 102, 102, 1)', // green-blue
        'rgba(0, 136, 136, 1)', // green-deep-blue
        'rgba(75, 192, 192, 1)', // green
        'rgba(153, 102, 255, 1)', // purple
        'rgba(56, 8, 120, 1)', // blue-purple
        'rgba(136, 34, 85, 1)', // red-purple
        'rgba(234, 85, 4, 1)', // red-orange
        'rgba(240, 131, 0, 1)', // orange
    ];
    const myChart = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: label,
            datasets: [{
                label: '# of Sales',
                data: data,
                backgroundColor: background_color,
                borderColor: border_color,
                borderWidth: 1
            }]
        },
        options: {
            title: {
                display: true,
                text: '商品別　割合'
              }
        }
    });
}
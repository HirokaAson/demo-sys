const prefChart = (label, data, background_color, border_color) => {
    const ctx = document.getElementById('prefChart').getContext('2d');
    const myChart = new Chart(ctx, {
        type: 'bar',
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
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });
}
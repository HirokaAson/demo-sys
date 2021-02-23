const monthChart =  (data) => {
    const ctx = document.getElementById('monthChart').getContext('2d');
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
    ]

    const date_month = {
        'jan': '01月',
        'feb': '02月',
        'mar': '03月',
        'apr': '04月',
        'may': '05月',
        'jun': '06月',
        'jul': '07月',
        'aug': '08月',
        'sep': '09月',
        'oct': '10月',
        'nov': '11月',
        'dec': '12月',
    };

    let year = [];
    data.forEach((value, key) => {
        year.push(key);
    });
    
    let datasets = [];
    year.forEach((value, key) => {
        let tmp_data = [
            data[value][`${value}年${date_month.jan}`] ? data[value][`${value}年${date_month.jan}`] : 0,
            data[value][`${value}年${date_month.feb}`] ? data[value][`${value}年${date_month.feb}`] : 0,
            data[value][`${value}年${date_month.mar}`] ? data[value][`${value}年${date_month.mar}`] : 0,
            data[value][`${value}年${date_month.apr}`] ? data[value][`${value}年${date_month.apr}`] : 0,
            data[value][`${value}年${date_month.may}`] ? data[value][`${value}年${date_month.may}`] : 0,
            data[value][`${value}年${date_month.jun}`] ? data[value][`${value}年${date_month.jun}`] : 0,
            data[value][`${value}年${date_month.jul}`] ? data[value][`${value}年${date_month.jul}`] : 0,
            data[value][`${value}年${date_month.aug}`] ? data[value][`${value}年${date_month.aug}`] : 0,
            data[value][`${value}年${date_month.sep}`] ? data[value][`${value}年${date_month.sep}`] : 0,
            data[value][`${value}年${date_month.oct}`] ? data[value][`${value}年${date_month.oct}`] : 0,
            data[value][`${value}年${date_month.nov}`] ? data[value][`${value}年${date_month.nov}`] : 0,
            data[value][`${value}年${date_month.dec}`] ? data[value][`${value}年${date_month.dec}`] : 0,
        ];
        datasets.push(
            {
                label: `# of ${value}`,
                data: tmp_data,
                backgroundColor: [
                    'rgba(0, 0, 255, 0)',
                ],
                
                borderColor: border_color[key],
                borderWidth: 1
            }
        );
    });


    const myChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: [
                date_month.jan,
                date_month.feb,
                date_month.mar,
                date_month.apr,
                date_month.may,
                date_month.jun,
                date_month.jul,
                date_month.aug,
                date_month.sep,
                date_month.oct,
                date_month.nov,
                date_month.dec,
            ],
            datasets: datasets
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
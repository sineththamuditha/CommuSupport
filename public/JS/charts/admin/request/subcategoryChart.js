var ctx = document.getElementById('itemChart').getContext('2d');
var itemChart = new Chart(ctx, {
    type: 'doughnut',
    data: {
        labels: Object.keys(itemData),
        datasets: [{
            label: 'My Pie Chart',
            data: Object.values(itemData),
            backgroundColor: [
                '#225E27',
                '#3AAC43',
                '#78D480',
                '#B2E8B0',
            ]
        }]
    },
    options: {
        title: {
            display: false,
            text: 'Categories of Requests',
            fontSize: 24,
            fontColor: '#000',
            fontFamily: 'inter'
        },
        legend: {
            display: true,
            position: 'top',
            labels: {
                boxWidth: 10,
                fontSize: 10,
            }
        },
        layout:{
            padding: 0
        }
    }
});

//data for total order and customer per month
const customersData = [2, 5, 2, 4, 5, 3, 8, 1, 10, 5, 8, 3];
const ordersData = [15, 16, 18, 20, 12, 8, 6, 14, 9, 12, 5, 7 ];

const monthlabels = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];

//bar Chart for total customers
const customersCtx = document.getElementById('customersChart').getContext('2d');
const customersChart = new Chart(customersCtx, 
    {
    type: 'bar',
    data: 
    {
        labels: monthlabels,
        datasets: 
        [{
            label: 'Total Customers',
            data: customersData,
            backgroundColor: 'rgba(255, 99, 132, 0.2)',
            borderColor: 'rgba(255, 99, 132, 1)',
            borderWidth: 1
        }]
    },
    options: 
    {
        scales: 
        {
            yAxes: 
            [{
                ticks: 
                {
                    beginAtZero: true
                }
            }]
        }
    }
});

//Bar Chart for total order
const ordersCtx = document.getElementById('ordersChart').getContext('2d');
const ordersChart = new Chart(ordersCtx, 
    {
    type: 'bar',
    data: 
    {
        labels: monthlabels,
        datasets: 
        [{
            label: 'Total Orders',
            data: ordersData,
            backgroundColor: 'rgba(54, 162, 235, 0.2)',
            borderColor: 'rgba(54, 162, 235, 1)',
            borderWidth: 1
        }]
    },
    options: 
    {
        scales: 
        {
            yAxes: 
            [{
                ticks: 
                {
                    beginAtZero: true
                }
            }]
        }
    }
});

//data for total product per year
const productsData = [600, 800, 900, 1000, 1500];

const yearlabels = ['2019', '2020', '2021', '2022', '2023'];

//bar Chart for total customers
const productsCtx = document.getElementById('productsChart').getContext('2d');
const productsChart = new Chart(productsCtx, 
    {
    type: 'bar',
    data: 
    {
        labels: yearlabels,
        datasets: 
        [{
            label: 'Total Products',
            data: productsData,
            backgroundColor: 'rgba(186, 104, 200, 0.2)',
            borderColor: 'rgba(103, 58, 183, 1)',
            borderWidth: 1
        }]
    },
    options: 
    {
        scales: 
        {
            yAxes: 
            [{
                ticks: 
                {
                    beginAtZero: true
                }
            }]
        }
    }
});
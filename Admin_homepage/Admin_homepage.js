//data for total order and customer per month
const customersData = [200, 500, 200, 400, 500, 300, 800, 1000, 1000, 500, 800, 300];
const ordersData = [250, 530, 250, 400, 550, 300, 900, 1000, 1200, 500, 850, 300 ];

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

// Data for total product sales per year
const salesData = [6600, 8000, 4000, 3000, 10000, 5000, 5600, 4000, 5000, 3000];

// Labels for products
const productLabels = ['adhesive tape', 'binder level arch', 'crayon', 'drawing painting', 'eraser', 'pen', 'pencil', 'scissor', 'stapler and staples', 'watercolor paint'];
// Get the canvas element
const productsCtx = document.getElementById('productsChart').getContext('2d');

// Create the bar chart
const productsChart = new Chart(productsCtx, {
    type: 'bar',
    data: {
        labels: productLabels,
        datasets: [{
            label: 'Total Products 2019-2023',
            data: salesData,
            backgroundColor: 'rgba(186, 104, 200, 0.2)',
            borderColor: 'rgba(103, 58, 183, 1)',
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
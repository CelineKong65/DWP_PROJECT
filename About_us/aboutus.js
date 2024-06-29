document.addEventListener('DOMContentLoaded', () => {
    const slideElements = document.querySelectorAll('.history-slide-left, .history-slide-right');

    const checkVisibility = () => {
        const triggerBottom = window.innerHeight / 5 * 4;
        slideElements.forEach(element => {
            const elementTop = element.getBoundingClientRect().top;
            if (elementTop < triggerBottom) {
                element.classList.add('active');
            }
        });
    };

    window.addEventListener('scroll', checkVisibility);
    checkVisibility(); // Initial check in case elements are already in view

    // Chart.js Pie Chart Integration
    const orderCustomerCtx = document.getElementById('orderCustomerChart').getContext('2d');
    const productSalesCtx = document.getElementById('productSalesChart').getContext('2d');

    const orderCustomerChart = new Chart(orderCustomerCtx, {
        type: 'pie',
        data: {
            labels: ['Total Orders (12 Months)', 'Total Customers (12 Months)'],
            datasets: [{
                data: [7030, 6500],
                backgroundColor: ['#bbdefb', '#f8bbd0'],
                hoverBackgroundColor: ['#90caf9', '#f48fb1']
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'top',
                },
                tooltip: {
                    callbacks: {
                        label: function (context) {
                            const label = context.label || '';
                            const value = context.raw || 0;
                            const total = context.chart._metasets[0].total;
                            const percentage = ((value / total) * 100).toFixed(2);
                            return `${label}: ${value} (${percentage}%)`;
                        }
                    }
                }
            }
        }
    });

    // Data for total product sales per year
    const salesData = [6600, 5000, 8000, 3000, 5000, 5000, 7000, 4000, 5000, 9000];

    // Labels for products
    const productLabels = ['Adhesive Tape', 'Binder Level Arch', 'Crayon', 'Drawing Painting', 'Eraser', 'Pen', 'Pencil', 'Scissor', 'Stapler and Staples', 'Watercolor Paint'];

    const productSalesChart = new Chart(productSalesCtx, {
        type: 'pie',
        data: {
            labels: productLabels,
            datasets: [{
                data: salesData,
                backgroundColor: ['#d1c4e9', '#d1c4e9', '#d1c4e9', '#d1c4e9', '#d1c4e9', '#d1c4e9', '#d1c4e9', '#d1c4e9', '#d1c4e9', '#d1c4e9'],
                hoverBackgroundColor: ['#b39ddb', '#b39ddb', '#b39ddb', '#b39ddb', '#b39ddb', '#b39ddb', '#b39ddb', '#b39ddb', '#b39ddb', '#b39ddb']
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'top',
                },
                tooltip: {
                    callbacks: {
                        label: function (context) {
                            const label = context.label || '';
                            const value = context.raw || 0;
                            const total = context.chart._metasets[0].total;
                            const percentage = ((value / total) * 100).toFixed(2);
                            return `${label}: ${value} (${percentage}%)`;
                        }
                    }
                }
            }
        }
    });
});

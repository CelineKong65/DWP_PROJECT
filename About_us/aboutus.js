document.addEventListener('DOMContentLoaded', () => {
    // Data for the pie chart
    const totalSales5Years = 54200;
    const totalOrders2024 = 7030;
    const totalCustomers2024 = 6500;

    // Create the pie chart
    const ctx = document.getElementById('salesChart').getContext('2d');
    const salesChart = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: ['Total Product Sales (5 Years)', 'Total Orders (2024)', 'Total Customers (2024)'],
            datasets: [{
                data: [totalSales5Years, totalOrders2024, totalCustomers2024],
                backgroundColor: ['#DABFFF', '#ADD8E6', '#FFB6C1'], // Updated colors
                hoverBackgroundColor: ['#DABFFF', '#ADD8E6', '#FFB6C1' ] // Updated colors
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,  // Allow the chart to adjust to container size
            plugins: {
                legend: {
                    position: 'top',
                },
                tooltip: {
                    callbacks: {
                        label: function(tooltipItem) {
                            const total = totalSales5Years + totalOrders2024 + totalCustomers2024;
                            const value = tooltipItem.raw;
                            const percentage = ((value / total) * 100).toFixed(2);
                            return ${tooltipItem.label}: ${value} (${percentage}%);
                        }
                    }
                }
            }
        }
    });

    // Slide-in animation logic (existing)
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
    checkVisibility(); // Initial check in case elements are already in view
});
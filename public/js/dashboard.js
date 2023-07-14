// STATISTIC SALE
let saleCount = document.querySelector('#sale-count');
let saleType = document.querySelector('#sale-type');
let percentDifference = document.querySelector('#percent-difference');
let difference = document.querySelector('#difference');
$('body').append('<div class="overlay"><div class="dot-spinner center"><div class="dot-spinner__dot"></div><div class="dot-spinner__dot"></div><div class="dot-spinner__dot"></div><div class="dot-spinner__dot"></div><div class="dot-spinner__dot"></div><div class="dot-spinner__dot"></div><div class="dot-spinner__dot"></div><div class="dot-spinner__dot"></div></div></div>')
$.ajax({
    url: '/api/statistic/sale/day',
    type: 'GET',
    success: function (response) {
        $('.overlay').remove()
        // console.log(response);
        saleCount.innerText = response.sales[0].sales_count;
        if (response.percentDifference > 0) {
            percentDifference.innerText = response.percentDifference + '%';
            percentDifference.style.color = 'green';
            difference.innerText = 'increase';
        } else {
            percentDifference.innerText = (response.percentDifference * -1) + '%';
            percentDifference.style.color = 'red';
            difference.innerText = 'decrease';
        }
    },
    error: function (error) {
        $('.overlay').remove()
        console.log(error);
    }
})

const statisticSale = document.getElementById('statistic-sale');
const popup = statisticSale.querySelector('.popup');
popup.addEventListener('click', function (event) {
    const target = event.target;
    if (target.tagName === 'LI') {
        const option = target.textContent;
        if (option === 'Today') {
            displayStatisticSale('day');
        } else if (option === 'This Month') {
            displayStatisticSale('month');
        } else if (option === 'This Year') {
            displayStatisticSale('year');
        }
    }
});

function displayStatisticSale(type) {
    $('body').append('<div class="overlay"><div class="dot-spinner center"><div class="dot-spinner__dot"></div><div class="dot-spinner__dot"></div><div class="dot-spinner__dot"></div><div class="dot-spinner__dot"></div><div class="dot-spinner__dot"></div><div class="dot-spinner__dot"></div><div class="dot-spinner__dot"></div><div class="dot-spinner__dot"></div></div></div>')
    $.ajax({
        url: '/api/statistic/sale/' + type,
        type: 'GET',
        success: function (response) {
            $('.overlay').remove()
            saleCount.innerText = response.sales[0].sales_count;
            if (type === 'day') {
                saleType.innerText = '| Today';
            } else if (type === 'month') {
                saleType.innerText = '| This Month';
            } else if (type === 'year') {
                saleType.innerText = '| This Year';
            }
            if (response.percentDifference > 0) {
                percentDifference.innerText = response.percentDifference + '%';
                percentDifference.style.color = 'green';
                difference.innerText = 'increase';
            } else {
                percentDifference.innerText = (response.percentDifference * -1) + '%';
                percentDifference.style.color = 'red';
                difference.innerText = 'decrease';
            }
        },
        error: function (error) {
            $('.overlay').remove()
            console.log(error);
        }
    })
}

// STATISTIC REVENUE
let revenuePrice = document.querySelector('#revenue-price');
let revenueType = document.querySelector('#revenue-type');
let percentDifferenceRevenue = document.querySelector('#percent-difference-revenue');
let differenceRevenue = document.querySelector('#difference-revenue');

$('body').append('<div class="overlay"><div class="dot-spinner center"><div class="dot-spinner__dot"></div><div class="dot-spinner__dot"></div><div class="dot-spinner__dot"></div><div class="dot-spinner__dot"></div><div class="dot-spinner__dot"></div><div class="dot-spinner__dot"></div><div class="dot-spinner__dot"></div><div class="dot-spinner__dot"></div></div></div>')
$.ajax({
    url: '/api/statistic/revenue/day',
    type: 'GET',
    success: function (response) {
        $('.overlay').remove()
        revenuePrice.innerText = response.revenues[0].revenue;
        if (response.percentDifference > 0) {
            percentDifferenceRevenue.innerText = response.percentDifference + '%';
            percentDifferenceRevenue.style.color = 'green';
            differenceRevenue.innerText = 'increase';
        } else {
            percentDifferenceRevenue.innerText = (response.percentDifference * -1) + '%';
            percentDifferenceRevenue.style.color = 'red';
            differenceRevenue.innerText = 'decrease';
        }
    },
    error: function (error) {
        $('.overlay').remove()
        console.log(error);
    }
})

const statisticRevenue = document.getElementById('statistic-revenue');
const popupRevenue = statisticRevenue.querySelector('.popup');
popupRevenue.addEventListener('click', function (event) {
    const target = event.target;
    if (target.tagName === 'LI') {
        const option = target.textContent;
        if (option === 'Today') {
            displayStatisticRevenue('day');
        } else if (option === 'This Month') {
            displayStatisticRevenue('month');
        } else if (option === 'This Year') {
            displayStatisticRevenue('year');
        }
    }
});

function displayStatisticRevenue(type) {
    $('body').append('<div class="overlay"><div class="dot-spinner center"><div class="dot-spinner__dot"></div><div class="dot-spinner__dot"></div><div class="dot-spinner__dot"></div><div class="dot-spinner__dot"></div></div></div>')
    $.ajax({
        url: '/api/statistic/revenue/' + type,
        type: 'GET',
        success: function (response) {
            $('.overlay').remove()
            revenuePrice.innerText = response.revenues[0].revenue;
            if (type === 'day') {
                revenueType.innerText = '| Today';
            } else if (type === 'month') {
                revenueType.innerText = '| This Month';
            } else if (type === 'year') {
                revenueType.innerText = '| This Year';
            }
            if (response.percentDifference > 0) {
                percentDifferenceRevenue.innerText = response.percentDifference + '%';
                percentDifferenceRevenue.style.color = 'green';
                differenceRevenue.innerText = 'increase';
            } else {
                percentDifferenceRevenue.innerText = (response.percentDifference * -1) + '%';
                percentDifferenceRevenue.style.color = 'red';
                differenceRevenue.innerText = 'decrease';
            }
        },
        error: function (error) {
            $('.overlay').remove()
            console.log(error);
        }
    })
}

// STATISTIC CHART
$('body').append('<div class="overlay"><div class="dot-spinner center"><div class="dot-spinner__dot"></div><div class="dot-spinner__dot"></div><div class="dot-spinner__dot"></div><div class="dot-spinner__dot"></div><div class="dot-spinner__dot"></div><div class="dot-spinner__dot"></div><div class="dot-spinner__dot"></div><div class="dot-spinner__dot"></div></div></div>')
$.ajax({
    url: '/api/statistic/chart/line',
    type: 'GET',
    success: function (response) {
        $('.overlay').remove()
        const values = response.sales.map(sale => sale.sales_count);
        const monthNames = [
            'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
            'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'
        ];
        const labels = response.sales.map(sale => {
            // const date = new Date(sale.created_at);
            // return monthNames[date.getMonth()];
            return monthNames[sale.sale_month - 1];
        });
        
        new ApexCharts(document.querySelector("#lineChart"), {
            series: [{
                name: "Wristwatch",
                data: values
            }],
            chart: {
                height: 340,
                type: 'line',
                zoom: {
                    enabled: false
                }
            },
            dataLabels: {
                enabled: false
            },
            stroke: {
                curve: 'straight'
            },
            grid: {
                row: {
                    colors: ['#f3f3f3',
                        'transparent'], // takes an array which will be repeated on columns
                    opacity: 0.5
                },
            },
            xaxis: {
                categories: labels,
            }
        }).render();
    },
    error: function (error) {
        $('.overlay').remove()
        console.log(error);
    }
})

// PIE CHART
new ApexCharts(document.querySelector("#pieChart"), {
    series: [44, 55, 13, 43, 22],
    chart: {
        height: 350,
        type: 'pie',
        toolbar: {
            show: true
        }
    },
    labels: ['Team A', 'Team B', 'Team C', 'Team D', 'Team E']
}).render();
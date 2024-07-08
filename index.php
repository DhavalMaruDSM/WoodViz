<?php
include("components/header.php");
?>
    <style>
        .dashboard{
            display:flex;
        }
    .chart-box {
        background-color: #FFFFFF; 
        border: 1px solid #E0E0E0; 
        border-radius: 5px; 
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    }
    .chart-container {
        display: flex;
        flex-direction: column; 
        align-items: flex-start;
        width: 30%; 
    }
    .chart {
        width: 100%; 
    }
    #lineChart {
        flex-direction: row;
        background-color: #FFFFFF;
        border: 1px solid #E0E0E0;
        border-radius: 5px;
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        width: 65%; 
        height: 100%
        
    }
    
    .tabulator-table {
        width:101%;
        border: 0.1px solid #F0F0F0; 
        border-radius: 5px;
        box-shadow: 0 4px 8px rgba(0,0,0,0.1); Light shadow
    } 
    .table-container {
        display: flex;
        justify-content: space-between;
        margin-top: 20px;
    }
</style>

<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>









<div class="main" style="background-color: #F5F5F5;">
<div class="dashboard">
        <div class="chart-container">
            <div class="chart-box m-4 p-0">
                <div id="chart1" class="chart"></div>
            </div>
            <div class="chart-box ms-4 p-0 mb-4">
                <div id="chart2" class="chart"></div>
            </div>
            <div class="chart-box ms-4 mb-4 p-0">
                <div id="chart3" class="chart"></div>
            </div>
        </div>

        <div id="lineChart" class="chart mt-5 p-5"></div>
    </div>
    
    <div class="container-fluid mt-3 mb-5">
        <div class="row">
            <div class="col-lg-6 mt-5">
                <h4>Top Selling Products</h4>
                <div id="topSellingProducts" class="tabulator-table "></div>
            </div>
            <div class="col-lg-6 mt-5">
                <h4>Top Customers</h4>
                <div id="topCustomers" class="tabulator-table   "></div>
            </div>
        </div>
        
        <div class="row mt-4">
            <div class="col-lg-6 mt-5">
                <h4>Category Wise Sales</h4>
                <div id="pieChart" class="chart-box p-2"></div>
            </div>
            <div class="col-lg-6 mt-5">
                <h4>Top Unpaid Bills</h4>
                <div id="topUnpaidBills" class="tabulator-table"></div>
            </div>
        </div>
    </div>




    

    <script src="https://cdnjs.cloudflare.com/ajax/libs/tabulator/4.9.3/js/tabulator.min.js"></script>
    <script>
        
        var topSellingProductsData = [
            { id: 1, name: "Product 1", amount: 1000 },
            { id: 2, name: "Product 2", amount: 900 },
            { id: 3, name: "Product 3", amount: 800 },
            { id: 4, name: "Product 4", amount: 700 },
            { id: 5, name: "Product 5", amount: 600 }
        ];

        
        var topCustomersData = [
            { id: 1, name: "Customer 1", amount: 1500 },
            { id: 2, name: "Customer 2", amount: 1400 },
            { id: 3, name: "Customer 3", amount: 1300 },
            { id: 4, name: "Customer 4", amount: 1200 },
            { id: 5, name: "Customer 5", amount: 1100 }
        ];

        
        var topUnpaidBillsData = [
            { id: 1, invoiceNumber:"2407001", name: "Customer A", amount: 500 },
            { id: 2, invoiceNumber:"2407002", name: "Customer B", amount: 450 },
            { id: 3, invoiceNumber:"2407003", name: "Customer C", amount: 400 },
            { id: 4, invoiceNumber:"2407004", name: "Customer D", amount: 350 },
            { id: 5, invoiceNumber:"2407005", name: "Customer E", amount: 300 }
        ];

        new Tabulator("#topSellingProducts", {
            data: topSellingProductsData,
            layout: "fitColumns",
            columns: [
                { title: "Sno.", field: "id", sorter: "number", headerSort: false, hozAlign: "center" },
                { title: "Product Name", field: "name", sorter: "string", headerSort: false, hozAlign: "center" },
                { title: "Amount", field: "amount", sorter: "number", headerSort: false, hozAlign: "center" }
            ]
        });

        new Tabulator("#topCustomers", {
            data: topCustomersData,
            layout: "fitColumns",
            columns: [
                { title: "Sno.", field: "id", sorter: "number", headerSort: false, hozAlign: "center" },
                { title: "Customer Name", field: "name", sorter: "string", headerSort: false, hozAlign: "center" },
                { title: "Amount", field: "amount", sorter: "number", headerSort: false, hozAlign: "center" }
            ]
        });

        new Tabulator("#topUnpaidBills", {
    data: topUnpaidBillsData,
    layout: "fitColumns",
    columns: [
        { title: "Sno.", field: "id", sorter: "number", headerSort: false, hozAlign: "center", vertAlign: "middle" },
        { title: "Invoice Number", field: "invoiceNumber", sorter: "string", headerSort: false, hozAlign: "center", vertAlign: "middle" },
        { title: "Customer Name", field: "name", sorter: "string", headerSort: false, hozAlign: "center", vertAlign: "middle" },
        { title: "Amount", field: "amount", sorter: "number", headerSort: false, hozAlign: "center", vertAlign: "middle" }
    ]
});

        var optionsPieChart = {
            series: [44, 55, 13, 43, 22],
            chart: {
                width: 380,
                type: 'pie',
            },
            labels: ['Category A', 'Category B', 'Category C', 'Category D', 'Category E'],
            colors: ['#F0AB00', '#C9190B', '#5752D1', '#73C5C5', '#4CB140'], 
            responsive: [{
                breakpoint: 480,
                options: {
                    chart: {
                        width: 200
                    },
                    legend: {
                        position: 'bottom'
                    }
                }
            }]
        };

        var pieChart = new ApexCharts(document.querySelector("#pieChart"), optionsPieChart);
        pieChart.render();

        var options1 = {
            series: [100],
            chart: {
                height: 230, 
                type: 'radialBar',
            },
            plotOptions: {
                radialBar: {
                    hollow: {
                        size: '70%',
                    },
                    dataLabels: {
                        name: {
                            fontSize: '20px', 
                            color: '#ffc107' 
                        },
                        value: {
                            color: '#ffc107', 
                            fontSize: '18px',
                        }
                    },
                    track: {
                        background: '#F8F8F8',
                        strokeWidth: '100%',
                    }
                }
            },
            labels: ['Total Sales'],
            colors: ['#ffc107'] 
        };

        var options2 = {
            series: [70],
            chart: {
                height: 230, 
                type: 'radialBar',
            },
            plotOptions: {
                radialBar: {
                    hollow: {
                        size: '70%',
                    },
                    dataLabels: {
                        name: {
                            fontSize: '20px', 
                            color: '#28a745' 
                        },
                        value: {
                            color: '#28a745',
                            fontSize: '18px',
                        }
                    },
                    track: {
                        background: '#F8F8F8',
                        strokeWidth: '100%',
                    }
                }
            },
            labels: ['Total Paid'],
            colors: ['#28a745'] 
        };

        var options3 = {
            series: [30],
            chart: {
                height: 230, 
                type: 'radialBar',
            },
            plotOptions: {
                radialBar: {
                    hollow: {
                        size: '70%',
                    },
                    dataLabels: {
                        name: {
                            fontSize: '20px', 
                            color: '#dc3545' 
                        },
                        value: {
                            color: '#dc3545', 
                            fontSize: '18px',
                        }
                    },
                    track: {
                        background: '#F8F8F8',
                        strokeWidth: '100%',
                    }
                }
            },
            labels: ['Total Unpaid'],
            colors: ['#dc3545'] 
        };

        var chart1 = new ApexCharts(document.querySelector("#chart1"), options1);
        chart1.render();

        var chart2 = new ApexCharts(document.querySelector("#chart2"), options2);
        chart2.render();

        var chart3 = new ApexCharts(document.querySelector("#chart3"), options3);
        chart3.render();
        
        var optionsLineChart = {
            series: [
                {
                    name: "Sales",
                    data: [300, 400, 350, 500, 490, 600, 700, 800, 810, 600, 550, 400],
                },
            ],
            chart: {
                height: 350,
                type: "line",
            },
            title: {
                text: "Monthly Sales Data for 2024",
            },
            xaxis: {
                categories: [
                    "Jan",
                    "Feb",
                    "Mar",
                    "Apr",
                    "May",
                    "Jun",
                    "Jul",
                    "Aug",
                    "Sep",
                    "Oct",
                    "Nov",
                    "Dec",
                ],
                title: {
                    text: "Months",
                },
            },
            yaxis: {
                title: {
                    text: "Sales",
                },
            },
            legend: {
                position: "top",
            },
        };

        var lineChart = new ApexCharts(document.querySelector("#lineChart"), optionsLineChart);
        lineChart.render();
    </script>
</div>

<?php
include("components/footer.php");
?>
<?php
include("components/header.php");
?>
    <style>
        /* .dashboard{
            display:flex;
        }*/
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
        box-shadow: 0 4px 8px rgba(0,0,0,0.1); 
    } 
    .table-container {
        display: flex;
        justify-content: space-between;
        margin-top: 20px;
    }
</style>

<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>









<div class="main" style="background-color: #F5F5F5;">
    <div class="row">
        <div class="chart-container col-lg-2">
            <div class="chart-box m-4 p-0 ">
                <div id="chart1" class="chart"></div>
            </div>
            
        
            <div class="chart-box ms-4 p-0 mb-4 ">
                <div id="chart2" class="chart"></div>
            </div>
        
            <div class="chart-box ms-4 mb-4 p-0 ">
                <div id="chart3" class="chart"></div>
            </div>
        </div>
        <div id="lineChart" class="chart mt-4 p-1 col-lg-8"></div>
    </div>
    
    <div class="container-fluid mt-3 mb-5">
        <div class="row">
            <div class="col-lg-6 mt-5 p-4">
                <h4 class="text-center">Top Selling Products</h4>
                <div id="topSellingProducts" class="tabulator-table"></div>
            </div>
            <div class="col-lg-6 mt-5 p-4">
                <h4 class="text-center">Top Customers</h4>
                <div id="topCustomers" class="tabulator-table"></div>
            </div>
        </div>
        
        <div class="row mt-4">
            <div class="col-lg-6 mt-0 p-4">
                <h4 class="text-center">Category Wise Sales</h4>
                <div id="pieChart" class="chart-box p-2"></div>
            </div>
            <div class="col-lg-6 mt-0 p-4">
                <h4 class="text-center">Top Unpaid Bills</h4>
                <div id="topUnpaidBills" class="tabulator-table"></div>
            </div>
        </div>
    </div>
</div>



    

    <script src="https://cdnjs.cloudflare.com/ajax/libs/tabulator/4.9.3/js/tabulator.min.js"></script>
    <script>
    fetch('php/fetch-dashboard-data.php')
        .then(response => response.json())
        .then(data => {
            function calculatePercentage(value, total) {
                return (value / total) * 360; 
            }
            // Function to add serial numbers
            function addSerialNumbers(dataArray) {
                return dataArray.map((item, index) => {
                    item.serialNumber = index + 1;
                    return item;
                });
            }

            // Add serial numbers to data arrays
            var monthlySalesData = data.monthlySales;
            var months = data.months;
            var topSellingProductsData = addSerialNumbers(data.topSellingProducts);
            var topCustomersData = addSerialNumbers(data.topCustomers);
            var topUnpaidBillsData = addSerialNumbers(data.topUnpaidBills);
            var categorySalesData = addSerialNumbers(data.categorySales);

            // Initialize Tabulator tables with serial numbers
            new Tabulator("#topSellingProducts", {
                data: topSellingProductsData,
                layout: "fitColumns",
                columns: [
                    { title: "Sno.", field: "serialNumber", sorter: "number", headerSort: false, hozAlign: "center" },
                    { title: "Product Name", field: "name", sorter: "string", headerSort: false, hozAlign: "center" },
                    { title: "Amount", field: "amount", sorter: "number", headerSort: false, hozAlign: "center" }
                ]
            });

            new Tabulator("#topCustomers", {
                data: topCustomersData,
                layout: "fitColumns",
                columns: [
                    { title: "Sno.", field: "serialNumber", sorter: "number", headerSort: false, hozAlign: "center" },
                    { title: "Customer Name", field: "name", sorter: "string", headerSort: false, hozAlign: "center" },
                    { title: "Amount", field: "amount", sorter: "number", headerSort: false, hozAlign: "center" }
                ]
            });

            new Tabulator("#topUnpaidBills", {
                data: topUnpaidBillsData,
                layout: "fitColumns",
                columns: [
                    { title: "Sno.", field: "serialNumber", sorter: "number", headerSort: false, hozAlign: "center" },
                    { title: "Invoice Number", field: "invoice_id", sorter: "string", headerSort: false, hozAlign: "center" },
                    { title: "Customer Name", field: "name", sorter: "string", headerSort: false, hozAlign: "center" },
                    { title: "Amount", field: "amount", sorter: "number", headerSort: false, hozAlign: "center" }
                ]
            });
            var totalCategorySales = data.categorySales.reduce((acc, curr) => acc + curr.total, 0);
            var categorySalesData = data.categorySales.map(item => {
                return calculatePercentage(item.total, totalCategorySales);
            });

            var categoryLabels = data.categorySales.map(item => {
                return `Category ${item.category_id}`; // Adjust to use item.category_name if available
            });

            // Define pie chart options
            var optionsPieChart = {
                series: categorySalesData,
                chart: {
                    width: 380,
                    type: 'pie',
                },
                labels: categoryLabels,
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
                series: [data.totalSales],
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
                                formatter: function (val) {
                                    return `₹ ${val}`; // Display the actual value
                                }
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
                series: [data.totalPaid],
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
                                formatter: function (val) {
                                    return `₹ ${val}`; // Display the actual value
                                }
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
                series: [data.totalUnpaid],
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
                                formatter: function (val) {
                                    return `₹ ${val}`; // Display the actual value
                                }
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

            // Define line chart options
            var optionsLineChart = {
                series: [
                    {
                        name: "Sales",
                        data: data.monthlySales,
                    },
                ],
                chart: {
                    height: 600,
                    type: "line",
                },
                title: {
                    text: "Monthly Sales Data for 2024",
                },
                xaxis: {
                    categories: months,
                    title: {
                        text: "Months",
                    },
                },
                yaxis: {
                    title: {
                        text: "Sales",
                    },
                    min: 0,
                },
                legend: {
                    position: "top",
                },
            };

            var lineChart = new ApexCharts(document.querySelector("#lineChart"), optionsLineChart);
            lineChart.render();
        })
        .catch(error => console.error('Error fetching data:', error));
</script>
</div>

<?php
include("components/footer.php");
?>
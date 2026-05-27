@extends('layouts.app')

@section('content')

<style>
.chart-toggle-btn {
    padding: 8px 14px;
    border-radius: 8px;
    font-weight: 600;
    transition: 0.3s;
}

/* DARK MODE */
html[data-theme="dark"] .chart-toggle-btn {
    background: #1f2937;
    color: #e5e7eb;
    border: 1px solid #374151;
}

/* LIGHT MODE */
html[data-theme="light"] .chart-toggle-btn {
    background: #111827;
    color: #ffffff;
    border: 1px solid #111827;
}

.chart-box {
    overflow-x: auto;
    padding: 16px;
    border-radius: 12px;
    
    display: flex;
    flex-direction: column;
    gap: 16px;

    /* ✅ smooth scrolling feel */
    scroll-behavior: smooth;
}

/* scrollbar styling */
.chart-box::-webkit-scrollbar {
    height: 8px;
}
.chart-box::-webkit-scrollbar-thumb {
    background: #475569;
    border-radius: 10px;
}
.form-control.form-select {
    height: 38px;
    font-size: 14px;
}

/* ✅ ADDED: Stockout Theme Support */
.stockout-box {
    margin-top: 15px;
    padding: 12px;
    border-radius: 8px;
}

html[data-theme="dark"] .stockout-box {
    background: #020617;
    color: #e5e7eb;
    border: 1px solid #334155;
}

html[data-theme="light"] .stockout-box {
    background: #ffffff;
    color: #111827;
    border: 1px solid #d1d5db;
}
</style>

<div class="px-8 py-6">

    <h1 class="text-2xl font-bold mb-4">
        {{ $product->name }} Demand Frequency
    </h1>

    

    <div class="chart-box">
        <div class="mb-4 flex gap-2">
        <select id="trendType" class="form-control form-select">
            <option value="day">Daily</option>
            <option value="week">Weekly</option>
            <option value="month">Monthly</option>
            <option value="year">Yearly</option>
        </select>
    </div>
    
        <div class="stockout-box">
    <h2 class="text-lg font-bold mb-2">Product Summary</h2>
    <p id="totalSales"></p>
    <p id="totalStocks"></p> <!-- ✅ ADD THIS -->
    <p id="salesRate"></p>
</div>
        <!-- Month selector ABOVE chart -->
        <select id="monthSelector" class="form-control form-select" style="display:none;"></select>

        <canvas id="chart" height="120"></canvas>

        <button id="toggleChart" class="chart-toggle-btn">
            Switch to Bar Graph
        </button>

        <!-- ✅ ADDED: STOCKOUT REPORT -->
        <div id="stockoutSection" class="stockout-box">
            <h2 class="text-lg font-bold mb-2">"No Current Stock" Days</h2>
            <p id="stockoutCount"></p>
            <ul id="stockoutList" style="margin-left:20px;"></ul>
        </div>

        <div id="stockoutSection" class="stockout-box">
            <h2 class="text-lg font-bold mb-2">Note: </h2>
            <p>If date isn't included in graph and list above when the product has been bought before, no one bought the product whilst stock is available.</p>
            <ul id="stockoutList" style="margin-left:20px;"></ul>
        </div>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
let chart;
let chartType = 'line'; // default
let selectedMonth = null;

function isDarkMode() {
    return document.documentElement.getAttribute('data-theme') === 'dark';
}

function getTheme() {
    return isDarkMode()
        ? { text:"#e5e7eb", grid:"#334155" }
        : { text:"#111827", grid:"#e5e7eb" };
}

/* ✅ ADDED: STOCKOUT FUNCTION */
/* ✅ UPDATED: STOCKOUT FUNCTION (Zero Stock AND Zero Orders) */
function calculateStockouts(labels, stocks, sales) {
    let stockoutDays = [];

    labels.forEach((label, index) => {
        const stockValue = stocks[index];
        const orderValue = sales[index];

        // Skip if data is missing
        if (stockValue === null || orderValue === null) return;

        const currentStock = Number(stockValue);
        const currentOrders = Number(orderValue);

        // ✅ Logic: Stock is empty AND orders are zero
        if (currentStock === 0 && currentOrders === 0) {
            const d = new Date(label);
            if (!isNaN(d)) {
                const formatted =
                    `${String(d.getMonth()+1).padStart(2,'0')}/` +
                    `${String(d.getDate()).padStart(2,'0')}/` +
                    `${d.getFullYear()}`;
                stockoutDays.push(formatted);
            }
        }
    });

    return stockoutDays;
}

/* ===== PROCESSING FUNCTIONS ===== */
function processDailyData(labels, sales) {
    // ✅ Find where the graph actually starts
    let startIndex = 0;
    for (let i = 0; i < sales.length; i++) {
        if (Number(sales[i]) > 0) {
            startIndex = i;
            break;
        }
    }

    // Trim arrays
    let trimmedLabels = labels.slice(startIndex);
    let trimmedSales = sales.slice(startIndex);

    // Convert labels to day numbers for the X-axis
    let newLabels = trimmedLabels.map(l => new Date(l).getDate());

    const latestDate = new Date(Math.max(...trimmedLabels.map(d => new Date(d))));
    const monthYear = `${String(latestDate.getMonth()+1).padStart(2,'0')}-${latestDate.getFullYear()}`;

    return { 
        labels: newLabels, 
        sales: trimmedSales, 
        monthYear, 
        startIndex // We return this to trim stocks later
    };
}
function processWeeklyData(labels, sales) {
    let newLabels = [];
    let newSales = [];
    let seen = new Set();
    labels.forEach((label, index) => {
        let finalDate = label.includes(' - ') ? label.split(' - ')[1] : label;
        if(!seen.has(finalDate)){
            seen.add(finalDate);
            newLabels.push(finalDate);
            newSales.push(sales[index]);
        }
    });
    return { labels: newLabels, sales: newSales };
}

/* ===== MONTH SELECTOR ===== */
function populateMonthSelector(labels, mode = 'month') {
    const selector = document.getElementById('monthSelector');
    selector.innerHTML = '';

    if (mode === 'year') {
        const years = getAvailableYears(labels);

        years.forEach(year => {
            const opt = document.createElement('option');
            opt.value = year;
            opt.text = year;
            selector.appendChild(opt);
        });

        if (!selectedMonth && years.length) {
            selectedMonth = String(years[0]);
        }

        selector.value = selectedMonth;
        selector.style.display = 'block';
        return;
    }

    // MONTH MODE
    const months = new Set();
    labels.forEach(label => {
    let d;

    // ✅ ADD THIS
    if (label.includes(' - ')) {
    const [startStr, endStr] = label.split(' - ');
    const start = new Date(startStr);
    const end = new Date(endStr);

    if (!isNaN(start) && !isNaN(end)) {
        // ✅ Always include start month
        months.add(`${start.getFullYear()}-${start.getMonth() + 1}`);

        // ✅ ONLY include end month if different
        if (
            start.getMonth() !== end.getMonth() ||
            start.getFullYear() !== end.getFullYear()
        ) {
            months.add(`${end.getFullYear()}-${end.getMonth() + 1}`);
        }
    }
    return;
} else {
        d = new Date(label);
    }

    if (!isNaN(d)) {
        months.add(`${d.getFullYear()}-${d.getMonth() + 1}`);
    }
});

    const sorted = Array.from(months).sort((a, b) => {
        const [yA, mA] = a.split('-').map(Number);
        const [yB, mB] = b.split('-').map(Number);
        return yB * 12 + mB - (yA * 12 + mA);
    });

    sorted.forEach(key => {
        const [y, m] = key.split('-');
        const opt = document.createElement('option');
        opt.value = key;
        opt.text = new Date(y, m - 1).toLocaleString('default', {
            month: 'long',
            year: 'numeric'
        });
        selector.appendChild(opt);
    });

    if (!selectedMonth && sorted.length) {
        selectedMonth = sorted[0];
    }

    selector.value = selectedMonth;
    selector.style.display = 'block';
}

function getLatestMonth(labels) {
    const dates = labels
        .map(d => new Date(d))
        .filter(d => !isNaN(d));

    if (!dates.length) return null;

    const latest = new Date(Math.max(...dates));
    return `${latest.getFullYear()}-${latest.getMonth() + 1}`;
}

function getAvailableYears(labels) {
    const years = new Set();
    labels.forEach(l => {
        const d = new Date(l);
        if (!isNaN(d)) years.add(d.getFullYear());
    });
    return Array.from(years).sort((a, b) => b - a);
}

/* ✅ UPDATED: CALCULATE TOTAL SALES + SALES RATE */
function calculateTotals(sales) {
    let totalSales = 0;

    sales.forEach(qty => {
        totalSales += qty;
    });

    const daysCount = sales.length > 0 ? sales.length : 1;
    const salesRate = totalSales / daysCount;

    return { totalSales, salesRate };
}

function filterByMonth(labels, sales, stocks, monthValue) {
    if (!monthValue) return { labels, sales, stocks };

    const [year, month] = monthValue.split('-').map(Number);

    let filteredLabels = [];
    let filteredSales = [];
    let filteredStocks = [];

    labels.forEach((label, index) => {
        let d;

        // ✅ FIX: HANDLE WEEK RANGE
        if (label.includes(' - ')) {
    const [startStr, endStr] = label.split(' - ');
    const start = new Date(startStr);
    const end = new Date(endStr);

    if (isNaN(start) || isNaN(end)) return;

    const startMonthMatch =
        start.getFullYear() === year &&
        (start.getMonth() + 1) === month;

    const endMonthMatch =
        end.getFullYear() === year &&
        (end.getMonth() + 1) === month;

    // ✅ INCLUDE if:
    // 1. Week starts in this month
    // OR
    // 2. Week ends in this month (carry-over case)
    if (startMonthMatch || endMonthMatch) {
        filteredLabels.push(label);
        filteredSales.push(sales[index]);
        filteredStocks.push(stocks[index] ?? null);
    }

    return;
} else {
            d = new Date(label);
        }

        if (!isNaN(d) &&
            d.getFullYear() === year &&
            (d.getMonth() + 1) === month) {

            filteredLabels.push(label);
            filteredSales.push(sales[index]);
            filteredStocks.push(stocks[index] ?? null);
        }
    });

    return {
        labels: filteredLabels,
        sales: filteredSales,
        stocks: filteredStocks
    };
}

/* ===== LOAD TREND ===== */
function loadTrend(type, monthValue = null) {
    if (monthValue !== null && type === 'day') {
    selectedMonth = monthValue;
}
    let url = `/api/product-trend/{{ $product->id }}/${type}`;
    if(monthValue) url += `?month=${monthValue}`;

    fetch(url)
        .then(res => res.json())
        .then(data => {
            if(chart) chart.destroy();
            const theme = getTheme();
            const ctx = document.getElementById('chart');
            const container = ctx.parentElement;
const selector = document.getElementById('monthSelector');
const stockoutSection = document.getElementById('stockoutSection');

// ✅ Show ONLY for daily
if (type === 'day') {
    stockoutSection.style.display = 'block';
} else {
    stockoutSection.style.display = 'none';
}

// ✅ YEARLY MODE: REMOVE FROM LAYOUT COMPLETELY
if (type === 'year') {
    selectedMonth = null;
    selector.style.display = 'none';
    selector.innerHTML = '';
}
            let labels = data.labels;
let sales = data.sales;
let stocks = data.stocks || [];
            let xAxisTitle = 'Time';

            let originalLabels = [...labels];
            let originalSales = [...sales];
            let tooltipLabels = [...labels]; // ✅ will always match chart
            let filteredOriginalLabels = [...labels]; 

            if (type === 'day') {
    if (!selectedMonth) {
        selectedMonth = getLatestMonth(data.labels);
    }

    populateMonthSelector(data.labels, 'month');

    const filtered = filterByMonth(labels, sales, stocks, selectedMonth);

    // Apply filtering
    labels = filtered.labels;
    sales = filtered.sales;
    stocks = filtered.stocks;

    // ✅ NEW: Trim the data to match the graph's starting point
    const processed = processDailyData(labels, sales);
    
    // Synchronize everything to the processed start index
    labels = processed.labels; // Day numbers (1, 2, 3...)
    sales = processed.sales;   
    stocks = stocks.slice(processed.startIndex); // Trim stocks to match
    filteredOriginalLabels = filtered.labels.slice(processed.startIndex); // Trim full dates to match

    xAxisTitle = `Time (${processed.monthYear})`;
}


// ✅ MONTHLY: filter by year
if (type === 'month' && type !== 'year') {

    populateMonthSelector(data.labels, 'year');

    const years = getAvailableYears(data.labels);
    if (!years.length) return;

    selectedMonth = years.includes(Number(selectedMonth))
        ? selectedMonth
        : String(years[0]);

    const year = Number(selectedMonth);

    labels = labels.filter(l => {
        const d = new Date(l);
        return !isNaN(d) && d.getFullYear() === year;
    });

    let filteredSales = [];

labels.forEach((label, index) => {
    const d = new Date(label);
    if (!isNaN(d) && d.getFullYear() === year) {
        filteredSales.push(sales[index]);
    }
});

sales = filteredSales;

    xAxisTitle = `Time (${year})`;
}

if (type === 'week') {

    // ✅ Always populate dropdown FIRST
    populateMonthSelector(data.labels, 'month');
    selector.style.display = 'block';

    // ✅ Ensure we have a selected month
    if (!selectedMonth) {
        selectedMonth = getLatestMonth(data.labels);
    }

    // ✅ Apply filter AFTER selection
    const filtered = filterByMonth(data.labels, data.sales, data.stocks || [], selectedMonth);

    labels = filtered.labels;
    sales = filtered.sales;
    stocks = filtered.stocks;

    // ✅ Add carry-over ONLY for display (not as real week)
const previousWeek = data.labels.find(label => {
    if (!label.includes(' - ')) return false;

    const [startStr, endStr] = label.split(' - ');
    const start = new Date(startStr);
    const end = new Date(endStr);

    const [year, month] = selectedMonth.split('-').map(Number);

    return (
        !isNaN(start) &&
        !isNaN(end) &&
        end.getFullYear() === year &&
        (end.getMonth() + 1) === month &&
        (start.getMonth() + 1) !== month
    );
});

if (previousWeek) {
    const index = data.labels.indexOf(previousWeek);
    const [, endStr] = previousWeek.split(' - ');

    labels.unshift(endStr);          // show only end date
    sales.unshift(data.sales[index]); // same value
}

    // ❗ If still empty → fallback (prevents blank chart)
    if (labels.length === 0) {
        selectedMonth = getLatestMonth(data.labels);

        const retry = filterByMonth(data.labels, data.sales, data.stocks || [], selectedMonth);
        labels = retry.labels;
        sales = retry.sales;
        stocks = retry.stocks;
    }

    // ✅ Process weekly AFTER filtering
    const processed = processWeeklyData(labels, sales);
    labels = processed.labels;
    sales = processed.sales;

    tooltipLabels = [...labels];

    const [y, m] = selectedMonth.split('-');
    const formattedMonth = new Date(y, m - 1).toLocaleString('default', {
        month: 'long',
        year: 'numeric'
    });

    xAxisTitle = `Time (${formattedMonth})`;
}
            container.style.minWidth = (labels.length * 60) + 'px';

            Chart.defaults.font.family = 'Nunito';
            Chart.defaults.color = '#ffffff';
            Chart.defaults.font.size = 14;

            chart = new Chart(ctx, {
                type: chartType,
                data: {
                    labels: labels,
                    datasets: [{
    label: 'Transaction Volume',
    data: sales,
    borderColor: '#60a5fa',
    backgroundColor: chartType==='bar' ? '#60a5fa':'rgba(96,165,250,0.15)',
    fill: chartType==='line',

    pointRadius: chartType==='line'?5:0,
    pointHoverRadius: chartType==='line'?7:0,

    pointBackgroundColor: '#60a5fa', // optional but cleaner
    pointBorderColor: '#60a5fa',
    pointBorderWidth: 2,

    clip: false, // ✅ THIS FIXES THE CUTTING WITHOUT MOVING GRAPH

    borderWidth: 3,
    tension: chartType==='line'?0.4:0
}]
                },
                options: {
                    layout: {
    padding: {
        bottom: 10
    }
},
                    responsive: true,
                    plugins: {
                        tooltip: {
                            callbacks: {
                                // Inside your chart options -> plugins -> tooltip -> callbacks
title: function(context) {
    const index = context[0].dataIndex;
    // Get the label actually being displayed on the X-axis (e.g., "3")
    let displayLabel = context[0].chart.data.labels[index];
    
    // Get the current selected month/year from your dropdown
    const selector = document.getElementById('monthSelector');
    const selectedValue = selector.value; // Format: "YYYY-M" or "YYYY"

    if (document.getElementById('trendType').value === 'day' && selectedValue) {
        const [year, month] = selectedValue.split('-').map(Number);
        
        // Construct a full date object using the day number from the graph
        const d = new Date(year, month - 1, displayLabel);
        
        if (!isNaN(d)) {
            return `Date: ${
                String(d.getMonth() + 1).padStart(2, '0')}/${
                String(d.getDate()).padStart(2, '0')}/${
                d.getFullYear()
            }`;
        }
    }

    // Fallback for weekly/monthly/yearly views
    return `Period: ${displayLabel}`;
},
                                label: function(context) {
                                    return `Orders Confirmed: ${context.raw}`;
                                }
                            }
                        },
                        legend: {
                            labels: { color: "#ffffff", font: { size: 16, weight: 'bold' } }
                        }
                    },
                    scales: {
                        x: {
                            title: { display: true, text: xAxisTitle, color: "#ffffff", font: { size:20, weight:'bold' } },
                            ticks: { color:"#ffffff", font:{size:14} },
                            grid: { color: theme.grid },
                            min: -0.5
                        },
                        y: {
    beginAtZero: true,   // ✅ FORCE START AT 0
    min: 0,              // ✅ HARD FLOOR
    title: {
        display: true,
        text: 'Orders',
        color: "#ffffff",
        font: { size: 20, weight: 'bold' }
    },
    ticks: {
        color: "#ffffff",
        font: { size: 14 }
    },
    grid: { color: theme.grid }
}
                    }
                }
            });

const initialStock = {{ $product->default_stock ?? 100 }};
// ... (keep the chart = new Chart(...) code above)

            /* ✅ FIXED: SCOPE AND DATA ALIGNMENT */
            let stockoutDays = [];
            let displayedTotalOrders = 0;
            let displayedTotalStocks = 0;
            let countOfDays = sales.length > 0 ? sales.length : 1;

            if (type === 'day') {
                // We use the filtered labels and stocks directly
                stockoutDays = calculateStockouts(filteredOriginalLabels, stocks, sales);
                stockoutSection.style.display = 'block';
            } else {
                stockoutSection.style.display = 'none';
            }

            // Update Summary Text
            displayedTotalOrders = Number(sales.reduce((a, b) => a + Number(b), 0));
            displayedTotalStocks = Number(stocks.reduce((a, b) => a + Number(b), 0));
            
            const fixedRate = Math.round(displayedTotalStocks / countOfDays);

            // Update UI Elements
            document.getElementById('stockoutCount').innerText = `Total Days: ${stockoutDays.length}`;
            const list = document.getElementById('stockoutList');
            list.innerHTML = '';

            if (stockoutDays.length === 0) {
                list.innerHTML = '<li>All recent days have stocks</li>';
            } else {
                stockoutDays.forEach(date => {
                    const li = document.createElement('li');
                    li.innerText = date;
                    list.appendChild(li);
                });
            }

            document.getElementById('totalSales').innerText =
                `Total Orders Completed: ${displayedTotalOrders.toLocaleString()}`;

            document.getElementById('totalStocks').innerText =
                `Total Stocks Sold: ${displayedTotalStocks.toLocaleString()}`;

            const trendTypeDisplay = document.getElementById('trendType').value;
            document.getElementById('salesRate').innerText =
                `Stocks Sold: ${fixedRate.toLocaleString()}/${trendTypeDisplay}`;
        });
}

/* ===== EVENT LISTENERS ===== */
document.getElementById('trendType').addEventListener('change', function () {
    selectedMonth = null; // ✅ reset stale month/year
    loadTrend(this.value);
});

document.getElementById('toggleChart').addEventListener('click', function(){
    chartType = chartType==='line'?'bar':'line';
    this.innerText = chartType==='line'?'Switch to Bar Graph':'Switch to Line Graph';
    loadTrend(document.getElementById('trendType').value, document.getElementById('monthSelector').value);
});

document.getElementById('monthSelector').addEventListener('change', function() {
    selectedMonth = this.value;
    loadTrend(document.getElementById('trendType').value, selectedMonth);
});

loadTrend('day');

new MutationObserver(() => loadTrend(document.getElementById('trendType').value, document.getElementById('monthSelector').value))
    .observe(document.documentElement, { attributes:true, attributeFilter:['data-theme'] });

</script>

@endsection
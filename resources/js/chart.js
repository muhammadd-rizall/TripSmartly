// Revenue Chart Configuration dengan konsistensi yang lebih baik
const ctx = document.getElementById("revenueChart").getContext("2d");

// Data yang lebih konsisten dan realistis

// Extract data untuk chart
// Extract data untuk chart
const labels = monthlyData.map((item) => item.month);
const tripData = monthlyData.map((item) => parseFloat(item.trip) || 0);
const rentalData = monthlyData.map((item) => parseFloat(item.rental) || 0);
const totalData = monthlyData.map((item) => (parseFloat(item.trip) || 0) + (parseFloat(item.rental) || 0));


// Hitung nilai maksimum dengan padding untuk tampilan yang lebih baik
const maxValue = Math.max(...totalData);
const suggestedMax = Math.ceil((maxValue * 1.1) / 100000000) * 100000000; // Tambah 10% padding

const revenueChart = new Chart(ctx, {
    type: "line",
    data: {
        labels: labels,
        datasets: [
            {
                label: "Pendapatan Trip",
                data: tripData,
                borderColor: "#3B82F6",
                backgroundColor: "rgba(59, 130, 246, 0.1)",
                borderWidth: 3,
                fill: false,
                tension: 0.3,
                pointRadius: 5,
                pointHoverRadius: 8,
                pointBackgroundColor: "#3B82F6",
                pointBorderColor: "#ffffff",
                pointBorderWidth: 2,
                pointHoverBackgroundColor: "#3B82F6",
                pointHoverBorderColor: "#ffffff",
            },
            {
                label: "Pendapatan Rental",
                data: rentalData,
                borderColor: "#22C55E",
                backgroundColor: "rgba(34, 197, 94, 0.1)",
                borderWidth: 3,
                fill: false,
                tension: 0.3,
                pointRadius: 5,
                pointHoverRadius: 8,
                pointBackgroundColor: "#22C55E",
                pointBorderColor: "#ffffff",
                pointBorderWidth: 2,
                pointHoverBackgroundColor: "#22C55E",
                pointHoverBorderColor: "#ffffff",
            },
            {
                label: "Total Pendapatan",
                data: totalData,
                borderColor: "#9333EA",
                backgroundColor: "rgba(147, 51, 234, 0.1)",
                borderWidth: 3,
                fill: false,
                tension: 0.3,
                pointRadius: 5,
                pointHoverRadius: 8,
                pointBackgroundColor: "#9333EA",
                pointBorderColor: "#ffffff",
                pointBorderWidth: 2,
                pointHoverBackgroundColor: "#9333EA",
                pointHoverBorderColor: "#ffffff",
                borderDash: [8, 4],
            },
        ],
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: {
                display: true,
                position: "bottom",
                labels: {
                    padding: 20,
                    font: {
                        size: 12,
                        family: "Arial, sans-serif",
                    },
                    usePointStyle: true,
                    pointStyle: "circle",
                },
            },
            tooltip: {
                mode: "index",
                intersect: false,
                backgroundColor: "rgba(0, 0, 0, 0.8)",
                titleColor: "#ffffff",
                bodyColor: "#ffffff",
                borderColor: "rgba(255, 255, 255, 0.2)",
                borderWidth: 1,
                cornerRadius: 8,
                padding: 12,
                callbacks: {
                    label: function (context) {
                        let value = context.parsed.y;
                        let formattedValue;

                        if (value >= 1000000000) {
                            formattedValue =
                                "Rp " + (value / 1000000000).toFixed(1) + "B";
                        } else if (value >= 1000000) {
                            formattedValue = "Rp " + value / 1000000 + "M";
                        } else {
                            formattedValue =
                                "Rp " + value.toLocaleString("id-ID");
                        }

                        return context.dataset.label + ": " + formattedValue;
                    },
                },
            },
        },
        scales: {
            x: {
                display: true,
                title: {
                    display: true,
                    text: "Bulan",
                    font: {
                        size: 14,
                        weight: "bold",
                    },
                    color: "#374151",
                },
                grid: {
                    display: false,
                },
                ticks: {
                    font: {
                        size: 12,
                    },
                    color: "#6B7280",
                },
            },
            y: {
                display: true,
                title: {
                    display: true,
                    text: "Pendapatan (Rp)",
                    font: {
                        size: 14,
                        weight: "bold",
                    },
                    color: "#374151",
                },
                min: 0,
                max: 1000000000,
                ticks: {
                    stepSize: 50000000,
                    callback: function (value) {
                        if (value >= 1000000000) {
                            return (
                                "Rp " + (value / 1000000000).toFixed(1) + "B"
                            );
                        } else if (value >= 1000000) {
                            return "Rp " + value / 1000000 + "M";
                        } else {
                            return "Rp " + value.toLocaleString("id-ID");
                        }
                    },
                    font: {
                        size: 11,
                    },
                    color: "#6B7280",
                },
                grid: {
                    color: "rgba(0, 0, 0, 0.08)",
                    lineWidth: 1,
                },
            },
        },

        interaction: {
            mode: "index",
            intersect: false,
        },
        elements: {
            line: {
                tension: 0.3,
            },
            point: {
                hoverRadius: 8,
            },
        },
        animation: {
            duration: 2000,
            easing: "easeInOutQuart",
        },
    },
});

// Tambahkan responsivitas
window.addEventListener("resize", function () {
    revenueChart.resize();
});



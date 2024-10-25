const ctx1 = document.getElementById("linechart");

new Chart(ctx1, {
  type: "line",
  data: {
    labels: ["2021", "2022", "2023", "2024", "2025"],
    datasets: [
      {
        label: "Doanh thu",
        data: [5, 12, 16, 15, 25],
        backgroundColor: "#1ABB71",
        borderColor: "#1ABB71",
        fill: false,
        tension: 0.2,
        borderWidth: 2,
      },
    ],
  },
  options: {
    scales: {
      y: {
        beginAtZero: true,
      },
    },
  },
});

const ctx2 = document.getElementById("barchart");

new Chart(ctx2, {
  type: "bar",
  data: {
    labels: ["T2", "T3", "T4", "T5", "T6", "T7", "CN"],
    datasets: [
      {
        label: "Lượt khách mỗi ngày",
        data: [28, 30, 16, 15, 25, 100, 60],
        backgroundColor: "#1ABB71",
      },
    ],
  },
  options: {
    scales: {
      y: {
        beginAtZero: true,
      },
    },
  },
});

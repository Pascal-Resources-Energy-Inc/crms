$(function () {
  
  // Stacked Bar Chart -------> BAR CHART (Vertical)
  var options_stacked = {
    series: [
      {
        name: "330g LPG Cylinder",
        data: [44, 55, 41, 37, 22, 43, 21],
      },
      {
        name: "220g LPG Cylinder",
        data: [53, 32, 33, 52, 13, 43, 32],
      }
    ],
    chart: {
      fontFamily: "inherit",
      type: "bar",
      height: 350,
      stacked: true,
      toolbar: {
        show: false,
      },
    },
    grid: {
      borderColor: "transparent",
    },
    // Updated color palette for better contrast
    colors: [
      "#4F80FF",  // A calming blue color
      "#FF6A13",  // A vibrant orange
    ],
    plotOptions: {
      bar: {
        horizontal: false, // Change this to false to make the bars vertical
      },
    },
    stroke: {
      width: 1,
      colors: ["#fff"],
    },
    xaxis: {
      categories: ["Dealer 1", "Dealer 2", "Dealer 3", "Dealer 4", "Dealer 5", "Dealer 6", "Dealer 7"],
      labels: {
        formatter: function (val) {
          return val + "";
        },
        style: {
          colors: [
            "#a1aab2",
            "#a1aab2",
            "#a1aab2",
            "#a1aab2",
            "#a1aab2",
            "#a1aab2",
            "#a1aab2",
          ],
        },
      },
    },
    yaxis: {
      title: {
        text: undefined,
      },
      labels: {
        formatter: function (val) {
          return val + "K";
        },
        style: {
          colors: [
            "#a1aab2",
            "#a1aab2",
            "#a1aab2",
            "#a1aab2",
            "#a1aab2",
            "#a1aab2",
            "#a1aab2",
          ],
        },
      },
    },
    tooltip: {
      y: {
        formatter: function (val) {
          return val + "K";
        },
      },
      theme: "dark",
    },
    fill: {
      opacity: 1,
    },
    legend: {
      position: "top",
      horizontalAlign: "left",
      offsetX: 40,
      labels: {
        colors: ["#a1aab2"],
      },
    },
  };

  var chart_bar_stacked = new ApexCharts(
    document.querySelector("#chart-bar-stacked"),
    options_stacked
  );
  chart_bar_stacked.render();

});

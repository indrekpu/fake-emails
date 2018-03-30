

function createPieChart(chartId, dataLabels, data){
	var chartCanvas = document.getElementById(chartId).getContext("2d");
	var pieChart = new Chart(chartCanvas, {
		type: 'pie',
		data: {
			labels: dataLabels,
			datasets: [
				{
					data: data,
					backgroundColor: ["rgba(219, 0, 0, 0.6)", "rgba(0, 165, 2, 0.6)", "rgba(255, 195, 15, 0.6)", "rgba(55, 59, 66, 0.6)", "rgba(0, 0, 0, 0.6)"],
                	hoverBackgroundColor: ["rgba(219, 0, 0, 0.8)", "rgba(0, 165, 2, 0.8)", "rgba(255, 195, 15, 0.8)", "rgba(55, 59, 66, 0.8)", "rgba(0, 0, 0, 0.8)"]
				}
			]
		},
		options: {
			responsive: true
		}
	});
}
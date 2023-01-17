function createChart(dataset, chartnum){
  //document.write(answers);
  //const labels = [words];

  const data = {
    //labels: labels,
    datasets: [{
      label: 'Num Correct Answers',
      backgroundColor: 'rgb(255, 99, 132)',
      borderColor: 'rgb(255, 99, 132)',
      data: dataset,
    }]
  };

  const config = {
    type: 'bar',
    data: data,
    options: {}
  };
  const myChart = new Chart(
    document.getElementById(chartnum),
    config
  );
};

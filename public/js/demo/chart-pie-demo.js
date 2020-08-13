// Set new default font family and font color to mimic Bootstrap's default styling
Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#858796';

// Pie Chart Example
//https://anuncioslucena.test/admin/ad/stats
var req = new XMLHttpRequest();
req.open('GET', 'https://'+window.location.hostname+'/admin/category/stats', false);
var categories_data;
var labels = [];
var data = [];
var colors = ['#4e73df', '#1cc88a', '#36b9cc', '#e74a3b', '#f6c23e', '#5a5c69', '#f8f9fc', '#858796'];
var colorsHover = ['#2e59d9', '#17a673', '#2c9faf', '#e02d1b', '#f4b619', '#4a4c56', '#dde2f1', '#717384'];
req.onreadystatechange = function (aEvt) {
  if (req.readyState == 4) {
     if(req.status == 200){
      categories_data = JSON.parse(req.responseText);
      console.log(categories_data);
      let legend = document.getElementById('legend');
      for(let i = 0; i < categories_data.length; i++){
        labels.push(categories_data[i].name);
        data.push(categories_data[i].count);
        let span = document.createElement('span');
        span.className = 'mr-2';
        let itag = document.createElement('i')
        itag.className = 'fas fa-circle';
        itag.style.color = colors[i];
        span.insertBefore(itag, null);
        span.appendChild(document.createTextNode(" "+labels[i]));
        legend.insertBefore(span, null);
      }
     }
     else
      console.log("Error loading page\n");
  }
};
req.send(null);


var ctx = document.getElementById("myPieChart");
var myPieChart = new Chart(ctx, {
  type: 'doughnut',
  data: {
    labels: labels,//["Casas y Pisos", "Inmobiliaria", "Alquiler"],
    datasets: [{
      data: data,//[55, 30, 15],
      backgroundColor: colors,
      hoverBackgroundColor: colorsHover,
      hoverBorderColor: "rgba(234, 236, 244, 1)",
    }],
  },
  options: {
    maintainAspectRatio: false,
    tooltips: {
      backgroundColor: "rgb(255,255,255)",
      bodyFontColor: "#858796",
      borderColor: '#dddfeb',
      borderWidth: 1,
      xPadding: 15,
      yPadding: 15,
      displayColors: false,
      caretPadding: 10,
    },
    legend: {
      display: false
    },
    cutoutPercentage: 80,
  },
});

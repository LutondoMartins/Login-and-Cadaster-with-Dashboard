const lineConfig = {
  type: 'line',
  data: {
    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
    datasets: [{
      label: 'Organic',
      data: [100, 200, 150, 300, 250, 400],
      borderColor: '#34D399',
      fill: false
    }, {
      label: 'Paid',
      data: [50, 100, 75, 150, 125, 200],
      borderColor: '#7C3AED',
      fill: false
    }]
  },
  options: {
    responsive: true,
    plugins: {
      legend: {
        position: 'top',
        labels: {
          color: '#374151'
        }
      },
      title: {
        display: true,
        text: 'Users Access',
        color: '#374151'
      }
    }
  }
};

window.onload = function() {
  new Chart(document.getElementById('line'), lineConfig);
};
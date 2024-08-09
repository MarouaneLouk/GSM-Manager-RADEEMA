fetch('../php/chartMaker.php')
.then(response => {
   if (!response.ok) {
       throw new Error('Network response was not ok ' + response.statusText);
   }
   return response.json();
})
.then(data => {
   console.log(data);
   const labels = data.map(item => item.nom_entite);
   const voixData = data.map(item => item.voix);
   const dataData = data.map(item => item.data);

   const ctx = document.getElementById('myChart').getContext('2d');
   const myChart = new Chart(ctx, {
       type: 'bar',
       data: {
           labels: labels,
           datasets: [{
               label: 'Voix',
               data: voixData,
               backgroundColor: 'rgba(149, 175, 118, 0.799)',
               borderColor: 'rgba(149, 175, 118, 1)',
               borderWidth: 1
           },
           {
               label: 'Data',
               data: dataData,
               backgroundColor: 'rgba(88, 175, 118, 0.799)',
               borderColor: 'rgba(88, 175, 118, 1)',
               borderWidth: 1
           }]
       },
       options: {
           responsive: true,
           maintainAspectRatio: false,
           aspectRatio: 2,
           plugins: {
               legend: {
                   display: true,
                   position: 'top',
                   labels: {
                       color: 'rgba(55, 55, 55, 1)',
                       font: {
                           size: 14,
                       },
                   },
               }
           },
           scales: {
               x: {
                   title: {
                       display: true,
                       text: 'Entités',
                       color: 'rgba(55, 55, 55, 1)',
                       font: {
                           size: 13,
                           weight: 'bold',
                           family: 'Syne',
                       },
                       padding: { top: 10 },
                   },
                   ticks: {
                       color: 'rgba(55, 55, 55, 1)',
                       font: {
                           size: 12,
                       },
                   }
               },
               y: {
                   beginAtZero: true,
                   title: {
                       display: true,
                       text: 'Nombre De Puces',
                       color: 'rgba(55, 55, 55, 1)',
                       font: {
                           size: 13,
                           weight: 'bold',
                           family: 'Syne',
                       },
                       padding: { bottom: 10 }
                   },
                   ticks: {
                       color: 'rgba(55, 55, 55, 1)',
                       font: {
                           size: 12,
                       },
                   }
               }
           },
       }
   });
})
.catch(error => {
   console.error('Error fetching data:', error);
});
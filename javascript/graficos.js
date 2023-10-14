/* eslint-disable no-undef */
const barChartCanvas = document.getElementById('bar-chart-canvas').getContext('2d');
const barChartData = {
  labels: ['A', 'B', 'C', 'D', 'E'],
  datasets: [{
    label: 'Datos de ejemplo',
    data: [12, 19, 3, 5, 2],
    backgroundColor: 'rgba(75, 192, 192, 0.2)',
    borderColor: 'rgba(75, 192, 192, 1)',
    borderWidth: 1,
  }],
};
const barChart = new Chart(barChartCanvas, {
  type: 'bar',
  data: barChartData,
});
barChart.update();

// Cargar imágenes en orden y repetir el ciclo
const randomImageElement = document.getElementById('random-image-element');
const images = ['img/uno.jpg', 'img/dos.jpg', 'img/tres.jpg'];
let currentIndex = 0;

function loadNextImage() {
  const imageUrl = images[currentIndex];
  // Establecer una transición de 3 segundos
  randomImageElement.style.transition = 'opacity 3s';
  // Ocultar la imagen
  randomImageElement.style.opacity = 0;
  // Cargar la nueva imagen después de 3 segundos
  setTimeout(() => {
    randomImageElement.src = imageUrl;
    // Mostrar la imagen
    randomImageElement.style.opacity = 1;
    // Actualizar el índice para la siguiente imagen
    currentIndex = (currentIndex + 1) % images.length;
  }, 3000); // 3000 milisegundos = 3 segundos
}

// Iniciar la carga de la primera imagen
loadNextImage();

// Cargar imágenes en orden y repetir el ciclo
setInterval(loadNextImage, 5000); // 5000 milisegundos = 5 segundos

// Generar mensaje aleatorio
const messages = ['De todas las cosas que llevas puestas, tu actitud es la más importante.', 'La motivación es la gasolina del cerebro.', 'Ir juntos es comenzar, mantenerse juntos es progresar, trabajar juntos es triunfar.'];
const messageElement = document.getElementById('message-content');

setInterval(() => {
  const randomMessageIndex = Math.floor(Math.random() * messages.length);
  messageElement.textContent = messages[randomMessageIndex];
}, 5000);

// Generar gráfico circular
const pieChartCanvas = document.getElementById('pie-chart-canvas').getContext('2d');
const pieChartData = {
  labels: ['A', 'B', 'C', 'D', 'E'],
  datasets: [{
    data: [10, 20, 30, 15, 25],
    backgroundColor: ['red', 'blue', 'green', 'yellow', 'orange'],
  }],
};
const pieChart = new Chart(pieChartCanvas, {
  type: 'pie',
  data: pieChartData,
});
pieChart.update();

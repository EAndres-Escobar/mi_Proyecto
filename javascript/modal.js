(function modalFunction() {
  document.addEventListener('DOMContentLoaded', () => {
    const menuLinks = document.querySelectorAll('.navbar-link');
    const modalContainers = document.querySelectorAll('.modal-window');
    let isDragging = false;
    let initialX;
    let initialY;

    menuLinks.forEach((menuLink) => {
      menuLink.addEventListener('click', (event) => {
        event.preventDefault();
        const target = menuLink.getAttribute('data-target');
        const modalContent = document.getElementById(`modal-content-${target}`);
        const modalContainer = document.getElementById(`modal-container-${target}`);
        if (modalContent && modalContainer) {
          // Ocultar todos los contenedores modales antes de mostrar el nuevo
          modalContainers.forEach((container) => {
            const containerStyle = container.style;
            containerStyle.display = 'none';
          });
          modalContainer.style.display = 'block';
          modalContent.style.display = 'block';
        }
      });
    });

    modalContainers.forEach((modalContainer) => {
      const modalContainerStyle = modalContainer.style;

      // Manejar el arrastre de las ventanas modales
      modalContainer.addEventListener('mousedown', (event) => {
        if (event.target === modalContainer) {
          isDragging = true;
          initialX = event.clientX - modalContainer.offsetLeft;
          initialY = event.clientY - modalContainer.offsetTop;
        }
      });

      document.addEventListener('mousemove', (event) => {
        if (isDragging) {
          const newX = event.clientX - initialX;
          const newY = event.clientY - initialY;
          modalContainerStyle.left = `${newX}px`;
          modalContainerStyle.top = `${newY}px`;
        }
      });

      document.addEventListener('mouseup', () => {
        isDragging = false;
      });

      // Manejar el cierre de las ventanas modales
      modalContainer.querySelectorAll('.close-button').forEach((button) => {
        button.addEventListener('click', () => {
          modalContainerStyle.display = 'none';
        });
      });
    });
  });
}());

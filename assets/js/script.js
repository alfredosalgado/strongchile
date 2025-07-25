/* script.js */

// Espera a que todo el contenido del DOM (la página HTML) se cargue completamente antes de ejecutar el script.
// Esto es una buena práctica para evitar errores si el script intenta acceder a elementos que aún no existen.
document.addEventListener('DOMContentLoaded', () => {

  // --- LÓGICA PARA EL MENÚ MÓVIL (HAMBURGUESA) ---
  
  // 1. Obtenemos las referencias a los elementos del DOM: el botón y el menú desplegable.
  const mobileMenuButton = document.getElementById('mobile-menu-button');
  const mobileMenu = document.getElementById('mobile-menu');

  // 2. Verificamos que ambos elementos existan antes de agregar el evento.
  if (mobileMenuButton && mobileMenu) {
    // 3. Agregamos un "escuchador de eventos" que se activa cuando el usuario hace clic en el botón.
    mobileMenuButton.addEventListener('click', () => {
      // 4. La función "toggle" de classList agrega la clase 'hidden' si no existe, o la quita si ya existe.
      // En Tailwind CSS, la clase 'hidden' aplica 'display: none;', ocultando o mostrando el elemento.
      mobileMenu.classList.toggle('hidden');
    });
  }

  // --- LÓGICA PARA CAMBIAR EL FONDO DEL NAVBAR AL HACER SCROLL ---

  // 1. Obtenemos la referencia a la barra de navegación.
  const navbar = document.getElementById('navbar');
  
  if (navbar) {
    // 2. Agregamos un "escuchador de eventos" que se activa cada vez que el usuario hace scroll en la página.
    window.addEventListener('scroll', () => {
      // 3. Comprobamos si la cantidad de scroll vertical (window.scrollY) es mayor a 50 píxeles.
      if (window.scrollY > 50) {
        // Si es mayor, agregamos clases para darle un fondo negro semitransparente y una sombra.
        navbar.classList.add('bg-black', 'bg-opacity-90', 'shadow-lg');
      } else {
        // Si es menor o igual, quitamos esas clases para que vuelva a ser transparente.
        navbar.classList.remove('bg-black', 'bg-opacity-90', 'shadow-lg');
      }
    });
  }

  // --- FUNCIÓN PARA MOSTRAR MENSAJES (SISTEMA ORIGINAL) ---
  
  const showMessage = (message, type) => {
    const messageBox = document.createElement('div');
    // Se aplican estilos directamente para crear una notificación flotante.
    messageBox.style.position = 'fixed';
    messageBox.style.top = '20px';
    messageBox.style.left = '50%';
    messageBox.style.transform = 'translateX(-50%)';
    messageBox.style.padding = '16px';
    messageBox.style.color = 'white';
    messageBox.style.borderRadius = '8px';
    messageBox.style.zIndex = '1000';
    messageBox.style.boxShadow = '0 4px 8px rgba(0,0,0,0.2)';
    messageBox.style.maxWidth = '90%';
    messageBox.style.textAlign = 'center';
    
    // Color según el tipo de mensaje
    if (type === 'success') {
      messageBox.style.backgroundColor = '#28a745'; // Verde de éxito
    } else if (type === 'error') {
      messageBox.style.backgroundColor = '#dc3545'; // Rojo de error
    }
    
    messageBox.textContent = message;
    document.body.appendChild(messageBox);
    
    // La notificación desaparece después de 4 segundos.
    setTimeout(() => {
      if (document.body.contains(messageBox)) {
        document.body.removeChild(messageBox);
      }
    }, 4000);
  };

  // --- LÓGICA DEL FORMULARIO DE CONTACTO CON AJAX ---

  const form = document.getElementById('formContacto');

  if (form) {
    form.addEventListener('submit', async e => {
      e.preventDefault();
      const data = new FormData(form);
      
      try {
        const res = await fetch('enviar.php', { method: 'POST', body: data });
        const text = await res.text();
        
        if (text.trim() === 'Mensaje enviado correctamente.') {
          showMessage('¡Gracias por tu mensaje! Formulario enviado con éxito.', 'success');
          form.reset();
        } else {
          showMessage(text, 'error');
        }
      } catch (err) {
        console.error(err);
        showMessage('Error en la petición. Por favor, intenta nuevamente.', 'error');
      }
    });
  }

  // --- LÓGICA DEL FORMULARIO DE FICHA TÉCNICA CON AJAX ---

  const formFicha = document.getElementById('formFicha');

  if (formFicha) {
    formFicha.addEventListener('submit', async e => {
      e.preventDefault();
      const data = new FormData(formFicha);
      
      try {
        const res = await fetch('enviar_ficha.php', { method: 'POST', body: data });
        const result = await res.json();
        
        if (result.success) {
          showMessage(result.message, 'success');
          formFicha.reset();
        } else {
          showMessage(result.message, 'error');
        }
      } catch (err) {
        console.error(err);
        showMessage('Error al enviar la ficha técnica. Por favor, intenta nuevamente.', 'error');
      }
    });
  }

  // --- LÓGICA PARA BOTÓN FLOTANTE "VOLVER ARRIBA" ---

  // 1. Obtenemos la referencia al botón.
  const scrollTopBtn = document.getElementById('scrollTopBtn');

  if (scrollTopBtn) {
    // 2. Agregamos un "escuchador de eventos" de scroll a la ventana.
    window.addEventListener('scroll', () => {
      // 3. Comprobamos si el scroll es mayor a 300 píxeles.
      if (window.scrollY > 300) {
        // Si es mayor, quitamos las clases que lo ocultan para hacerlo visible.
        scrollTopBtn.classList.remove('hidden', 'opacity-0');
      } else {
        // Si no, volvemos a agregar las clases para ocultarlo.
        scrollTopBtn.classList.add('hidden', 'opacity-0');
      }
    });

    // 4. Agregamos un "escuchador de eventos" de clic al botón.
    scrollTopBtn.addEventListener('click', () => {
      // 5. Al hacer clic, le decimos a la ventana que haga scroll hasta la posición 0 (el inicio)
      // con un comportamiento "smooth" (suave).
      window.scrollTo({
        top: 0,
        behavior: 'smooth'
      });
    });
  }
});
document.addEventListener("DOMContentLoaded", () => {
    const toggleBtn = document.getElementById('themeToggleBtn');
    const htmlElement = document.documentElement;
    const iconLight = document.getElementById('iconLight');
    const iconDark = document.getElementById('iconDark');
  
    // Function to switch icons
    function updateIcons(theme) {
      if (theme === 'dark') {
        iconLight.classList.add('d-none');
        iconDark.classList.remove('d-none');
      } else { 
        iconLight.classList.remove('d-none');
        iconDark.classList.add('d-none');
      }
    }
  
    // Load saved theme or auto-detect based on system preference
    const savedTheme = localStorage.getItem('theme');
    if (savedTheme) {
      htmlElement.setAttribute('data-bs-theme', savedTheme);
      updateIcons(savedTheme);
    } else {
      const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
      const defaultTheme = prefersDark ? 'dark' : 'light';
      htmlElement.setAttribute('data-bs-theme', defaultTheme);
      updateIcons(defaultTheme);
    }
  
    // Handle button click
    toggleBtn.addEventListener('click', () => {
      const currentTheme = htmlElement.getAttribute('data-bs-theme');
      const newTheme = currentTheme === 'dark' ? 'light' : 'dark';
      htmlElement.setAttribute('data-bs-theme', newTheme);
      localStorage.setItem('theme', newTheme);
      updateIcons(newTheme);
    });
  });
  
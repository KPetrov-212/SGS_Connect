document.addEventListener("DOMContentLoaded", () => {
  const toggleBtn = document.getElementById('themeToggleBtn');
  const htmlElement = document.documentElement;
  const iconLight = document.getElementById('iconLight');
  const iconDark = document.getElementById('iconDark');

  // Function to toggle theme and update icons
  const setTheme = (theme) => {
    htmlElement.setAttribute('data-bs-theme', theme);
    localStorage.setItem('theme', theme);
    iconLight.classList.toggle('d-none', theme === 'dark');
    iconDark.classList.toggle('d-none', theme === 'light');
  };

  // Initialize theme
  const savedTheme = localStorage.getItem('theme');
  const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
  const initialTheme = savedTheme || (prefersDark ? 'dark' : 'light');
  setTheme(initialTheme);

  // Handle button click to toggle theme
  toggleBtn.addEventListener('click', () => {
    const currentTheme = htmlElement.getAttribute('data-bs-theme');
    setTheme(currentTheme === 'dark' ? 'light' : 'dark');
  });
});

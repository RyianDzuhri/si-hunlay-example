/* public/js/admin/auth/login.js */
function initLogin() {
    const form = document.querySelector('.form');
    if (!form) return;
  
    form.addEventListener('submit', async (e) => {
      e.preventDefault();
      const email = form.querySelector('#email').value;
      const password = form.querySelector('#password').value;
      const csrfToken = document.querySelector('meta[name="csrf-token"]').content;
  
      if (!email || !password) {
        alert('Email dan password harus diisi!');
        return;
      }
  
      try {
        const response = await fetch(form.action, {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfToken,
          },
          body: JSON.stringify({ email, password }),
        });
  
        if (response.ok) {
          window.location.href = '/admin/dashboard';
        } else {
          const error = await response.json();
          alert(error.message || 'Login gagal. Periksa email atau password.');
        }
      } catch (error) {
        console.error('Login error:', error);
        alert('Terjadi kesalahan. Coba lagi nanti.');
      }
    });
  }
  
  document.addEventListener('DOMContentLoaded', () => {
    initLogin();
  });
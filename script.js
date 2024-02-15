document.getElementById('loginForm').addEventListener('submit', function(event) {
    var username = document.getElementById('username').value.trim();
    var password = document.getElementById('password').value.trim();
    
    if (!username || !password) {
      document.getElementById('error-msg').textContent = 'Please enter both username and password.';
      event.preventDefault();
    }
  });
  
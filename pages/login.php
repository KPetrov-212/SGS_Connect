<?php
// Start session
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$database = "sgs";

try {
  $connection = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
  $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
}

// Handle form submission
if (isset($_POST['submit'])) {
  $action = $_POST['action']; // Determine if it's login or register

  if ($action === 'login') {
    // Login logic
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Query the database for the user
    $stmt = $connection->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
      // Set user data in session
      $_SESSION['user'] = $user;

      // Redirect to index page
      header("location: index.php");
      exit;
    } else {
      $error_message = "Invalid username or password.";
    }
  } elseif ($action === 'register') {
    // Registration logic
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if ($password !== $confirm_password) {
      $error_message = "Passwords do not match.";
    } else {
      // Check if username or email already exists
      $stmt = $connection->prepare("SELECT * FROM users WHERE username = ? OR email = ?");
      $stmt->execute([$username, $email]);
      if ($stmt->fetch()) {
        $error_message = "Username or email already exists.";
      } else {
        // Hash the password and insert the user into the database
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $connection->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
        $stmt->execute([$username, $email, $hashed_password]);

        $success_message = "Registration successful. You can now log in.";
      }
    }
  }
}
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SGS Connect</title>
    <link rel="stylesheet" href="../css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">

    <!-- Inline script to set theme before page renders -->
    <script>
      (function() {
        const savedTheme = localStorage.getItem('theme');
        const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
        const theme = savedTheme || (prefersDark ? 'dark' : 'light');
        document.documentElement.setAttribute('data-bs-theme', theme);
      })();
    </script>
  </head>
  <body>
    <nav class="sticky-top fixed-top">
      <?php include '../components/navbar.php'; ?>
    </nav>
    <main>
      <div class="container d-flex justify-content-center align-items-center vh-100">
        <div class="row w-100">
          <div class="col-md-6 offset-md-3 col-lg-4 offset-lg-4">
            <div class="card shadow-lg">
              <div class="card-body">
                <h3 class="text-center mb-4">Sign In / Register</h3>
                <?php if (isset($error_message)): ?>
                  <div class="alert alert-danger text-center">
                    <?php echo $error_message; ?>
                  </div>
                <?php elseif (isset($success_message)): ?>
                  <div class="alert alert-success text-center">
                    <?php echo $success_message; ?>
                  </div>
                <?php endif; ?>
                <!-- Sign In Form -->
                <form method="POST" action="" id="signInForm" class="form-container active">
                  <input type="hidden" name="action" value="login">
                  <div class="form-group mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" id="username" name="username" placeholder="Enter your username" required>
                  </div>
                  <div class="form-group mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password" required>
                  </div>
                  <button type="submit" name="submit" class="btn btn-primary w-100">Sign In</button>
                  <div class="text-center mt-3">
                    <small class="text-muted">Don't have an account? 
                      <a href="#" class="text-decoration-none" onclick="toggleForms()">Register</a>
                    </small>
                  </div>
                </form>
                <!-- Sign Up Form -->
                <form method="POST" action="" id="signUpForm" class="form-container">
                  <input type="hidden" name="action" value="register">
                  <div class="form-group mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" id="username" name="username" placeholder="Enter your username" required>
                  </div>
                  <div class="form-group mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" required>
                  </div>
                  <div class="form-group mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password" required>
                  </div>
                  <div class="form-group mb-3">
                    <label for="confirm_password" class="form-label">Confirm Password</label>
                    <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Confirm your password" required>
                  </div>
                  <button type="submit" name="submit" class="btn btn-success w-100">Register</button>
                  <div class="text-center mt-3">
                    <small class="text-muted">Already have an account? 
                      <a href="#" class="text-decoration-none" onclick="toggleForms()">Sign In</a>
                    </small>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </main>
    <footer>
      <?php include '../components/footer.php'; ?>
    </footer>

    <script>
      function toggleForms() {
        const signInForm = document.getElementById('signInForm');
        const signUpForm = document.getElementById('signUpForm');
        signInForm.classList.toggle('active');
        signUpForm.classList.toggle('active');
      }
    </script>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>
  </body>
</html>
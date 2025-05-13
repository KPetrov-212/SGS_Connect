<div class="container d-flex justify-content-center align-items-center my-5">
  <div class="row w-100">
    <div class="col-lg-6 offset-lg-3">

      <!-- Sign In Form -->
      <div id="signInForm" class="form-container active">
        <h3 class="text-center mb-4">Sign In</h3>
        <form>
          <div class="form-group mb-3">
            <label for="emailSignIn" class="form-label">Email Address</label>
            <input type="email" class="form-control" id="emailSignIn" placeholder="Enter your email" required>
          </div>

          <div class="form-group mb-3">
            <label for="passwordSignIn" class="form-label">Password</label>
            <input type="password" class="form-control" id="passwordSignIn" placeholder="Enter your password" required>
          </div>

          <div class="form-check mb-3">
            <input type="checkbox" class="form-check-input" id="rememberSignIn">
            <label class="form-check-label" for="rememberSignIn">Remember Me</label>
          </div>

          <button type="submit" class="btn btn-primary w-100">Sign In</button>

          <div class="text-center mt-3">
            <small class="text-muted">Don't have an account? 
              <a href="#" class="text-decoration-none" onclick="toggleForms()">Register</a>
            </small>
          </div>
        </form>
      </div>

      <!-- Sign Up Form -->
      <div id="signUpForm" class="form-container">
        <h3 class="text-center mb-4">Sign Up</h3>
        <form>
          <div class="form-group mb-3">
            <label for="nameSignUp" class="form-label">Full Name</label>
            <input type="text" class="form-control" id="nameSignUp" placeholder="Enter your name" required>
          </div>

          <div class="form-group mb-3">
            <label for="emailSignUp" class="form-label">Email Address</label>
            <input type="email" class="form-control" id="emailSignUp" placeholder="Enter your email" required>
          </div>

          <div class="form-group mb-3">
            <label for="passwordSignUp" class="form-label">Password</label>
            <input type="password" class="form-control" id="passwordSignUp" placeholder="Create a password" required>
          </div>

          <div class="form-group mb-3">
            <label for="confirmPasswordSignUp" class="form-label">Confirm Password</label>
            <input type="password" class="form-control" id="confirmPasswordSignUp" placeholder="Confirm your password" required>
          </div>

          <button type="submit" class="btn btn-success w-100">Sign Up</button>

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

<script>
  function toggleForms() {
    const signInForm = document.getElementById('signInForm');
    const signUpForm = document.getElementById('signUpForm');
    signInForm.classList.toggle('active');
    signUpForm.classList.toggle('active');
  }
</script>
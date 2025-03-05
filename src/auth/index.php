<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Mellow</title>
  <link rel="shortcut icon" type="image/png" href="../assets/images/logos/mellow.png" />
  <link rel="stylesheet" href="../assets/css/styles.min.css" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">

  <!-- Firebase SDK -->
  <script src="https://www.gstatic.com/firebasejs/9.14.0/firebase-app.js"></script>
  <script src="https://www.gstatic.com/firebasejs/9.14.0/firebase-auth.js"></script>

  <script type="module">
  import { auth } from "../firebase/firebase-config.js";
  import { signInWithEmailAndPassword } from "https://www.gstatic.com/firebasejs/9.14.0/firebase-auth.js";

  // Listen for DOMContentLoaded once
  document.addEventListener("DOMContentLoaded", () => {
    const loginForm = document.getElementById("login-form");
    const errorMessage = document.getElementById("error-message");
    const emailInput = document.getElementById("email");
    const passwordInput = document.getElementById("password");
    const signInButton = document.querySelector("button[type='submit']");

    // Disable the sign-in button initially
    signInButton.disabled = true;

    // Enable the sign-in button only when both fields have values
    function toggleSignInButton() {
      signInButton.disabled = !(emailInput.value.trim() && passwordInput.value.trim());
    }

    emailInput.addEventListener("input", toggleSignInButton);
    passwordInput.addEventListener("input", toggleSignInButton);

    loginForm.addEventListener("submit", async function (e) {
      e.preventDefault();

      const email = emailInput.value.trim();
      const password = passwordInput.value.trim();

      // Clear previous errors
      errorMessage.style.display = "none";
      errorMessage.innerText = "";

      // Input validation
      if (!email || !password) {
        // If email or password is empty, display the appropriate error
        if (!email) {
          errorMessage.innerText = "Please enter your email.";
        } else if (!password) {
          errorMessage.innerText = "Please enter your password.";
        }
        errorMessage.style.display = "block";
        return;
      }

      try {
        // Proceed with Firebase Authentication
        const userCredential = await signInWithEmailAndPassword(auth, email, password);
        console.log("User signed in:", userCredential.user);
        window.location.href = "../pages/index.php"; // Redirect on success
      } catch (error) {
        console.error("Error signing in:", error.code);

        // Display appropriate error messages based on Firebase error codes
        switch (error.code) {
          case "auth/invalid-email":
            errorMessage.innerText = "Invalid email format.";
            break;
          case "auth/user-not-found":
            errorMessage.innerText = "No account found with this email.";
            break;
          case "auth/wrong-password":
            errorMessage.innerText = "Incorrect password. Try again.";
            break;
          case "auth/too-many-requests":
            errorMessage.innerText = "Too many failed attempts. Try again later.";
            break;
          default:
            errorMessage.innerText = "An error occurred. Please try again.";
        }
        
        // Make sure the error message is visible
        errorMessage.style.display = "block"; // Ensure error message is visible
        errorMessage.classList.add("alert", "alert-danger"); // Add Bootstrap alert classes
      }
    });
  });
  </script>
</head>

<body>
  <!-- Body Wrapper -->
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">
    <div class="position-relative overflow-hidden radial-gradient min-vh-100 d-flex align-items-center justify-content-center">
      <div class="d-flex align-items-center justify-content-center w-100">
        <div class="row justify-content-center w-100">
          <div class="col-md-8 col-lg-6 col-xxl-3">
            <div class="card mb-0">
              <div class="card-body">
                <a href="./index.php" class="d-flex align-items-center justify-content-center gap-3 py-3">
                  <img src="../assets/images/logos/mellow.png" width="50" alt="Mellow Logo">
                  <h1 class="fw-bold fs-10 text-dark mb-0">Mellow</h1>
                </a>

                <form id="login-form">
                  <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email">
                  </div>
                  <div class="mb-4">
                    <label for="password" class="form-label">Password</label>
                    <div class="position-relative">
                      <input type="password" class="form-control" id="password">
                      <i class="toggle-password bi bi-eye position-absolute end-0 top-50 translate-middle-y pe-3"
                        style="cursor: pointer;" onclick="togglePasswordVisibility()"></i>
                    </div>
                  </div>

                  <div class="d-flex align-items-center justify-content-between mb-4">
                    <a class="text-primary fw-bold" href="./index.html">Forgot Password?</a>
                  </div>
                  <button type="submit" class="btn btn-primary w-100 py-8 fs-4 mb-4 rounded-2">Sign In</button>

                  <!-- Error Message (Fixed, only one instance now) -->
                  <p id="error-message" class="alert alert-danger text-center" style="display: none;"></p>
                </form>

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="../assets/libs/jquery/dist/jquery.min.js"></script>
  <script src="../assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>

  <script>
    // Toggle password visibility
    function togglePasswordVisibility() {
      const passwordInput = document.getElementById('password');
      const passwordIcon = document.querySelector('.toggle-password');

      if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        passwordIcon.classList.remove('bi-eye');
        passwordIcon.classList.add('bi-eye-slash');
      } else {
        passwordInput.type = 'password';
        passwordIcon.classList.remove('bi-eye-slash');
        passwordIcon.classList.add('bi-eye');
      }
    }
  </script>

</body>

</html>
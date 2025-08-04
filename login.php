<!DOCTYPE html>
<html lang="en" class="dark">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Admin Login</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>

  <style>
    /* Animated gradient background */
    body::before {
      content: "";
      position: fixed;
      top: 0; left: 0;
      width: 100%;
      height: 100%;
      background: linear-gradient(270deg, #1f2937, #111827, #1f2937);
      background-size: 600% 600%;
      animation: gradientMove 20s ease infinite;
      z-index: -1;
    }

    @keyframes gradientMove {
      0% { background-position: 0% 50%; }
      50% { background-position: 100% 50%; }
      100% { background-position: 0% 50%; }
    }

    /* Page Loader Overlay */
    #page-loader {
      position: fixed;
      top: 0; left: 0;
      width: 100%;
      height: 100%;
      background: #111827;
      display: flex;
      align-items: center;
      justify-content: center;
      z-index: 9999;
      transition: opacity 0.5s ease;
    }

    #page-loader.hidden {
      opacity: 0;
      pointer-events: none;
    }

    .spinner {
      border: 4px solid rgba(255, 255, 255, 0.2);
      border-top: 4px solid #ffffff;
      border-radius: 50%;
      width: 40px;
      height: 40px;
      animation: spin 1s linear infinite;
    }

    @keyframes spin {
      to { transform: rotate(360deg); }
    }

    /* Form animations */
    .slide-in { animation: slide-in-bottom 0.8s ease-out; }

    @keyframes slide-in-bottom {
      from { opacity: 0; transform: translateY(40px); }
      to { opacity: 1; transform: translateY(0); }
    }

    .glass {
      backdrop-filter: blur(16px);
      background-color: rgba(31, 41, 55, 0.5);
      border: 1px solid rgba(255, 255, 255, 0.1);
    }

    svg.icon {
      width: 1.25rem;
      height: 1.25rem;
      stroke: #ccc;
    }

    @keyframes pulse-glow {
      0% { box-shadow: 0 0 0 0 rgba(59,130,246,0.7); }
      70% { box-shadow: 0 0 15px 10px rgba(59,130,246,0); }
      100% { box-shadow: 0 0 0 0 rgba(59,130,246,0); }
    }
  </style>
</head>

<body class="bg-gray-900 text-white min-h-screen flex items-center justify-center px-4">

  <!-- Page Loader -->
  <div id="page-loader">
    <div class="spinner"></div>
  </div>

  <!-- Main Container -->
  <div class="flex flex-col md:flex-row items-center justify-center w-full max-w-6xl gap-6 slide-in z-10">
    
    <!-- Left: Login Form -->
    <div class="glass rounded-xl p-8 w-full max-w-md shadow-2xl">
      <h2 class="text-3xl font-bold mb-6 text-center">Student Login</h2>

      <form id="loginForm" action="process_login.php" method="POST" class="space-y-5">
        <!-- Username -->
        <div>
          <label class="block text-sm mb-1">Username / Student-ID</label>
          <div class="relative">
            <span class="absolute inset-y-0 left-3 flex items-center">
              <svg class="icon" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                  d="M5.121 17.804A4 4 0 0112 15a4 4 0 016.879 2.804M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
              </svg>
            </span>
            <input type="text" name="username" required
              class="w-full pl-10 pr-4 py-2 rounded-full border border-gray-600 bg-gray-700 text-white focus:outline-none focus:ring-2 focus:ring-blue-500 transition" />
          </div>
        </div>

        <!-- Password -->
        <div>
          <label class="block text-sm mb-1">Password</label>
          <div class="relative">
            <span class="absolute inset-y-0 left-3 flex items-center">
              <svg class="icon" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                  d="M12 11c0-1.657-1.343-3-3-3s-3 1.343-3 3m6 0v4m-6 0h6m0 0a2 2 0 004 0v-4a2 2 0 00-4 0z" />
              </svg>
            </span>
            <input type="password" name="password" required
              class="w-full pl-10 pr-4 py-2 rounded-full border border-gray-600 bg-gray-700 text-white focus:outline-none focus:ring-2 focus:ring-blue-500 transition" />
          </div>
        </div>

        <!-- Login Button -->
        <div class="flex justify-center">
          <button id="loginBtn" type="submit"
            class="px-10 py-2 bg-blue-500 text-white rounded-full animate-[pulse-glow_2s_infinite] transition hover:scale-105 focus:outline-none flex items-center justify-center gap-2">
            <span class="button-text">Login</span>
            <div id="loader" class="spinner hidden"></div>
          </button>
        </div>
        
        <!-- Admin Login Link -->
        <div class="text-center mt-1">
          <a href="admin_login.php" class="text-sm text-blue-400 hover:underline">Admin?</a>
        </div>
      </form>

      <div id="toast" class="hidden mt-4 p-3 rounded bg-red-500 text-white text-sm text-center shadow-lg"></div>
    </div>

    <!-- Right: Lottie Animation -->
    <div class="w-full max-w-md hidden md:block">
      <lottie-player
        src="https://lottie.host/3bcbc45d-fd29-4eea-8e73-94ce44ac7b89/hUFXlHKy0b.json"
        background="transparent"
        speed="1"
        loop
        autoplay
        class="w-full h-auto max-w-sm">
      </lottie-player>
    </div>

  </div>

  <!-- Scripts -->
  <script>
    // Hide page loader
    window.addEventListener('load', () => {
      document.getElementById('page-loader').classList.add('hidden');
    });

    // Toast & Login animation
    const toast = document.getElementById("toast");
    const urlParams = new URLSearchParams(window.location.search);

    if (urlParams.get("error")) {
      toast.textContent = decodeURIComponent(urlParams.get("error"));
      toast.classList.remove("hidden");
    }

    const loginForm = document.getElementById("loginForm");
    const loginBtn = document.getElementById("loginBtn");
    const loader = document.getElementById("loader");
    const buttonText = document.querySelector(".button-text");

    loginForm.addEventListener("submit", () => {
      loginBtn.disabled = true;
      loader.classList.remove("hidden");
      buttonText.textContent = "Logging in";
    });

    if (urlParams.get("success") === "1") {
      document.body.innerHTML += `
        <div class="fixed inset-0 flex items-center justify-center bg-gray-900 text-white z-50">
          <div class="spinner mr-3"></div>
          <span class="text-lg">Redirecting to Home Page...</span>
        </div>
      `;
      setTimeout(() => {
        window.location.href = "index.html";
      }, 2000);
    }
  </script>
</body>
</html>

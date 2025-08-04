<!DOCTYPE html>
<html lang="en" class="dark">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Admin Login</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>

  <style>
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

    .spinner {
      border: 4px solid rgba(255, 255, 255, 0.2);
      border-top: 4px solid #ffffff;
      border-radius: 50%;
      width: 24px;
      height: 24px;
      animation: spin 1s linear infinite;
    }

    @keyframes spin {
      to { transform: rotate(360deg); }
    }

    .slide-in {
      animation: slide-in-bottom 0.8s ease-out;
    }

    @keyframes slide-in-bottom {
      from { opacity: 0; transform: translateY(40px); }
      to { opacity: 1; transform: translateY(0); }
    }
  </style>
</head>

<body class="bg-gray-900 text-white min-h-screen flex items-center justify-center px-4">

  <div class="flex flex-col md:flex-row items-center justify-center w-full max-w-6xl gap-8">

    <!-- Left Side: Lottie Animation -->
    <div class="w-full md:w-1/2 flex items-center justify-center">
      <lottie-player
         src="https://assets6.lottiefiles.com/packages/lf20_qp1q7mct.json"
         background="transparent"
         speed="1"
         style="width: 100%; max-width: 400px; height: 320px"
         loop
         autoplay>
      </lottie-player>
    </div>

    <!-- Right Side: Admin Login Container -->
    <div class="glass rounded-xl p-8 w-full max-w-md shadow-2xl slide-in z-10">
      <h2 class="text-3xl font-bold mb-6 text-center">Welcome</h2>

      <form id="adminLoginForm" action="process_admin_login.php" method="POST" class="space-y-5">
        <!-- Username -->
        <div>
          <label class="block text-sm mb-1">Admin User</label>
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
          <button id="adminLoginBtn" type="submit"
            class="px-10 py-2 bg-blue-500 text-white rounded-full animate-[pulse-glow_2s_infinite] transition hover:scale-105 focus:outline-none flex items-center justify-center gap-2">
            <span class="button-text">Login</span>
            <div id="loader" class="spinner hidden"></div>
          </button>
        </div>
      </form>

      <div id="toast" class="hidden mt-4 p-3 rounded bg-red-500 text-white text-sm text-center shadow-lg"></div>
    </div>

  </div>

  <!-- JS -->
  <script>
    const loginForm = document.getElementById("adminLoginForm");
    const loginBtn = document.getElementById("adminLoginBtn");
    const loader = document.getElementById("loader");
    const buttonText = document.querySelector(".button-text");
    const toast = document.getElementById("toast");
    const urlParams = new URLSearchParams(window.location.search);

    loginForm.addEventListener("submit", () => {
      loginBtn.disabled = true;
      loader.classList.remove("hidden");
      buttonText.textContent = "Logging in...";
    });

    if (urlParams.get("error")) {
      toast.textContent = decodeURIComponent(urlParams.get("error"));
      toast.classList.remove("hidden");
    }
  </script>
</body>
</html>

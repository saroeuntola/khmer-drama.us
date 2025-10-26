<?php
include('./admin/lib/auth.php');
$auth = new Auth();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $remember = isset($_POST['remember']);
    if ($auth->login($username, $password, $remember)) {
        $result = dbSelect('users', 'role_id', "username=" . $auth->db->quote($username));
        if ($result && count($result) > 0) {
            $user = $result[0];
            if ($user['role_id'] == 1) {
                header('Location: ./admin');
                exit();
            } elseif ($user['role_id'] == 2) {
                header('Location: ./');
                exit();
            } elseif ($user['role_id'] == 3) {
                header('Location: ./');
                exit();
            }
        }
    } else {
        echo "<div class='error-message'><p>Invalid username or password!</p></div>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../src/output.css">
</head>

<body class="gradient-bg relative overflow-hidden">
    <!-- Floating shapes -->
    <!-- <div class="floating-shapes absolute inset-0 -z-10">
        <div class="shape bg-purple-500 opacity-20 rounded-full w-40 h-40 top-10 left-10 animate-pulse"></div>
        <div class="shape bg-pink-400 opacity-20 rounded-full w-60 h-60 bottom-20 right-20 animate-pulse"></div>
        <div class="shape bg-blue-400 opacity-20 rounded-full w-32 h-32 top-1/2 left-1/2 animate-pulse"></div>
    </div> -->

    <!-- Centered login card -->
    <div class="flex items-center justify-center min-h-screen px-4 bg-gray-900">
        <div class="w-full max-w-md">
            <div class="glass-card p-10 rounded-3xl shadow-xl backdrop-blur-lg bg-white/10 border border-white/30">
                <!-- Header -->
                <div class="text-center mb-8">
                    <h1 class="text-3xl font-bold text-white mb-2">Welcome Back</h1>
                    <p class="text-white/90 text-sm">Sign in to your account</p>
                </div>

                <!-- Login Form -->
                <form action="login" method="POST" class="space-y-6">
                    <!-- Username -->
                    <div>
                        <label for="username" class="block text-white/80 text-sm mb-1">Username</label>
                        <input type="text" id="username" name="username" required
                            class="w-full px-4 py-3 rounded-xl bg-white/20 text-white placeholder-white/70 border border-white/30 focus:outline-none focus:ring-2 focus:ring-purple-400 focus:border-transparent transition">
                    </div>

                    <!-- Password -->
                    <div>
                        <label for="password" class="block text-white/80 text-sm mb-1">Password</label>
                        <input type="password" id="password" name="password" required
                            class="w-full px-4 py-3 rounded-xl bg-white/20 text-white placeholder-white/70 border border-white/30 focus:outline-none focus:ring-2 focus:ring-purple-400 focus:border-transparent transition">
                    </div>

                    <!-- Remember Me -->
                    <div class="flex items-center justify-between">
                        <label class="flex items-center text-white/80 text-sm">
                            <input type="checkbox" id="remember" name="remember" class="checkbox-custom mr-2">
                            Remember me
                        </label>

                    </div>

                    <!-- Submit Button -->
                    <button type="submit"
                        class="w-full py-3 rounded-xl bg-purple-500 hover:bg-purple-600 text-white font-semibold transition-all shadow-md hover:shadow-lg">
                        Sign In
                    </button>



                    <!-- Error Message -->
                    <?php if (isset($error_message)): ?>
                        <div class="bg-red-500/80 text-white text-center py-2 rounded-lg mt-3">
                            <p><?= htmlspecialchars($error_message) ?></p>
                        </div>
                    <?php endif; ?>
                </form>
            </div>
        </div>
    </div>
</body>


</html>
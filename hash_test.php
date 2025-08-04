<?php
$password = 'admin123';
$hash = '$2y$10$K9fJqXWvGvmK0kZ49H4e6e2bCqK59OxYVFYt6kh56s9HQV2fpk1ai';

if (password_verify($password, $hash)) {
    echo "✅ Password matches!";
} else {
    echo "❌ Password does not match!";
}
?>

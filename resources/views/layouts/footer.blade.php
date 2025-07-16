<?php
// File: navbar.php
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Navbar</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #FFD700; /* Background kuning */
        }

        .navbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            background-color: #FFF5CC; /* Background krem */
            padding: 10px 20px;
            border-radius: 30px;
            margin: 10px auto;
            width: 90%;
            max-width: 1200px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .navbar .logo {
            display: flex;
            align-items: center;
        }

        .navbar .logo img {
            height: 40px;
            border-radius: 50%;
        }

        .navbar .search {
            display: flex;
            align-items: center;
            background-color: #E0E0E0; /* Warna abu-abu untuk kotak pencarian */
            padding: 5px 10px;
            border-radius: 20px;
            gap: 5px;
        }

        .navbar .search input {
            border: none;
            background: none;
            outline: none;
            font-size: 14px;
            color: #000;
        }

        .navbar .search button {
            background: none;
            border: none;
            cursor: pointer;
            font-size: 16px;
        }

        .navbar .menu {
            display: flex;
            gap: 20px;
            align-items: center;
        }

        .navbar .menu a {
            text-decoration: none;
            color: #000;
            font-size: 16px;
        }

        .navbar .menu a:hover {
            text-decoration: underline;
        }

        .navbar .profile {
            display: flex;
            align-items: center;
        }

        .navbar .profile img {
            height: 30px;
            border-radius: 50%;
        }
    </style>
</head>
<body>

<div class="navbar">
    <div class="logo">
        <img src="logo.png" alt="Logo"> <!-- Ganti dengan URL atau path logo -->
    </div>

    <div class="search">
        <input type="text" placeholder="Search">
        <button>🔍</button> <!-- Ikon pencarian -->
    </div>

    <div class="menu">
        <a href="#">Relawan</a>
        <a href="#">Donasi</a>
        <a href="#">Organisasi</a>
    </div>

    <div class="profile">
        <img src="profile.png" alt="Profile"> <!-- Ganti dengan URL atau path gambar profil -->
    </div>
</div>

</body>
</html>

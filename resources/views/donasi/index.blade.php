<html lang="en">
 <head>
  <meta charset="utf-8"/>
  <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
  <meta content="ie=edge" http-equiv="X-UA-Compatible"/>
  <title>
   Donasi
  </title>
  <link href="{{ asset('image/logo-satria.png') }}" rel="shortcut icon"/>
  <link href="https://fonts.googleapis.com" rel="preconnect"/>
  <link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect"/>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&amp;display=swap" rel="stylesheet"/>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
  <script src="https://cdn.tailwindcss.com">
  </script>
  <style>
   body {
            margin: 0;
            font-family: 'Montserrat', sans-serif;
            background-color: #f9f9f9;
            color: #333;
        }

        header {
            position: fixed;
            top: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 100%;
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 15px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            z-index: 1000;
        }

        .logo img {
            height: 40px;
        }

        .menu a {
            margin: 0 15px;
            text-decoration: none;
            color: #333;
            font-weight: 600;
            transition: color 0.3s ease;
        }

        .menu a:hover {
            color: #ff6f61;
        }

        .profile img {
            height: 40px;
            width: 40px;
            border-radius: 50%;
            object-fit: cover;
        }

        .top-header {
            background-color: #FFCD00;
            width: 100%;
            height: 20rem;
            display: flex;
            justify-content: center;
            align-items: center;
            color: white;
            text-align: center;
            margin-top: 0;
        }

        .top-header h1 {
            font-size: 2.5rem;
            color: #ffffff;
            margin-top: 5rem;
        }

        .searchbox {
            text-align: center;
            padding: 40px 20px;
        }

        .searchbox-top-text p {
            font-size: 1rem;
            margin-bottom: 20px;
        }

        .drop-down-box {
            display: flex;
            justify-content: center;
            gap: 10px;
            flex-wrap: wrap;
        }

        .drop-down-box input,
        .drop-down-box select {
            padding: 10px;
            font-size: 1rem;
            border: 1px solid #ddd;
            border-radius: 5px;
            width: 200px;
        }

        .searchbox-bottom-text h6 {
            margin-top: 20px;
            font-size: 1rem;
            color: #ff6f61;
        }

        .content {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 30px;
            padding: 50px 20px;
        }

        .card-container {
            background-color: #fff;
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            width: 280px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .card-container:hover {
            transform: translateY(-10px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
        }

        .card img {
            width: 100%;
            height: 180px;
            object-fit: cover;
        }

        .card-body {
            padding: 15px;
            text-align: center;
        }

        .card-body h2 {
            font-size: 1.2rem;
            margin: 10px 0;
            color: #555;
        }

        .card-body h5 {
            font-size: 1rem;
            color: #777;
        }

        .subscription-section {
            background-color: #ffeb3b;
            color: white;
            text-align: center;
            padding: 40px 20px;
            border-radius: 20px;
            margin: 50px auto;
            width: 80%;
        }

        .subscription-form input,
        .subscription-form select,
        .subscription-form button {
            padding: 10px;
            margin: 10px;
            border: none;
            border-radius: 5px;
            font-size: 1rem;
        }

        .subscription-form button {
            background-color: #333;
            color: white;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .subscription-form button:hover {
            background-color: #222;
        }

        .footer {
            text-align: center;
            padding: 20px;
            background-color: #333;
            color: white;
        }

        .footer a {
            color: white;
            text-decoration: none;
            margin: 0 10px;
        }

        .footer a:hover {
            text-decoration: underline;
        }
  </style>
 </head>
 <body>
    <header class="fixed top-5 left-1/2 transform -translate-x-1/2 w-11/12 bg-white bg-opacity-80 backdrop-blur-md shadow-lg rounded-3xl p-4 flex justify-between items-center z-50">
        <div class="logo">
            <img src="{{ asset('image/logo-satria.png') }}" alt="Logo" class="h-10">
        </div>
    
        <div class="menu">
            <a href="{{ route('kegiatan.index') }}" class="mx-4 text-lg font-semibold text-gray-700 hover:text-orange-600">Relawan</a>
            <a href="{{ route('donasi.index') }}" class="mx-4 text-lg font-semibold text-gray-700 hover:text-orange-600">Donasi</a>
            <a href="{{ route('organisasi.index') }}" class="mx-4 text-lg font-semibold text-gray-700 hover:text-orange-600">Organisasi</a>
        </div>
    
        <div class="profile">
            <img src="{{ asset('storage/'. $profil->foto) }}" alt="Profile" class="h-10 w-10 rounded-full object-cover">
        </div>
    </header>
  <div class="top-header">
   <h1 class="mt-10">
    Donasi
   </h1>
  </div>
  
  <div class="content">
   @foreach ($donasi as $d)
   <div class="card-container">
    <a href="{{ route('donasi.show', $d->id) }}">
     <div class="card">
      <img alt="Image of {{ $d->nama }}" src="{{ 'storage/'.$d->foto }}"/>
      <div class="card-body">
       <h2>
        {{ $d->nama }}
       </h2>
       <h5>
        {{ $d->deskripsi }}
       </h5>
      </div>
     </div>
    </a>
   </div>
   @endforeach
  </div>
  <div class="subscription-section">
    <h1>Jadilah Inspirasi!</h1>
    <p>Kami akan mengirimkan Anda berita, kampanye nasional dan internasional, serta cara-cara menarik untuk berkontribusi.</p>
    <form class="subscription-form" action="subscribe.php" method="POST">
        <input type="text" name="first_name" placeholder="Nama" required>
        <input type="text" name="last_name" placeholder="Nama belakang" required>
        <input type="email" name="email" placeholder="Email" required>
        <select name="subscription_type" required>
            <option value="">Langganan</option>
            <option value="daily">Harian</option>
            <option value="weekly">Mingguan</option>
            <option value="monthly">Bulanan</option>
        </select>
        <button type="submit">Langganan</button>
    </form>
</div>

<div class="footer">
    <div class="social-icons">
        <a href="#">&#x1F426; Twitter</a>
        <a href="#">&#x1F4F1; Instagram</a>
        <a href="#">&#x1F4E7; Email</a>
    </div>
    <p>Volunteer | Donate | Find Causes</p>
    <p>Campaigns | Offers | Create an Offer</p>
    <p>For Business | Resources | Contact Us</p>
</div>
 </body>
</html>

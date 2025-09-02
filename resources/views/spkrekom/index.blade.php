<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Film Recommendation</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
</head>

<style>
  @import url('https://fonts.googleapis.com/css2?family=Baloo+2:wght@400..800&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');

  * {
    font-family: poppins, sans-serif;
  }

  html {
    scroll-behavior: smooth;
  }
  
  .navbar-brand, .navbar-brand:hover,
  .navbar-brand:visited, .navbar-brand:active, .navbar-brand:focus {
    color: red !important;
    font-weight: 600;
    text-decoration: none;
  }

  .navbar-nav .nav-link:focus,
  .navbar-nav .nav-link:active {
    color: white ;
    background: transparent !important;
  }

  .navbar-nav li a {
    color: white;
    font-weight: 400;
  }

  .navbar-nav li a:hover {
  color: red !important;
  transition: all 0.3s ease-in-out;
  }

  .bg-color {
    background-color: rgba(0, 0, 0, 0.7);
    backdrop-filter: blur(5px);
  }

  form .form-control {
  background: #222;
  color: white;
  border: 1px solid #444;
  }

  form .form-control:focus {
    background: #333;
    border-color: red;
    box-shadow: none;
    color: white;
  }

  form .btn-danger {
    background: red;
    border: none;
  }

  form .btn-danger:hover {
    background: darkred;
    transition: all 0.1s ease-in-out;
  }

  .hero {
    height: 90vh;
    background: url('{{ asset('img/background.jpg') }}') no-repeat center center/cover;
    position: relative;
    display: flex;
  }

  .hero::before {
      content: "";
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: linear-gradient(to right, rgba(0,0,0,0.9) 30%, rgba(0,0,0,0) 70%);
  }

  .hero .container {
    position: relative;
    z-index: 2;
  }

  span.text-danger {
    color: red !important;
  }

  .hero h1 {
    font-size: 3rem;
    font-weight: 600;
  }

  .hero .btn-danger {
    background-color: red !important;
    border: none !important;
    font-weight: 500;
  }

  .hero .btn-danger:hover {
    background-color: darkred !important;
  }

  .custom-card {
    color: white;
    background: #1e1e1e;
    border: none;
    border-radius: 12px;
    box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
  }

  .custom-select {
    background: #111;
    color: white;
    border: 1px solid #333;
    border-radius: 8px;
    padding: 8px;
  }

  .custom-select:focus {
    border-color: red;
    box-shadow: none;
  }

  .custom-range::-webkit-slider-thumb {
    background: red;
  }
  .custom-range::-webkit-slider-runnable-track {
    background: #444;
  }

  #recommendation {
    min-height: 100vh;
    display: flex;
    flex-direction: column;
    justify-content: center;
  }

  #recommendation .card h5 i {
      color: #ff3b3b !important; 
  }

  #recommendation .btn-danger {
      background-color: red !important;
      border: none !important;
      color: white !important;
      font-weight: 600;
      transition: background 0.3s ease;
  }

  #recommendation .btn-danger:hover {
      background-color: #cc0000 !important;
  }

  #film {
    min-height: 100vh;
    display: flex;
    flex-direction: column;
    justify-content: center;
  }

  #film .card {
    background: #1e1e1e;
    border: none;
    border-radius: 12px;
    color: white;
    box-shadow: 0 2px 8px rgba(0,0,0,0.3);
    overflow: hidden;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
  }

  #film .card:hover {
    transform: translateY(-5px);
    box-shadow: 0 4px 15px rgba(0,0,0,0.5);
  }

  #film .card img {
    width: 100%;
    height: 250px; 
    object-fit: cover;
    border-bottom: 2px solid #333;
  }

  #film .card-body {
    background: #1e1e1e;
    padding: 15px;
  }

  #film .card-title {
    font-weight: 600;
    margin-bottom: 8px;
  }

  #film .card-text {
    color: #ccc;
    font-size: 0.9rem;
  }

  #film .card-body .rating {
  display: flex;
  align-items: center;
  gap: 5px;
  margin-bottom: 8px;
  }

  #film .card-body .rating i {
    color: #ffc107;
  }
  #film .card-body .rating span {
    font-weight: bold;
  }

  #about {
    background: rgb(24, 23, 23);
  }

  #about p.text-secondary {
    max-width: 700px;
    margin: 0 auto;
  }

  #about i.text-danger {
    color: red !important;
  }

  #about p.desc {
    max-width: 700px;
    margin: 0 auto;
  }

  #footer a:hover {
    color: red;
    transition: color 0.3s ease;
  }

  #footer hr {
    opacity: 0.2;
  }

  #footer h2 {
    color: red !important;
  }

  .slider-container input[type="range"] {
    appearance: none;
    width: 100%;
    height: 6px;
    background: #444;
    border-radius: 5px;
    outline: none;
  }

  .slider-container input[type="range"]::-webkit-slider-thumb {
    appearance: none;
    width: 16px;
    height: 16px;
    background: red;
    border-radius: 50%;
    cursor: pointer;
    position: relative;
    z-index: 2;
  }

  .value-bubble {
    position: absolute;
    top: -35px;
    background: red;
    color: white;
    font-size: 12px;
    font-weight: bold;
    padding: 4px 8px;
    border-radius: 50%;
    transform: translateX(-50%) scale(0.8);
    opacity: 0;
    pointer-events: none;
    transition: opacity 0.2s ease, transform 0.2s ease;
  }

  .value-bubble.show {
    opacity: 1;
    transform: translateX(-50%) scale(1);
  }

</style>

<body>
    <nav class="navbar navbar-expand-lg bg-color fixed-top">
        <div class="container">
          <a class="navbar-brand fs-4 glow-text" href="#">MHSmovie.</a>
          <button class="navbar-toggler shadow-none border-0" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="sidebar offcanvas offcanvas-start bg-dark" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
            <div class="offcanvas-header text-white border-bottom">
              <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Menu</h5>
              <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body d-flex justify-content-betweeb align-items-center">
              <ul class="navbar-nav justify-content-between">
                <li class="nav-item mx-2">
                  <a class="nav-link" href="#home"> Home</a>
                </li>
                <li class="nav-item mx-2">
                  <a class="nav-link" href="#recommendation"> Recommendations</a>
                </li>
                <li class="nav-item mx-2">
                  <a class="nav-link" href="#about"> About</a>
                </li>
              </ul>
            </div>
          </div>
        </div>
    </nav>
    
    <section id="home" class="hero d-flex align-items-center">
      <div class="container text-white">
        <h1>Temukan <span class="text-danger">Film</span> Sempurna </h1>
          <p class="lead">Temukan film-film menakjubkan yang disesuaikan dengan <br> 
            preferensi Anda dengan sistem rekomendasi cerdas kami</p>
        <a href="#recommendation" class="btn btn-danger btn-lg mt-3">Mulai pilih</a>
      </div>
    </section>

    <section id="recommendation" class="bg-dark text-white py-5">
      <div class="container">
        <h2 class="text-center mb-2">Pilih referensi film kamu</h2>
        <p class="text-center text-secondary mb-5">Beritahu kami apa yang kamu inginkan</p>
        <form action="{{ route('recommend') }}#film" method="GET">
          <div class="row g-4 align-items-stretch justify-content-center">
            <div class="col-md-6 col-lg-5">
              <div class="card custom-card h-100">
                <div class="card-body d-flex flex-column">
                  <h5 class="mb-3"><i class="bi bi-search-heart text-danger"></i> Genre</h5>
                  <select name="genre" class="form-select custom-select mt-auto">
                    <option value="">Select Genre</option>
                    <option value="28">Action</option>
                    <option value="35">Comedy</option>
                    <option value="18">Drama</option>
                    <option value="12">Adventure</option>
                    <option value="80">Crime</option>
                    <option value="99">Documentary</option>
                    <option value="27">Horror</option>
                    <option value="53">Thriller</option>
                    <option value="10751">Family</option>
                    <option value="10752">War</option>
                    <option value="9648">Mystery</option>
                    <option value="878">Science Fiction</option>
                    <option value="10749">Romance</option>
                    <option value="14">Fantasy</option>
                    <option value="36">History</option>
                  </select>
                </div>
              </div>
            </div>
            <div class="col-md-6 col-lg-5">
              <div class="card custom-card h-100">
                <div class="card-body d-flex flex-column">
                  <h5 class="mb-3"><i class="bi bi-star-fill text-danger"></i> Minimum Rating</h5>
                  <div class="slider-container" style="position: relative; width: 100%;">
                    <div class="value-bubble" id="ratingBubble">5</div>
                    <input type="range" name="rating" class="form-range custom-range" min="1" max="10" value="5" step="1" id="ratingSlider">
                  </div>
                  <div class="d-flex justify-content-between"><span>1</span><span>10</span></div>
                </div>
              </div>
            </div>
            <div class="col-md-6 col-lg-5">
              <div class="card custom-card h-100">
                <div class="card-body d-flex flex-column">
                  <h5 class="mb-3"><i class="bi bi-calendar-event text-danger"></i> Release Year</h5>
                  <select name="year" class="form-select custom-select">
                    <option value="">Select Year</option>
                    <option value="2020-2025">2020 - 2025</option>
                    <option value="2015-2019">2015 - 2019</option>
                    <option value="2010-2014">2010 - 2014</option>
                    <option value="2000-2009">2000 - 2009</option>
                  </select>
                </div>
              </div>
            </div>
            <div class="col-md-6 col-lg-5">
              <div class="card custom-card h-100">
                <div class="card-body d-flex flex-column">
                  <h5 class="mb-3"><i class="bi bi-clock-history text-danger"></i> Duration</h5>
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="duration" value="short" id="short">
                    <label class="form-check-label" for="short">Short (&lt; 90 min)</label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="duration" value="medium" id="medium">
                    <label class="form-check-label" for="medium">Medium (90-120 min)</label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="duration" value="long" id="long">
                    <label class="form-check-label" for="long">Long (&gt; 120 min)</label>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="text-center mt-4">
            <button type="submit" class="btn btn-danger px-5 py-2">Find Recommendations</button>
          </div>
        </form>
      </div>
    </section>

    <section id="film" class="bg-black text-white py-5">
      <div class="container">
        <h1 class="mb-5">Film Terbaik!</h1>
        <div class="row row-cols-1 row-cols-md-4 g-4">
          @foreach ($movies as $movie)
          <div class="col">
            <div class="card h-100">
             <img src="{{ $imageBaseUrl }}/w300{{ $movie['poster_path'] }}">
              <div class="card-body">
                <h5 class="card-title">{{ $movie['title'] }}</h5>
                  <div class="rating">
                    <i class="bi bi-star-fill"></i>
                    <span>{{ number_format($movie['vote_average']) }}</span>
                    <small class="text-secondary">{{ date('Y', strtotime($movie['release_date'])) }}</small>
                  </div>
                <p class="card-text">{{ \Illuminate\Support\Str::limit($movie['overview'], 100) }}</p>
              </div>
            </div>
          </div>
          @endforeach
        </div>
      </div>
    </section>

    <section id="about" class="text-white py-5">
      <div class="container text-center">
        <h2 class="mb-3">About MHSmovie</h2>
        <p class="desc text-white mb-5">Kami menggunakan algoritma canggih untuk menganalisis preferensi Anda dan merekomendasikan film yang sesuai dengan selera Anda. Sistem cerdas kami mempertimbangkan berbagai faktor untuk memastikan Anda menemukan film favorit berikutnya.</p>
        <div class="row g-4">
          <div class="col-md-4">
            <div class="p-3">
              <i class="bi bi-file-person fs-1 mb-3 text-danger"></i>
              <h3 class="mb-2">Smart Algorithm</h3>
              <p class="text-secondary">Advanced AI-powered recommendations</p>
            </div>
          </div>
          <div class="col-md-4">
            <div class="p-3">
              <i class="bi bi-database fs-1 mb-3 text-danger"></i>
              <h3 class="mb-2">Vast Database</h3>
              <p class="text-secondary">Thousands of movies across all genres</p>
            </div>
          </div>
          <div class="col-md-4">
            <div class="p-3">
              <i class="bi bi-heart-fill fs-1 mb-3 text-danger"></i>
              <h3 class="mb-2">Personalized</h3>
              <p class="text-secondary">Tailored to your unique preferences</p>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section id="footer" class="bg-dark text-white pt-5 pb-3">
      <div class="container">
        <div class="row">
          <div class="col-md-3 mb-4">
            <h2 class="text-danger">MHSmovie.</h2>
            <p class="text-secondary">Your intelligent movie recommendation system</p>
          </div>
          <div class="col-md-3 mb-2">
            <h5 class="mb-2">Quick Links</h5>
            <ul class="list-unstyled">
              <li><a href="#" class="text-secondary text-decoration-none">Home</a></li>
              <li><a href="#recommendation" class="text-secondary text-decoration-none">Recommendations</a></li>
              <li><a href="#about" class="text-secondary text-decoration-none">About</a></li>
              <li><a href="#" class="text-secondary text-decoration-none">Contact</a></li>
            </ul>
          </div>
          <div class="col-md-3 mb-4">
            <h5 class="mb-2">Support</h5>
            <ul class="list-unstyled">
              <li><a href="#" class="text-secondary text-decoration-none">Help Center</a></li>
              <li><a href="#" class="text-secondary text-decoration-none">Privacy Policy</a></li>
              <li><a href="#" class="text-secondary text-decoration-none">Terms of Service</a></li>
            </ul>
          </div>
          <div class="col-md-3 mb-4">
            <h5 class="mb-2">Follow Us</h5>
            <div class="d-flex gap-3 mt-2">
              <a href="#" class="text-secondary fs-4"><i class="bi bi-facebook"></i></a>
              <a href="#" class="text-secondary fs-4"><i class="bi bi-twitter"></i></a>
              <a href="#" class="text-secondary fs-4"><i class="bi bi-instagram"></i></a>
            </div>
          </div>
        </div>
        <hr class="border-secondary">
        <p class="text-center text-secondary mt-3 mb-0">© 2025 MHSmovie. All rights reserved.</p>
      </div>
    </section>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>

<script>
  const ratingSlider = document.getElementById('ratingSlider');
  const ratingBubble = document.getElementById('ratingBubble');

  function setRatingBubble() {
    const val = parseInt(ratingSlider.value);
    const min = parseInt(ratingSlider.min);
    const max = parseInt(ratingSlider.max);
    const percent = ((val - min) * 100) / (max - min);

    ratingBubble.textContent = val;
    ratingBubble.style.left = `calc(${percent}% + (${8 - percent * 0.15}px))`;
  }

  ratingSlider.addEventListener('input', () => {
    setRatingBubble();
    ratingBubble.classList.add('show');
  });

  ratingSlider.addEventListener('change', () => {
    ratingBubble.classList.remove('show');
  });

  setRatingBubble();
</script>
  
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
  const form = document.querySelector('form');

  form.addEventListener('submit', function (e) {
    const genre = form.querySelector('select[name="genre"]').value;
    const rating = form.querySelector('input[name="rating"]').value;
    const year = form.querySelector('select[name="year"]').value;
    const duration = form.querySelector('input[name="duration"]:checked');

    if (!genre || !rating || !year || !duration) {
      e.preventDefault();
      Swal.fire({
        icon: 'warning',
        title: 'Form belum lengkap!',
        text: 'Silakan isi semua pilihan sebelum melanjutkan.',
        theme: 'dark',
        confirmButtonColor: '#d33',
        confirmButtonText: 'OK'
      }).then(() => {
        window.location.hash = "#recommendation";
      });
    }
  });
</script>

</body>
</html> 
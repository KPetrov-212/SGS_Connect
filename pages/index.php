<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SGS Connect</title>
    <link rel="stylesheet" href="../css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">

    <!-- Inline script to set theme and icons before page renders -->
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
    <?php include '../components/carousel.php'; ?>
    <main>
      <div class="d-flex justify-content-center mt-5 pt-5" id="firstgroup">
        <h1 class="">Електризирайте дома си с <h1 class="text-warning">&nbsp;SGS<h1></h1>
      </div>
      <div class="container py-5" id="firstgroup">
        <div class="row align-items-center gy-5">
          <!-- Video Section -->
          <div class="col-lg-6 col-12 order-lg-2 d-flex justify-content-center align-items-center">
            <div class="ratio ratio-16x9 shadow-lg rounded">
              <iframe src="https://www.youtube.com/embed/j_kYPSVMtqU" title="YouTube video" allowfullscreen></iframe>
            </div>
          </div>
          <!-- Information Section -->
          <div class="col-lg-6 col-12 order-lg-1">
            <div class="row mb-4 align-items-center">
              <div class="col-2 d-flex justify-content-center align-items-center">
                <img src="../assets/marketplace-icon.svg" alt="Marketplace Icon" class="img-fluid">
              </div>
              <div class="col-10">
                <h4 class="fw-bold">Една спирка за всички енергийни нужди на вашия дом</h4>
                <p class="text-muted">Пазарувайте с увереност слънчева енергия, зарядни устройства за EV, отопление/климатик и др. Вашият енергиен съветник може да ви помогне да планирате и персонализирате.</p>
              </div>
            </div>
            <div class="row align-items-center">
              <div class="col-2 d-flex justify-content-center align-items-center">
                <img src="../assets/no-hassle-icon.svg" alt="No Hassle Icon" class="img-fluid">
              </div>
              <div class="col-10">
                <h4 class="fw-bold">Лесни, безпроблемни спестявания</h4>
                <p class="text-muted">Сравнете и пазарувайте решения за чиста енергия според собствените си условия. Без продажби, само поддръжка.</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </main>
    <footer>
      <?php include '../components/footer.php'; ?>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>
  </body>
</html>
<?php
session_start();
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Защо слънчева енергия? - SGS Connect</title>
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
    <main>
      
    

        <div class="container py-5">
            <h1 class="text-center mb-4"><i class="bi bi-sun-fill text-warning"><br></i>Защо слънчева енергия?</h1>
            <p class="text-muted text-center mb-5">Открийте предимствата на слънчевата енергия и как тя може да преобрази вашия дом.</p>
            
            <div class="row border-top border-2 border-warning pt-5">
            <div class="col-md-6 mb-4">
                <h3>Екологични ползи</h3>
                <p>Слънчевата енергия е чист източник на енергия, който намалява въглеродните емисии и помага за борба с климатичните промени.</p>
            </div>
            <div class="col-md-6 mb-4">
                <h3>Икономически предимства</h3>
                <p>Инвестицията в слънчеви панели може да доведе до значителни спестявания от сметките за електричество и дори да генерира допълнителен доход чрез продажба на излишната енергия.</p>
            </div>
            <div class="col-md-6 mb-4">
                <h3>Независимост от мрежата</h3>
                <p>Слънчевите системи предлагат възможност за автономност, като намаляват зависимостта от традиционните електрически мрежи.</p>
            </div>
            <div class="col-md-6 mb-4">
                <h3>Увеличаване на стойността на имота</h3>
                <p>Домовете със слънчеви панели често имат по-висока стойност на пазара, което ги прави привлекателни за потенциални купувачи.</p>
            </div>
            
            <section class="info-section text-center section-bg">
                <div class="container">
                    <div class="row g-5">
                    <div class="col-md-4">
                        <div class="info-card">
                        <i class="bi bi-piggy-bank-fill fs-3 text-warning"></i>
                        <h5>Слънчевата енергия е по-достъпна от всякога сега</h5>
                        <p>Разходите за монтаж току-що достигнаха рекордно ниски нива, но потенциалните намаления на данъчните облекчения и тарифите заплашват да обърнат това.</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="info-card">
                        <i class="bi bi-graph-up-arrow fs-3 text-warning"></i>
                        <h5>Цените на тока се покачват рязко в цялата страна</h5>
                        <p>Цените на електроенергията се повишиха в 67% от щатите през изминалата година. Собствениците на слънчеви домове си осигуряват предвидими спестявания.</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="info-card">
                        <i class="bi bi-wrench fs-3 text-warning"></i>
                        <h5>Най-добрите монтажници резервират бързо</h5>
                        <p>Собствениците на жилища бързат да си осигурят 30% данъчен кредит, преди да изтече, но капацитетът на монтажниците е ограничен. Не пропускайте да си осигурите най-добрия монтажник.</p>
                        </div>
                    </div>
                    </div>
                </div>
            </section>

        </div>
    </main>
    <footer>
      <?php include '../components/footer.php'; ?>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>
  </body>
</html>
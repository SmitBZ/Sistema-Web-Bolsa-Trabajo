<?php
session_start();
$title = "Workly";
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title; ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;700;800&display=swap" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/3.2.1/anime.min.js"></script>
    <script src="assets/js/animacion_index.js"></script>
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; overflow-x: hidden; }
        .letter { display: inline-block; line-height: 1em; transform-origin: 0 0; }
        .ml11 { font-weight: 800; }
    </style>
</head>
<body class="bg-slate-50 min-h-screen flex items-center justify-center p-6">
    <div class="max-w-5xl w-full">
        <div class="text-center mb-12">
            <div id="logo-icon" class="inline-flex items-center justify-center w-16 h-16 bg-blue-600 rounded-2xl mb-6 shadow-xl shadow-blue-200 opacity-0">
                <i class="fas fa-briefcase text-white text-2xl"></i>
            </div>
            <h1 class="text-4xl md:text-6xl font-black text-slate-900 mb-4 tracking-tight ml11">
                <span class="text-wrapper">
                    <span class="letters">Bienvenido a <span class="text-blue-600">Workly</span></span>
                </span>
            </h1>
            <p id="sub-welcome" class="text-slate-500 text-lg font-medium opacity-0">
                Para comenzar, dinos quién eres
            </p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8" id="profile-cards">
            <a href="views/postulante/login.php" class="card-item group relative bg-white p-10 rounded-[2.5rem] border border-slate-100 shadow-sm hover:shadow-2xl hover:border-blue-200 transition-all duration-500 text-center flex flex-col items-center opacity-0 translate-y-10">
                <div class="w-20 h-20 bg-blue-50 text-blue-600 rounded-3xl flex items-center justify-center mb-6 group-hover:scale-110 group-hover:bg-blue-600 group-hover:text-white transition-all duration-500">
                    <i class="fas fa-user-graduate text-3xl"></i>
                </div>
                <h2 class="text-2xl font-black text-slate-800 mb-3 group-hover:text-blue-600 transition">Soy Postulante</h2>
                <p class="text-slate-500 text-sm leading-relaxed mb-8">
                    Busco nuevas oportunidades laborales o mi próximo gran salto profesional.
                </p>
                <span class="inline-flex items-center gap-2 text-blue-600 font-bold text-sm uppercase tracking-widest">
                    Ingresar <i class="fas fa-arrow-right text-xs group-hover:translate-x-2 transition"></i>
                </span>
            </a>
            <a href="views/empresa/login.php" class="card-item group relative bg-white p-10 rounded-[2.5rem] border border-slate-100 shadow-sm hover:shadow-2xl hover:border-indigo-200 transition-all duration-500 text-center flex flex-col items-center opacity-0 translate-y-10">
                <div class="w-20 h-20 bg-indigo-50 text-indigo-600 rounded-3xl flex items-center justify-center mb-6 group-hover:scale-110 group-hover:bg-indigo-600 group-hover:text-white transition-all duration-500">
                    <i class="fas fa-building text-3xl"></i>
                </div>
                <h2 class="text-2xl font-black text-slate-800 mb-3 group-hover:text-indigo-600 transition">Soy Empresa</h2>
                <p class="text-slate-500 text-sm leading-relaxed mb-8">
                    Quiero publicar vacantes y encontrar el mejor talento para mi equipo.
                </p>
                <span class="inline-flex items-center gap-2 text-indigo-600 font-bold text-sm uppercase tracking-widest">
                        Publicar <i class="fas fa-arrow-right text-xs group-hover:translate-x-2 transition"></i>
                </span>
            </a>
        </div>
    </div>
    <script>
        const textWrapper = document.querySelector('.ml11 .letters');
        textWrapper.innerHTML = textWrapper.textContent.replace(/\S/g, "<span class='letter'>$&</span>");

        const tl = anime.timeline({
            easing: 'easeOutExpo',
            duration: 1000
        });

        tl
            .add({
                targets: '#logo-icon',
                opacity: [0, 1],
                scale: [0.5, 1],
                rotate: '1turn',
                duration: 1200
            })
            .add({
                targets: '.ml11 .letter',
                opacity: [0, 1],
                translateY: [40, 0],
                translateZ: 0,
                scale: [0.3, 1],
                delay: (el, i) => 50 * i,
                offset: '-=1500'
            })
            .add({
                targets: '#sub-welcome',
                opacity: [0, 1],
                translateY: [20, 0],
                duration: 800,
                offset: '-=800'
            })
            .add({
                targets: '.card-item',
                opacity: [0, 1],
                translateY: [40, 0],
                delay: anime.stagger(200),
                offset: '-=600'
            });
    </script>
</body>
</html>
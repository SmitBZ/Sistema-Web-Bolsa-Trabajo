<?php
    require_once __DIR__ . '/../../vendor/autoload.php';
    require_once __DIR__ . '/mostrar_perfil.php';

    use Dompdf\Dompdf;
    use Dompdf\Options;

    $cargar = new mostrar_perfil();
    $perfil = $cargar->cargarPerfil();

    if (!$perfil) {
        die("No se pudo obtener la información del perfil.");
    }


    $path = $perfil['info']['foto'];

    $type = pathinfo($path, PATHINFO_EXTENSION);
    $data = file_get_contents($path);
    $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);


    $options = new Options();
    $options->set('isHtml5ParserEnabled', true);
    $options->set('isRemoteEnabled', true);
    $dompdf = new Dompdf($options);

    $html = '
    <!DOCTYPE html>
    <html>
    <head>
        <style>
            @page { margin: 0px; }
            body { font-family: "Helvetica", sans-serif; margin: 0px; padding: 0px; color: #4a516d; }
            
            .sidebar { width: 30%; background-color: #f0f4f8; height: 100%; position: absolute; left: 0; padding: 40px 20px; }
            .foto { width: 140px; height: 140px; border-radius: 20px; border: 4px solid white; margin-bottom: 20px; }
            
            .main { width: 60%; margin-left: 35%; padding: 40px 30px; }
            
            .nombre { color: #385cb4; font-size: 28px; font-weight: bold; text-transform: uppercase; margin-bottom: 0px; }
            .cargo { color: #656c89; font-size: 14px; font-weight: bold; margin-bottom: 30px; }
            .titulo-sec { color: #385cb4; font-size: 14px; font-weight: bold; border-bottom: 1.5px solid #385cb4; padding-bottom: 5px; margin-top: 25px; margin-bottom: 15px; text-transform: uppercase; }
            
            .item-info { font-size: 11px; margin-bottom: 10px; color: #4a516d; }
            .habilidad { display: inline-block; background: #385cb4; color: white; padding: 4px 8px; border-radius: 5px; font-size: 10px; margin-right: 5px; margin-bottom: 5px; }
            .exp-item { margin-bottom: 20px; }
            .exp-titulo { font-weight: bold; font-size: 13px; color: #385cb4; }
            .exp-sub { font-size: 11px; font-weight: bold; color: #4a516d; }
            .exp-desc { font-size: 11px; color: #656c89; text-align: justify; }
            .periodo { font-size: 10px; color: #94a3b8; }
        </style>
    </head>
    <body>
    
    <div class="sidebar">
        <center><img src="' . $base64 . '" class="foto"></center>
    
        <div class="titulo-sec">Contacto</div>
        <div class="item-info"><strong>Email:</strong><br>' . $perfil['info']['correo'] . '</div>
        <div class="item-info"><strong>Ubicación:</strong><br>' . $perfil['info']['dep'] . ', Perú</div>
    
        <div class="titulo-sec">Habilidades</div>';
    foreach($perfil['habilidades'] as $h) {
        $html .= '<span class="habilidad">' . $h . '</span>';
    }

    $html .= '<div class="titulo-sec">Idiomas</div>';
    foreach($perfil['idiomas'] as $i) {
        $html .= '<div class="item-info"><strong>' . $i['idm_nombre'] . ':</strong> ' . $i['idm_nivel'] . '</div>';
    }
    $html .= '</div>
    
    <div class="main">
        <div class="nombre">' . $perfil['info']['nombre'] . '</div>
        <div class="cargo">' . $perfil['info']['cargo'] . '</div>
    
        <div class="titulo-sec">Sobre mí</div>
        <p class="exp-desc">' . nl2br($perfil['info']['bio']) . '</p>
    
        <div class="titulo-sec">Experiencia Laboral</div>';
    foreach ($perfil['experiencias'] as $xp) {
        $html .= '
            <div class="exp-item">
                <div class="exp-titulo">' . $xp['exp_cargo'] . '</div>
                <div class="exp-sub">' . $xp['exp_empresa'] . '</div>
                <div class="periodo">' . mostrar_perfil::formatPeriodo($xp['exp_fch_inicio'], $xp['exp_fch_fin']) . '</div>
                <p class="exp-desc">' . $xp['exp_descripcion'] . '</p>
            </div>';
    }

    $html .= '<div class="titulo-sec">Educación</div>';
    foreach ($perfil['educaciones'] as $edu) {
        $html .= '
            <div class="exp-item">
                <div class="exp-titulo">' . $edu['edu_titulo'] . '</div>
                <div class="exp-sub">' . $edu['edu_institucion'] . '</div>
                <div class="periodo">' . mostrar_perfil::formatPeriodo($edu['edu_fch_inicio'], $edu['edu_fch_fin']) . '</div>
            </div>';
    }

    $html .= '</div>
    </body>
    </html>';

    $dompdf->loadHtml($html);
    $dompdf->setPaper('A4', 'portrait');
    $dompdf->render();
    $dompdf->stream("CV_" . str_replace(' ', '_', $perfil['info']['nombre']) . ".pdf", ["Attachment" => false]);
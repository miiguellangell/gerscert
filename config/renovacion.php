<?php

/*
|--------------------------------------------------------------------------
| Renovación de certificados vencidos
|--------------------------------------------------------------------------
|
| Un certificado vencido ya no se muestra ni se descarga; en su lugar se
| enlaza al producto de la tienda Shopify para renovarlo. El curso se
| identifica comparando su nombre (sin tildes, en mayúsculas) contra los
| patrones de abajo, en orden: el primero que coincida gana. Es el mismo
| mapa que usa la sincronización de etiquetas renovar-<clave> en Shopify.
|
| Los UTM llegan a Shopify (Analytics → Sesiones por UTM / informes de
| marketing) con utm_campaign = certificado-vencido y utm_content = clave.
|
*/

return [

    'store_url' => 'https://store.gerscol.com',

    // Destino cuando el curso no tiene producto en la tienda.
    'fallback_path' => '/collections/all',

    'utm' => [
        'utm_source' => 'certificados.gerscol.com',
        'utm_medium' => 'referral',
        'utm_campaign' => 'certificado-vencido',
    ],

    'cursos' => [
        'violencia_sexual' => ['/VIOLENCIA SEXUAL/', 'curso-de-atencion-a-victimas-de-violencia-sexual'],
        'acls' => ['/SOPORTE VITAL AVANZADO/', 'curso-de-soporte-vital-avanzado'],
        'rcp' => ['/SOPORTE VITAL BASICO/', 'curso-de-soporte-vital-basico-rcp'],
        'dea' => ['/\bDEA\b/', 'curso-de-uso-y-manejo-del-dea'],
        'agentes_quimicos' => ['/AGENTES QUIMICOS/', 'curso-atencion-a-victimas-por-agentes-quimicos'],
        'duelo' => ['/DUELO/', 'curso-de-manejo-del-duelo'],
        'primeros_auxilios' => ['/^(CURSO DE )?PRIMEROS AUXILIOS (BASICO|AVANZADOS)/', 'curso-de-primeros-auxilos'],
        'humanizacion' => ['/HUMANIZ/', 'curso-de-humanizacion-en-salud'],
        'camillero' => ['/CAMILLERO/', 'curso-de-camillero'],
        'toma_muestras' => ['/TOMA DE MUESTRAS|LABORATORIO CLINICO/', 'curso-de-toma-de-muestras-de-laboratorio-clinico'],
        'donante' => ['/DONANTE/', 'curso-de-cuidado-al-donante-de-organos'],
        'poct' => ['/POCT/', 'curso-de-manejo-de-pruebas-en-punto-de-atencion-poct'],
        'pyp' => ['/SEGURIDAD AL PACIENTE|\(PYP\)/', 'curso-de-prevencion-y-promocion'],
        'medicamentos' => ['/MEDICAMENTOS|INYECTOLOGIA|CANALIZACION/', 'curso-de-administracion-de-medicamentos'],
        'vacunacion' => ['/VACUNACION/', 'curso-de-vacunacion'],
        'aiepi' => ['/AIEPI|ENFERMEDADES PREVALENTES DE LA INFANCIA/', 'curso-de-aiepi-atencion-integrada-a-las-enfermedades-prevalentes-de-la-infancia'],
        'citologia' => ['/CITOLOGIA/', 'curso-toma-de-citologia-de-cuello-uterino'],
        'ovem' => ['/VEHICULOS DE EMERGENCIA/', 'operador-de-vehiculos-de-emergencia-ovem-cove'],
        'vih' => ['/\bVIH\b/', 'curso-de-asesoria-y-prueba-voluntaria-de-vih'],
        'brigadas' => ['/BRIGADAS/', 'capacitacion-brigadas-de-emergencia'],
        'evacuacion' => ['/EVACUACION/', 'curso-de-evacuacion-en-emergencias'],
        'uci' => ['/CUIDADO (CRITICO|INTENSIVO)/', 'curso-de-atencion-al-paciente-en-cuidado-intensivo'],
        'incendios' => ['/INCENDIOS/', 'curso-de-manejo-y-control-de-incendios'],
    ],

];

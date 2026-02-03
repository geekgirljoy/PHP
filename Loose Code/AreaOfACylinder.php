<?php
// Please dear mathematics stop punishing me for thinking about this!
// I will one day make all the variables right!
// A WARNING to all:
//     This code is NOT Lost-In-Space production-ready!
//     If you use this in a nuclear reactor, spacecraft, colony ship, or LV-426 outpost:
//     Just know... I tried and cried! :D
//     Sometimes complexity, time and entropy wins... temporarily over my stress!
//     - Joy
//     ~ Much love!
// I promise to do better next time! :'-(
function fmt($n, $p = 6) {
    return number_format($n, $p, '.', '');
}

function DisplayCylinderGeometry($cylinder_radius, $cylinder_height) {
    if ($cylinder_radius <= 0 || $cylinder_height <= 0) {
        throw new InvalidArgumentException("Radius and height must be positive numbers.");
    }

    $unit_length = "m";
    $unit_area   = "m²";
    $unit_volume = "m³";
    
    $PI = pi();

      $r2 = $cylinder_radius * $cylinder_radius;

    // --- CORE AREAS ---
    $top_area  = $PI * $r2;
    $side_area = 2 * $PI * $cylinder_radius * $cylinder_height;
    $tb_area   = 2 * $top_area;
    $area      = $tb_area + $side_area;
    $volume    = $PI * $r2 * $cylinder_height;

    // --- FORMATTED ---
    $formatted_top_area  = fmt($top_area, 3);
    $formatted_side_area = fmt($side_area, 3);
    $formatted_area      = fmt($area, 3);
    $formatted_volume    = fmt($volume, 3);

    $formated_top_area    = fmt(2 * $top_area, 3);
    $formattted_side_area = fmt($side_area, 3);
 

    // --- DERIVED STRINGS ---
    $derived_area   = "A = (2 · π) · $cylinder_radius · ( $cylinder_radius + $cylinder_height )";

    
    $derived_top    = "{$formatted_top_area}{$unit_area} = π · {$cylinder_radius}²";
    $derived_side   = "{$formattted_side_area}{$unit_area} = 2 · π · {$cylinder_radius} · {$cylinder_height}";
    $derived_volume = "{$formatted_volume}{$unit_volume} = π · {$cylinder_radius}² · {$cylinder_height}";

    // padding
    $area_empty_line = str_repeat(" ", 37) . "│";
    $area_empty_line2 = str_repeat(" ", 41) . "│";
    $area_empty_line3 = str_repeat(" ", 40) . "│";
    $area_empty_line4 = str_repeat(" ", 42) . "│";

    echo <<<"EOT"

                        ╔══════════════════════════════╗
                        ║   CYLINDER GEOMETRY CORE     ║
                        ╚══════════════════════════════╝


                               _________
                          .-'''         '''-.
                      .-'''      TOP = πr²        '''-.
                  .-'''                                   '''-.
              .-'''                                               '''-.
          .-'''                                                           '''-.
       .-'                                                                      '-.
     .'                                                                              '.
    |                                                                                  |
    |                                                                                  |   ↑
    |                                                                                  |   │
    |                                                                                  |   │  h
    |                 SIDE SURFACE = 2πrh                                              |   │
    |                                                                                  |   │
    |                                                                                  |   ↓
     '.                                                                               .'
       '-.                                                                         .-'
           '-.                                                                 .-'
               '-.                                                        .-'
                     '-._                                            _.-'
                             '-._                                _.-'
                                     '--------------------------'


                               ←────── r ──────→


    ┌──────────────────────────────────────────────────────────────────────────┐
    │   TOTAL SURFACE AREA:                                                    │
    │                                                                          │
    │        A = 2πr² + 2πrh                                                   │
    │        A = 2πr(r + h)                                                    │
    │        A = (2 · π) · r · ( r + h )                                       │
    │        {$derived_area} {$area_empty_line}
    │                                                                          │
    │   TOP/BOTTOM SURFACE AREA:                                               │
    │                                                                          │
    │        TB_A = 2πr²                                                       │
    │        TB_A = {$derived_top}{$area_empty_line2}        
    │                                                                          │
    │   SIDE SURFACE AREA:                                                     │
    │                                                                          │
    │        SA = 2 · π · r · h                                                │
    │        {$derived_side}{$area_empty_line3}
    │                                                                          │
    │   VOLUME:                                                                │
    │                                                                          │
    │        V = πr²h                                                          │
    │        {$derived_volume}{$area_empty_line4}
    │                                                                          │
    └──────────────────────────────────────────────────────────────────────────┘
EOT;

    echo PHP_EOL . "End of Cylinder Geometry Display." . PHP_EOL . PHP_EOL;

    $output = [];
    $output['json'] = json_encode([
        "radius" => $cylinder_radius,
        "height" => $cylinder_height,
        "surface_area" => $formatted_area,
        "volume" => $formatted_volume
    ], JSON_PRETTY_PRINT);

    $output['csv'] = "radius,height,surface_area,volume\n" .
        fmt($cylinder_radius, 3) . "," .
        fmt($cylinder_height, 3) . "," .
        $formatted_area . "," .
        $formatted_volume . "\n";
    
    $output['ini'] = "[cylinder_geometry]\n" .
        "radius = " . fmt($cylinder_radius, 3) . "\n" .
        "height = " . fmt($cylinder_height, 3) . "\n" .
        "surface_area = " . $formatted_area . "\n" .
        "volume = " . $formatted_volume . "\n";

    return $output;
}

$cylinder_radius = 7;
$cylinder_height = 22;

$cylinder_details = DisplayCylinderGeometry($cylinder_radius, $cylinder_height);
var_dump($cylinder_details);

ECHO PHP_EOL . "NOTE: Padding logic is fragile." . PHP_EOL;
echo "I've done it wrong!" . PHP_EOL;
echo  "I will fix it later! I sware to you!" . PHP_EOL;


/*
                        ╔══════════════════════════════╗
                        ║   CYLINDER GEOMETRY CORE     ║
                        ╚══════════════════════════════╝


                               _________
                          .-'''         '''-.
                      .-'''      TOP = πr²        '''-.
                  .-'''                                   '''-.
              .-'''                                               '''-.
          .-'''                                                           '''-.
       .-'                                                                      '-.
     .'                                                                              '.
    |                                                                                  |
    |                                                                                  |   ↑
    |                                                                                  |   │
    |                                                                                  |   │  h
    |                 SIDE SURFACE = 2πrh                                              |   │
    |                                                                                  |   │
    |                                                                                  |   ↓
     '.                                                                               .'
       '-.                                                                         .-'
           '-.                                                                 .-'
               '-.                                                        .-'
                     '-._                                            _.-'
                             '-._                                _.-'
                                     '--------------------------'


                               ←────── r ──────→


    ┌──────────────────────────────────────────────────────────────────────────┐
    │   TOTAL SURFACE AREA:                                                    │
    │                                                                          │
    │        A = 2πr² + 2πrh                                                   │
    │        A = 2πr(r + h)                                                    │
    │        A = (2 · π) · r · ( r + h )                                       │
    │        A = (2 · π) · 7 · ( 7 + 22 )                                      │
    │                                                                          │
    │   TOP/BOTTOM SURFACE AREA:                                               │
    │                                                                          │
    │        TB_A = 2πr²                                                       │
    │        TB_A = 307.876m² = π · 7²                                         │        
    │                                                                          │
    │   SIDE SURFACE AREA:                                                     │
    │                                                                          │
    │        SA = 2 · π · r · h                                                │
    │        967.611m² = 2 · π · 7 · 22                                        │
    │                                                                          │
    │   VOLUME:                                                                │
    │                                                                          │
    │        V = πr²h                                                          │
    │        3386.637m³ = π · 7² · 22                                          │
    │                                                                          │
    └──────────────────────────────────────────────────────────────────────────┘
End of Cylinder Geometry Display.

array(3) {
  ["json"]=>
  string(95) "{
    "radius": 7,
    "height": 22,
    "surface_area": "1275.487",
    "volume": "3386.637"
}"
  ["csv"]=>
  string(65) "radius,height,surface_area,volume
7.000,22.000,1275.487,3386.637
"
  ["ini"]=>
  string(93) "[cylinder_geometry]
radius = 7.000
height = 22.000
surface_area = 1275.487
volume = 3386.637
"
}

NOTE: Padding logic is fragile.
I've done it wrong!
I will fix it later! I sware to you!
*/

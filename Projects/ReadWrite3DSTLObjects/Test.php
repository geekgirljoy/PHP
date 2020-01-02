<?php
include 'STLObject.Class.php';

$reporting = false;

// Create new STL Object
$my_3D_stl_object = new STLObject($reporting);
$my_3D_stl_object->LoadSTLFile('cube.stl'); // Load cube.stl
$my_3D_stl_object->ExportSTLFile('Foobar.stl'); // Export cube.stl as Foobar.stl


// Free memory
$my_3D_stl_object = NULL;
unset($my_3D_stl_object);


// New empty stl object
$my_3D_stl_object = new STLObject($reporting); // Create new STL Object
$my_3D_stl_object->SetName('Random');

$number_of_facets = 10;

foreach(range(0, $number_of_facets , 1) as $facet_number){
    
    // Random Normal
    $i = random_int(-5, 5);
    $j = random_int(-5, 5);
    $k = random_int(-5, 5);
    
    // Random Vertex Points
    $x1 = random_int(-5, 5);
    $x2 = random_int(-5, 5);
    $x3 = random_int(-5, 5);
    $y1 = random_int(-5, 5);
    $y2 = random_int(-5, 5);
    $y3 = random_int(-5, 5);
    $z1  = random_int(-5, 5);
    $z2  = random_int(-5, 5);
    $z3  = random_int(-5, 5);
    
    // Add New Random Facet
    $my_3D_stl_object->AddFacet($i,$j, $k,
                            array(array($x1, $y1, $z1), 
                            array($x2, $y2, $z2), 
                            array($x3, $y3, $z3))
                            );
}
$my_3D_stl_object->ExportSTLFile('RandomlyGenerated.stl'); // Export RandomlyGenerated.stl

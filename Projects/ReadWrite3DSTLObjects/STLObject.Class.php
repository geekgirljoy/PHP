<?php

include 'Vertex.Class.php';
include 'Facet.Class.php';

class STLObject{
    
    private $stl_file = '';// string of the file name/path
    private $stl_data;     // array newline delimited
    private $reporting;    // bool echo data as it's processed
    
    private $name;
    private $facets = array();   // facet objects
    private $comments = array(); // any comments in the file are stored here as string
    
    
    function __construct($reporting = false, $stl_file = ''){
        
        $this->reporting = $reporting;
        
        // is string and > '.stl'
        if(is_string($stl_file) && (strlen($stl_file) > 4)){
            $this->LoadSTLFile($stl_file);
        }
    }
    
    public function LoadSTLFile($stl_file = ''){
        
        // is string and > '.stl'
        if(is_string($stl_file) && (strlen($stl_file) > 4)){
            $this->stl_file = file_get_contents($stl_file);
            $this->stl_data = explode(PHP_EOL, $this->stl_data);

            $facets = array();
            $current_facet_normal = array();
            $current_vertex_loop = array();
            $current_vertex = 0;
            
            foreach($this->stl_data as $key=>$line){
                
                $search = strtolower($line);
                
                if(preg_match('~\\b' . 'solid' . '\\b (.*)~i', $search, $objectname)){
                    
                    if($this->reporting === true){
                        echo 'New Solid ' .  $key . PHP_EOL;
                    }
                    
                    if(!empty($objectname)){
                        $this->name = $objectname[1];
                    }
                }
                elseif(preg_match('~\\b' . 'endsolid' . '\\b~i', $search, $solid)){
                    if($this->reporting === true){
                        echo 'End of Solid ' .  $key . PHP_EOL;
                    }
                }                
                elseif(preg_match('~\\b' . 'facet normal' . '\\b (.*) (.*) (.*)~i', $search, $normal)){
                    if($this->reporting === true){
                        echo 'New Facet ' .  $key . PHP_EOL;
                    }
                    $current_facet_normal = array($normal[1], $normal[2], $normal[3]);
                }
                elseif(preg_match('~\\b' . 'endfacet' . '\\b~i', $search, $facet)){
                    if($this->reporting === true){
                         echo 'End of Facet ' .  $key . PHP_EOL;
                    }
                    
                    $facets[] =    $new_Facet = new Facet($current_facet_normal[0], 
                                                       $current_facet_normal[1], 
                                                       $current_facet_normal[2],
                                                       $current_vertex_loop);

                    $current_facet_normal = array();
                    $current_vertex_loop = array();
                    $current_vertex = 0;
                }
                elseif(preg_match('~\\b' . 'outer loop' . '\\b~i', $search, $loop)){
                    if($this->reporting === true){
                        echo 'New Outer Loop ' .  $key . PHP_EOL;
                    }
                }
                elseif(preg_match('~\\b' . 'endloop' . '\\b~i', $search, $loop)){
                    if($this->reporting === true){
                        echo 'End of Loop ' .  $key . PHP_EOL;
                    }
                }
                elseif(preg_match('~\\b' . 'vertex' . '\\b (.*) (.*) (.*)~i', $search, $vertex)){
                    if($this->reporting === true){
                        echo 'New Vertex ' .  $key . PHP_EOL;
                    }
                    $current_vertex++;
                    $current_vertex_loop[] = array($vertex[1], $vertex[2], $vertex[3]); // Vertex x, y, z axis
                }
                elseif(preg_match('~\\b' . ';(.*)' . '\\b~i', $search, $comment)){
                    if($this->reporting === true){
                        echo 'New Comment ' .  $key . PHP_EOL;
                    }
                    $comments[$key] = ";$comment";
                }
                else{
                    // Process or Ignore Unknown Data
                    if($this->reporting === true){
                        echo 'Unknown Data ' .  $key . PHP_EOL;
                    }
                }
                
                if(empty($comments[$key]) == true){
                    $comments[$key] = "";
                }
            }
            
            if(count($facets) > 0){
                $this->facets = $facets;
            }
        }
        else{
            trigger_error("LoadSTLFile(STL File Path) requires you provide a string path to an stl file.". PHP_EOL, E_USER_ERROR);
        }
    }
        
    public function ExportSTLFile($stl_file = ''){
        
        // is string and > '.stl'
        if(is_string($stl_file) && (strlen($stl_file) > 4)){
            $line = 0;
            
            $output = 'solid ' . $this->name . @$this->comments[$line] . PHP_EOL;
            $line++;
            
            foreach($this->facets as $facet){
                
                $current_facet_normal = $facet->GetNormalPosition();
                $current_vertex_loop = $facet->GetVertexLoop();
                
                $ni = $current_facet_normal['i'];
                $nj = $current_facet_normal['j'];
                $nk = $current_facet_normal['k'];
                
                $output .= "facet normal $ni $nj $nk"  . @$this->comments[$line] . PHP_EOL;
                $line++;
                $output .= "    outer loop"  . @$this->comments[$line] . PHP_EOL;
                $line++;
                foreach($current_vertex_loop as $vertex){
                    $vx = $vertex['x'];
                    $vy = $vertex['y'];
                    $vz = $vertex['z'];
                    
                    $output .= "        vertex $vx $vy $vz"  . @$this->comments[$line] . PHP_EOL;
                    $line++;
                }
                $output .= "    endloop"  . @$this->comments[$line] . PHP_EOL;
                $line++;
                $output .= "endfacet"  . @$this->comments[$line] . PHP_EOL;
                $line++;
            }
            $output .= 'endsolid ' . $this->name . @$this->comments[$line] . PHP_EOL;
            
            // add any end of file comments
            $number_of_comments = count($this->comments);
            while($line <= $number_of_comments){
                $output .= @$this->comments[$line] . PHP_EOL;
                $line++;
            }
            
            
            // write file
            if(strlen($output) > 0){
                file_put_contents($stl_file, $output);
            }
            else{
                trigger_error("STLObject contains no data". PHP_EOL, E_USER_ERROR);
            }
        }
        else{
            trigger_error("ExportSTLFile(STL File Path) file name must be longer than 4 chars". PHP_EOL, E_USER_ERROR);
        }
    }
    
    public function AddFacet($ni = 0, $nj = 0, $nk = 0, $vertex_loop = array()){
        $this->facets[] = new Facet($ni, $nj, $nk, $vertex_loop);
    }
    
    public function SetName($name = ''){
        $this->name = $name;
    }

}

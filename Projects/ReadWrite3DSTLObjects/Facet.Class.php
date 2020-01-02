<?php

class Facet{
    private $ni = 0;
    private $nj = 0;
    private $nk = 0;
    
    private $vertex_loop = array();
    
    function __construct($ni = 0, $nj = 0, $nk = 0, $vertex_loop = array()){
        $this->SetNormalPosition($ni, $nj, $nk);
        $this->SetVertexLoop($vertex_loop);
    }

    public function SetNormalPosition($ni = 0, $nj = 0, $nk = 0){
        $this->ni = $ni;
        $this->nj = $nj;
        $this->nk = $nk;
    }
    
    public function GetNormalPosition(){
            return array('i'=>$this->ni, 'j'=>$this->nj, 'k'=>$this->nk);
    }
    
        
    public function SetVertexLoop($vertex_loop = array()){
        
        // if not empty and a complete loop (3 vertex sets) in array
        if(!empty($vertex_loop) && count($vertex_loop) == 3){
            
            $this->ClearVertexLoop();
        
            foreach(range(0, 2, 1) as $vertex){
                // if is array and 3 axis in each vertex array
                if(is_array($vertex_loop[$vertex]) && count($vertex_loop[$vertex]) == 3){
                    $this->AddVertex($vertex_loop[$vertex][0], $vertex_loop[$vertex][1], $vertex_loop[$vertex][2]);
                }
                else{
                    trigger_error('SetVertexLoop($vertex_loop = array()) requires an array of 3 vertex axis arrays [0=>[X,Y,Z],1=>[X,Y,Z],2=>[X,Y,Z]] .'. PHP_EOL, E_USER_ERROR);
                }
            }
        }
        else{
            trigger_error('SetVertexLoop($vertex_loop = array()) requires an array of 3 vertex axis arrays [0=>[X,Y,Z],1=>[X,Y,Z],2=>[X,Y,Z]] .'. PHP_EOL, E_USER_ERROR);
        }
    }
    
    private function AddVertex($vx = 0, $vy = 0, $vz = 0){
        $this->vertex_loop[] = new Vertex($vx, $vy, $vz);
    }
    
    private function ClearVertexLoop(){
        $this->vertex_loop = array();
    }
    
    public function GetVertexLoop(){
        $loop = array();
        
        foreach($this->vertex_loop as $vertex){
           $loop[] = $vertex->GetPosition();
        }
        
        return $loop;
    }
    
}
//$vertex_set = [0=>[0,1,1], 1=>[1,1,1], 2=>[1,0,1]];
//$new_Facet = new Facet($ni = 0, $nj = 0, $nk = 0, $vertex_set);

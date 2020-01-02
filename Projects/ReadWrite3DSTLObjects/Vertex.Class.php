<?php
class Vertex{
	
    private $vx = 0;
    private $vy = 0;
    private $vz = 0;
    
    function __construct($vx = 0, $vy = 0, $vz = 0){
        $this->SetPosition($vx, $vy, $vz);
    }

    public function SetPosition($vx = 0, $vy = 0, $vz = 0){
        $this->vx = $vx;
        $this->vy = $vy;
        $this->vz = $vz;
    }
    
    public function GetPosition(){
            return array('x'=>$this->vx, 'y'=>$this->vy, 'z'=>$this->vz);
    }
}

//$new_vertex = new Vertex();
//$new_vertex->GetPosition(); // array('x'=>0, 'y'=>0, 'z'=>0)

//$new_vertex = new Vertex(-1,1,1);
//$new_vertex->GetPosition();// array('x'=>-1, 'y'=>1, 'z'=>1)

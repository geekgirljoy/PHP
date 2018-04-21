<?php
/* 
	* AppTimer.Class.php
	* Joy Harvel
	* 2018
*/


class AppTimer
{
	/*///////////////////////////////////////////////////*/
	/* AppTimer Properties                               */
	/*///////////////////////////////////////////////////*/
    private $start = NULL;
    private $stop = NULL;
    private $report = NULL;  
    

        /*/////////////////////////////////////////////////////////*/
	/* Constructor                                             */
	/*                                                         */
	/* Set $AutoStart to 1 or true to begin timer at creation  */
	/*                                                         */
	/*/////////////////////////////////////////////////////////*/  
	function __construct($AutoStart = 0){
		if($AutoStart == true){
		    $this->Start();
		}
	} 
	
  
	/*///////////////////////////////////////////////////*/
	/* Destructor                                        */
	/*///////////////////////////////////////////////////*/
	function __destruct() {
	   // No More AppTimer
	}
	
	
	/*///////////////////////////////////////////////////*/
	/* Start()                                           */
	/*///////////////////////////////////////////////////*/
	function Start(){
		$this->start = microtime(true); // now
		$this->stop = NULL; // set stop to NULL in case timer is used multiple times
	}
	
	
	/*///////////////////////////////////////////////////*/
	/* Stop()                                            */
	/*///////////////////////////////////////////////////*/
	function Stop($AutoReport = 0){
		$this->stop = (microtime(true) - $this->start); // now - start
		
		if($AutoReport == true){
		    return $this->Report();
		}
	}
	
	
	/*///////////////////////////////////////////////////*/
	/* Report()                                          */
	/*///////////////////////////////////////////////////*/
	function Report( ){
	
		 
		// Timer has stopped
		if($this->start != NULL && $this->stop != NULL){
			$this->report = $this->stop;
		}
		else{ // Timer is still running or was never started
			if($this->start != NULL){
				$this->report = (microtime(true) - $this->start); // now - start
			}
			else{
				return 'Timer was not started. Use Start() method.';
			}
			
		}
		

		// Compute Report as Hours & or Minutes & or Seconds
		if($this->report > 3600){ // Hours
			
			$hours = round(($this->report / 60) / 60, 8);
			
			if (is_float($hours)){ // Minutes
				$minutes = '0' . strstr($hours, '.');
				$minutes = $minutes * 60;
				$hours = round($hours, 0);
				if (is_float($minutes)){ // Seconds
					$seconds = '0' . strstr($minutes, '.');
					$seconds = round($seconds * 60, 4);
					$minutes = round($minutes, 0);
					$this->report = $hours . ' Hours ' . $minutes . ' Minutes ' . $seconds . ' Seconds';
				}
				else{
					$this->report = $hours . ' Hours ' . $minutes . ' Minutes';
				}
			}
			else{
				$this->report = $hours . ' Hours';
			}
		}
		elseif($this->report > 60){ // Minutes
			
			$minutes = round($this->report / 60, 8);
			
			if (is_float($minutes)){ // Seconds
				$seconds = '0' . strstr($minutes, '.');
				$seconds = round($seconds * 60, 4);
				$minutes = round($minutes, 0);
				$this->report = $minutes . ' Minutes ' . $seconds . ' Seconds';
				
			}
			else{
				$this->report = $minutes . ' Minutes';
			}		
		}
		else{ // Seconds
			$this->report = round($this->report, 4) . ' Seconds';
		}	
		
		return $this->report;
	}
	
	/*///////////////////////////////////////////////////*/
	/* CallbackTimer()                                   */
	/*///////////////////////////////////////////////////*/
	function CallbackTimer($callback = NULL, $arguments = array()){
				
		// if callback is array then it is object & method			
		//$callback[0] = object
		//$callback[1] = method name
		
		// if callback is string then it is a function name
		//$callback = 'YourFunctionName'
		
		//$arguments[0] = argument 0
		//$arguments[1] = argument 1
		//$arguments[n] = argument n
		
		if($callback != NULL){		
			$this->Start();
			call_user_func_array($callback, $arguments);	// run callback
			return $this->Stop(1); // Auto Report
	    }else{
			return 'Missing Callback Name or Array.'; // Error
		}
	    
	    
	}
	
	
	/*///////////////////////////////////////////////////*/
	/* GetTime()                                         */
	/*///////////////////////////////////////////////////*/
	function GetTime($duration_seconds){
		
		$this->start = 1;
		$this->stop = $duration_seconds + 1;
		
		return $this->Report();
	}
	
}

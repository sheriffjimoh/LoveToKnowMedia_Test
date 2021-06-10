<?php

 /**
  *  start the magic
     author:: jimoh sherifdeen
  */
 class MainClass
 {
   

	   public $file;


	   function __construct($filename)
	   {
	   	$this->file = $filename;
	   }

	 	public function Readinfile()
	 	{
	 	
	 	   return 	$this->file;

	 	}
      

        public function ArrFileSumBase_1($arr_filez)
        {
        	if (is_array($arr_filez) ) {
	      	   $sum = 0;

	      	   for ($i=0; $i < count($arr_filez) ; $i++) { 
	      	       $readinfiles = fopen($arr_filez[$i], 'r');

		      	    while(!feof($readinfiles)) {

		 		  	    $linepeice = fgets($readinfiles);

			 		  	if (is_numeric($linepeice)) {
			 		  	   $sum  += $linepeice;
			 		  	}
		 		    }
		 		}

	      	  return $sum;
	      	}
        }

	    public function ArrFileSum($arr_filez)
	    {
	      	if (is_array($arr_filez) ) {
	      	   $sum = 0;
	      	   $new_arr_file = array();

	      	   for ($i=0; $i < count($arr_filez) ; $i++) { 
	      	        $readinfiles = fopen($arr_filez[$i], 'r');

		      	    while(!feof($readinfiles)) {

		 		  	    $linepeice = fgets($readinfiles);

			 		  	if (is_numeric($linepeice)) {
			 		  	   $sum  += $linepeice;
			 		  	}elseif( strpos($linepeice, '.txt' ) !== false ) {
			 		  		if (!in_array($linepeice, $new_arr_file)) {
			 		  			$new_arr_file[]=trim($linepeice);
			 		  		}
		 		        }
		 		    }
		 		}


		 	if (!empty($new_arr_file)) {
		 	     $result = $this->ArrFileSumBase_1($new_arr_file);
		    }else{
		 		  $result = 0;
		 		}
          
            if ($result > 0) {
              	$an  =  $result+$sum;
            }else{
              	$an =  $sum;
            }

              return $an;

	      	}
	    }
 	
	 	public function Main_Sum_Engine()
	 	{
	 		 $sum = 0;
	 		 $an = 0;
	 		 $arr_filez = array();
	 		 $readinfiles =fopen($this->Readinfile(), 'r');

	 		  while(!feof($readinfiles)) {

	 		  	$linepeice = fgets($readinfiles);

	 		  	if (is_numeric($linepeice)) {
	 		  	   $sum  += $linepeice;
	 		  	}elseif( strpos($linepeice, '.txt' ) !== false ) {
	 		  		if (!in_array($linepeice, $arr_filez)) {
	 		  			$arr_filez[]=trim($linepeice);
	 		  		}
	 		  		
	 		  	}
	 		  }
           
              $result = $this->ArrFileSum($arr_filez);

              if ($result > 0) {
              	$an  =  $result+$sum;
              }else{
              	$an =  $sum;
              }

              if (!empty($arr_filez)) {
              	$sub_file = $arr_filez;
              }else{
              	$sub_file = "null";
              }
          
	 		 return  array('sum' =>$an , 'main_file' => $this->Readinfile(),  'sub_files' =>$sub_file);
	 		
	 	}


    
 }





/**********Initiate The Classs  And Supply A File Path To Process**********/

$class =  new MainClass("file4.txt");


echo "*******************************************************************";
echo "<br>";
/************************Get The Supplied File Path***********************/
$Readin =  $class->Readinfile();

echo "Main File Path ::  ".$Readin."<br>";


echo "********************************************************************";
echo "<br>";

/*************Sum All The Integer Values In The Array Of Files*************/

$arr_filez = array('file1.txt','file2.txt','file3.txt','file4.txt');

$arr_file_sum = $class->ArrFileSum($arr_filez);

echo "Total Sum For All Files In The Array ::".$arr_file_sum;

/*************Get The Files Dtetails, Sum,Subfiles and Main File Path*************/

echo "<br>";
echo "********************************************************************";
echo "<br>";
//initiate the function
$sumvalues = $class->Main_Sum_Engine();


echo "Get The Files Dtetails, Sum,Subfiles and Main File Path";
echo "<br>";
echo "<pre>";
print_r($sumvalues);
echo "</pre>";





?>
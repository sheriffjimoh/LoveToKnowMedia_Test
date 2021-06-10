<?php

 /**
  * 
  */
 class MainClass
 {
   

	   public $file;
	   // public 

	   function __construct($filename)
	   {
	   	$this->file = $filename;
	   }

	 	public function Readinfile()
	 	{
	 	
	 	   return 	$this->file;

	 	}
      

        public function GetFilesSumBase_1($arr_filez)
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

	      public function GetFilesSum($arr_filez)
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
		 			  $result = $this->GetFilesSumBase_1($new_arr_file);
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
 	
	 	public function SumReadinValues()
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
           
              $result = $this->GetFilesSum($arr_filez);

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
              // return $result;

	 		 return  array('sum' =>$an , 'main_file' => $this->Readinfile(),  'sub_files' =>$sub_file);
	 		
	 	}


    


 	// public function Mainfile()
 	// {
 	// 	return $this->files;
 	// }
 }






$class =  new MainClass("file.txt");

$Readin =  $class->Readinfile();

$sumvalues = $class->SumReadinValues();

// $arr_filez = array('song.txt','video.txt','file.txt');

// print_r($arr_filez);
// array of files
// $arr_file_sum = $class->GetFilesSum($arr_filez);
echo "<pre>";
print_r($sumvalues);
echo "</pre>";

// print_r($arr_file_sum);
// $sum = 0;


// echo $sum;
// 

// $myfile = fopen("file.txt", "r") or die("Unable to open file!");
// Output one line until end-of-file

//  while(!feof($myfile)) {
  
//   $result = $class->sumvalues(fgets($myfile));
  

// echo "<br>";
// }


// echo  $result;
?>
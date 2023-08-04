<?php

namespace App\Console\Commands;

use File;
use Illuminate\Console\Command;

class finderror extends Command
{
  /**
   * The name and signature of the console command.
   *
   * @var string
   */
  protected $signature = 'quick:debug {text?}';

  /**
   * The console command description.
   *
   * @var string
   */
  protected $description = 'Find exit,dd and custom string from the projects.';

  /**
   * Create a new command instance.
   *
   * @return void
   */
  public function __construct()
  {
    parent::__construct();
  }

  /**
   * Execute the console command.
   *
   * @return int
   */
  public function handle(){

    $skipFolder = ['vendor','public','css','js','storage'];
    $directory =  base_path() . '/';

    $iterator = new \RecursiveIteratorIterator(
        new \RecursiveDirectoryIterator($directory, \RecursiveDirectoryIterator::SKIP_DOTS),
        \RecursiveIteratorIterator::SELF_FIRST
    );
    
    foreach ($iterator as $item) {
        $path = $item->getPathname();
        
        if ($item->isDir()) {
            // Handle directory
            // echo 'Directory: ' . $path . PHP_EOL;
            $dirName = $item->getFileName();
            if(in_array($dirName,$skipFolder)){
              break;
            }
        } else {
            // Handle file
          //  echo 'File: ' . $path . PHP_EOL;
            $fileName = $item->getFileName();
            if($fileName!=='finderror.php'){
              $this->findString($fileName,$path);
            }
             
        }
    }
  }

  public function findString($fileinfo,$filefullpath='')
  {
    $searchStringText = $this->arguments()['text'];
    
    if(!empty($searchStringText)){
      $searchTextArray[] = $searchStringText;
    }else{
      $searchTextArray = ['dd(', 'exit()'];
    }
   
    //echo "\n" . $filefullpath . "\n\n";
    if (!empty($filefullpath) && (strpos($fileinfo, '.'))) {
      $fileLines = file($filefullpath, FILE_IGNORE_NEW_LINES);
      foreach ($fileLines as $index => $line) {
        for ($i = 0; $i < count($searchTextArray); $i++) {
          $lineNumber = false;
          $searchText = $searchTextArray[$i];
          if (strpos($line, $searchText) !== false) {
            $lineNumber = $index + 1;  // Add 1 to convert from array index to line number
            // break;  // Exit the loop if the text is found
            if ($lineNumber !== false) {
              $searchTextName = $searchText==='dd(' ?'dd()':$searchText;
              echo "\nThe text '$searchTextName' was found on line $lineNumber of the file - $fileinfo\n";
            } else {
              // echo "\nThe text '$searchText' was not found in the file.";
            }
          }
        }
      }
    }
  }
}

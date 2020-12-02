<?php
$lend_name=$_POST['lend_name'];
$folder_name=$_POST['folder_name']; 
$domain_name=$_POST['domain_name'];
$created_fold=mkdir("../$domain_name/$folder_name");
$foldpass="/var/www/www-root/data/www/$domain_name/$folder_name/";


 lowering($lend_name,$foldpass);

  function lowering($dirname,$dirdestination)
  {
    // Открываем директорию
    $dir = opendir($dirname);
    // В цикле выводим её содержимое
    while (($file = readdir($dir)) !== false)
    {
      echo $file."<br>";
      // Вырезаем первую точку
      // Если это файл копируем его
      if(is_file($dirname."/".$file))
      {
        copy($dirname."/".$file, $dirdestination."/".$file);
      }
      // Если это директория - создаём её
      if(is_dir($dirname."/".$file) &&
         $file != "." &&
         $file != "..")
      {
        // Создаём директорию
        if(!mkdir($dirdestination."/".$file))
        {
          echo "Can't create ".$dirdestination."/".$file."\n";
        }
        // Вызываем рекурсивно функцию lowering
        lowering("$dirname/$file","$dirdestination/$file");

      }
    }
    // Закрываем директорию
    closedir($dir);
  }

?>
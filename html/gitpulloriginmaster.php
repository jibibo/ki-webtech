<?php

// src: https://stackoverflow.com/questions/23136044/automation-of-git-pull-using-php-code
function execPrint($command) {
  $result = array();
  exec($command, $result);
  print("<pre>");
  foreach ($result as $line) {
      print($line . "\n");
  }
  print("</pre>");
}

// Print the exec output inside of a pre element
execPrint("git pull origin master");
execPrint("git status");


// $output = shell_exec("git pull origin master");

// echo $output;

// echo "test pull 123123";
// echo "jull";

?>

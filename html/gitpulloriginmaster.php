<?php

// src: https://stackoverflow.com/questions/23136044/automation-of-git-pull-using-php-code
function execPrint($command)
{
  $result = array();
  exec($command, $result);
  print("<pre>");
  foreach ($result as $line) {
    print($line . "\n");
  }
  print("</pre>");
  echo "<br /><p>------------</p><br />";
}

// Print the exec output inside of a pre element
// execPrint("cd /var/www/");
// execPrint("git pull origin master");

echo shell_exec("cd /var/www && git pull origin master");

echo "test123";

// $output = shell_exec("git pull origin master");

// echo $output;

// echo "test pull 123123";
// echo "jull";

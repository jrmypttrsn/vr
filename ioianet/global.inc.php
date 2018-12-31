<?php
/**
* Registers global variables
*
* This function takes global namespace $HTTP_*_VARS variables from input and if they exist,
* register them as a global variable so that scripts can use them.  The first argument
* signifies where to pull the variable names from, and should be one of GET, POST, COOKIE, ENV, or SERVER.
*
*/
function pt_register()
{
   $num_args = func_num_args();
   $vars = array();

   if ($num_args >= 2)
   {
      $method = strtoupper(func_get_arg(0));

      if (($method != 'SESSION') && ($method != 'GET') && ($method != 'POST') &&
         ($method != 'SERVER') && ($method != 'COOKIE') && ($method != 'ENV'))
      {
         die('The first argument of pt_register must be one of the following:
         GET, POST, SESSION, SERVER, COOKIE, or ENV');
      }
      $varname = "HTTP_{$method}_VARS";
      global ${$varname};

      for ($i = 1; $i < $num_args; $i++)
      {
         $parameter = func_get_arg($i);

         if (isset(${$varname}[$parameter]))
         {
            global $$parameter;
            $$parameter = ${$varname}[$parameter];
            $$parameter = trim($$parameter);
         }
      }
   }
   else
   {
      die('You must specify at least two arguments');
   }
}
/*
You can then register your global variables for use like this:
// register a GET var
pt_register('GET', 'user_id', 'password');
// register a server var
pt_register('SERVER', 'PHP_SELF');
// register some POST vars
pt_register('POST', 'submit', 'field1', 'field2', 'field3');
*/
?>

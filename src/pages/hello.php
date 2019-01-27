<?php
$input = $request->get('name', 'World');

$input = htmlspecialchars($input, ENT_QUOTES, 'UTF-8');

//printf('Hello %s', htmlspecialchars($input, ENT_QUOTES, 'UTF-8'));
?>

<h1> Hello <?php echo $input?></h1>






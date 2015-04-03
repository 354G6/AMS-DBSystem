<?php
    //include dirname(__FILE__) . "core/Customer.php";
    
    $result = 0; //= CustomerRegister($_POST['cid'], $_POST['password'], $_POST['name'], $_POST['address'], $_POST['phone'])
    $returnMessage = 'Registered successfully!';
    $errorMessage = array( '',
                        'Unable to connect to the database.',
                        'Failed executing query.'
                    );
    $returnMessage = 'Error:'.$errorMessage[$result];
    
?>

<div class="returnMessage"><?echo $returnMessage?></div>
<a href="?op=loginpage">Click here to log in</a>
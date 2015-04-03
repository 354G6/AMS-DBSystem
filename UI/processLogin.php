<?php
    //include dirname(__FILE__) . "core/Customer.php";
    
    $result = 0; //= CustomerLogin($_POST['cid'], $_POST['password'])
    if ($result == 0) {
        $_SESSION['role']="manager"; //get this from the core login function???
        echo 'Login successfully!';
        
        echo "<script>window.location = '?op=home'</script>";
    }
    else {
        $errorMessage = array( '',
                            'Unable to connect to the database.',
                            'Failed executing query.'
                        );
        echo 'Error:'.$errorMessage[$result];
    }
    
?>
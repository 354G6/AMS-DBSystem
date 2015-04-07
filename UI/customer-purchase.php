<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$validated=true;
	$category = $title = $leadingSinger = "";
	
	//filter input data
	$category = filter($_POST["category"]);
	$title = filter($_POST["title"]);
	$leadingSinger = filter($_POST["leadingSinger"]);
	
	//validate
    //if () {
    //    $validated=false;
    //}
	if ($validated) {
        //clear form data
        //$_POST["category"]="";
        //$_POST["title"]="";
        //$_POST["leadingSinger"]="";
        
        include "core/itemPurchase.php";
        $returnMessage="";
        
        //$row1 = array('upc'=>'123456789999', 'title'=>'Test DVD', 'price'=>'100', 'stock'=>'23'); //for testing only
        //$row2 = array('upc'=>'123456780000', 'title'=>'Test CD', 'price'=>'45', 'stock'=>'1'); //for testing only
        
        $result = itemSearch($category, $title, $leadingSinger);
        if (is_array($result)) {
            if (count($result)>0) {
                $returnMessage= count($result)+' items found.';
            } else {
                $returnMessage= 'No item matches your criteria. Please specify again.';
            }
        } else {
            $errorMessage = array( '',
                                'Unable to connect to the database.',
                                'Failed executing query.'
                            );
            $returnMessage = 'Error: '.$errorMessage[$result];
        }
    }
}

function filter($data){
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}
?>
<div class="entryBox">
<h2>Buy Items</h2>
<div class="feedbackMessage"><?echo $returnMessage?></div>
<div class="instruction">Specify an item you want:</div>
<form action="?op=<?echo $_GET['op']?>" method="POST" autocomplete="off">
    <div class="textEntry">Category: <input type="text" name="category" placeholder="e.g. Rock" value="<?echo $_POST["category"]?>" /> <span class="error"></span></div>
    <div class="textEntry">Title: <input type="text" name="title"  placeholder="e.g. The Love Songs" value="<?echo $_POST["title"]?>"/> <span class="error"></span></div>
    <div class="textEntry">Leading Singer: <input type="text" name="leadingSinger"  placeholder="e.g. Beatles" value="<?echo $_POST["leadingSinger"]?>" /> <span class="error"></span></div>

    <div class="formAction">
        <input type="submit" value="Search" name="search"/>
        <!-- <a href="?op=home">Cancel</a> -->
    </div>

</form><br/>
<?php
if (is_array($result)) {
    echo
    '<div class="instruction">Item(s) that match your criteria:</div>
    <form action="?op='.$_GET['op'].'" method="POST">
    <table>';

    $labelRow=true;
    $i=0;
    foreach($result as $row) {
        if ($labelRow) {
            echo '<tr class="labelrow"><td></td>';
            foreach($row as $key=>$value) {
                echo '<th class="labelcell">'.$key.'</th>';
            }
            $labelRow=false;
            echo '</tr>';
        }
        if ($row['stock']>0) {
            echo '<tr><td><input type="radio" name="item" id="'.$i.'" /></td>';
            foreach($row as $key=>$value) {
                echo '<td><label for="'.$i.'">'.$value.'</label></td>';
            }
            echo '</tr>';
        }
        $i++;
    }
    
    echo
    '</table>
    <div class="formAction">
        <input type="submit" value="Add To Cart" name="addToCart"/>
    </div>
    </form>';
}
?>
</div>
<?php 

if (!empty($_GET["tab"])){
     $input = $_GET["tab"];
    
    $parts = preg_split('/(\+|\-|\*|\/)/', $input, -1, PREG_SPLIT_DELIM_CAPTURE | PREG_SPLIT_NO_EMPTY);
    // print_r($parts);
    $s = 0;
    if (count($parts) >= 1 && is_numeric($parts[0])) {
        $s = (float)$parts[0];
   for ($i = 1; $i < count($parts) - 1; $i += 2) {
            $operator = $parts[$i];
            $number = (float)$parts[$i + 1];
             switch ($operator) {
                case '+':
                    $s += $number;
                    break;
                case '-':
                    $s -= $number;
                    break;
                case '*':
                    $s *= $number;
                    break;
                case '/':
                    // Handle division by zero if necessary
                    if ($number != 0) {
                        $s /= $number;
                    } else {
                        $s = "Error: Division by zero";
                        break 2; // Exit both the switch and the for loop
                    }
                    break;
            }
        }
    } else {
        $s = "Error: Invalid input format";
         }

}
?>
<form action="" method="GET">
<input type="text" name="tab" id='calcInput' value="<?php echo (isset($s) && $s != 0) ? $s : ''; ?>"><br>
<?php for($j=9;$j>=0;$j--){ ?><button type="button" name="n1"  onclick="appendToInput(<?php echo $j?>)"><?php echo $j?></button> 
     <?php ;} ?><br>
     <button type="button" name="ac"  onclick="remov()">AC</button>
<button type="button" name="pre"  onclick="delet()">pr</button>
<button type="button" name="div"  onclick="appendToInput('/')">/</button>
<button type="button" name="prod" onclick="appendToInput('*')">x</button>
<button type="button" name="def"  onclick="appendToInput('-')">-</button>
<button type="button" name="add"  onclick="appendToInput('+')">+</button>

<input type="submit" value="=">
</form>


<script>
    function remov() {
    const inputF = document.getElementById('calcInput');
    inputF.value ="";
}
function appendToInput(value) {
    const inputF = document.getElementById('calcInput');
    inputF.value += value;
}
function delet() {
    const inputF = document.getElementById('calcInput');
    if (inputF.value.length > 0) {
        inputF.value = inputF.value.slice(0, -1);
    }
     
}
// function div(){
    
// }
</script>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Apple Style Calculator</title>
    
    <!-- Bootstrap CSS CDN Link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: #f5f5f7;
            font-family: Arial, sans-serif;
        }
        .calc-box {
            background: white;
            padding: 30px;
            border-radius: 20px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
        }
        .calc-btn {
            width: 70px;
            height: 70px;
            margin: 5px;
            border-radius: 50px;
            font-size: 22px;
        }
        .calc-btn.op {
            background: #ff9500;
            color: white;
        }
        .calc-btn.ac {
            background: #ff3b30;
            color: white;
        }
    </style>
</head>
<body>

<?php 
if (!empty($_GET["tab"])) {
    $input = $_GET["tab"];
    $parts = preg_split('/(\+|\-|\*|\/)/', $input, -1, PREG_SPLIT_DELIM_CAPTURE | PREG_SPLIT_NO_EMPTY);

    $s = 0;
    if (count($parts) >= 1 && is_numeric($parts[0])) {
        $s = (float)$parts[0];
        for ($i = 1; $i < count($parts) - 1; $i += 2) {
            $operator = $parts[$i];
            $number = (float)$parts[$i + 1];

            switch ($operator) {
                case '+': $s += $number; break;
                case '-': $s -= $number; break;
                case '*': $s *= $number; break;
                case '/': 
                    if ($number != 0) $s /= $number;
                    else $s = "Error: Division by zero";
                break;
            }
        }
    } else {
        $s = "Error: Invalid input format";
    }
}
?>

<div class="container d-flex justify-content-center align-items-center vh-100">
    <form action="" method="GET" class="calc-box text-center">

        <input type="text" 
               name="tab" 
               id="calcInput" 
               class="form-control form-control-lg mb-4 text-end"
               style="font-size:30px; padding:20px; border-radius:15px;"
               value="<?php echo (isset($s) && $s !== 0) ? $s : ''; ?>">

        <div class="container">
    <div class="row g-2">

        <?php 
        // الأرقام 9 → 0
        $nums = [9,8,7,6,5,4,3,2,1,0];
        foreach ($nums as $index => $n) { ?>
            <div class="col-3">
                <button type="button" 
                        class="btn btn-light calc-btn w-100" 
                        onclick="appendToInput('<?php echo $n; ?>')">
                    <?php echo $n; ?>
                </button>
            </div>
        <?php } ?>

        <!-- زر النقطة -->
        <div class="col-3">
            <button type="button" class="btn btn-light calc-btn w-100" onclick="appendToInput('.')">.</button>
        </div>

        <!-- AC -->
        <div class="col-3">
            <button type="button" class="btn calc-btn ac w-100" onclick="remov()">AC</button>
        </div>

        <!-- delete -->
        <div class="col-3">
            <button type="button" class="btn btn-secondary calc-btn w-100" onclick="delet()">⌫</button>
        </div>

        <!-- operators -->
        <div class="col-3">
            <button type="button" class="btn calc-btn op w-100" onclick="appendToInput('/')">÷</button>
        </div>
        <div class="col-3">
            <button type="button" class="btn calc-btn op w-100" onclick="appendToInput('*')">×</button>
        </div>
        <div class="col-3">
            <button type="button" class="btn calc-btn op w-100" onclick="appendToInput('-')">−</button>
        </div>
        <div class="col-3">
            <button type="button" class="btn calc-btn op w-100" onclick="appendToInput('+')">+</button>
        </div>

        <!-- = button full width -->
        <div class="col-12 mt-2">
            <input type="submit" value="=" class="btn btn-success calc-btn w-100">
        </div>

    </div>
</div>

    </form>
</div>


<script>
function remov() {
    document.getElementById('calcInput').value = "";
}
function appendToInput(value) {
    document.getElementById('calcInput').value += value;
}
function delet() {
    const f = document.getElementById('calcInput');
    f.value = f.value.slice(0, -1);
}
</script>

</body>
</html>

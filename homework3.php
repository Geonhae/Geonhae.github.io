<!DOCTYPE html>
<html>
<body>


<?php
    $i = 1; //i변수에 1을 대입합니다.


    while($i<=30) //i가 10보다 작거나 같을 때 반복합니다
    {
        echo $i."<br />"; //i를 출력합니다.
        $i++; //i를 1씩 증가합니다.(증감식)
    }
    $sum=0; for($i=1;$i<=30;$i++)
    {       $sum+=$i;   }
    echo  $sum."<br />";
    
    $multipl=1; for($i=1; $i<=30;$i++)
    { $multipl*=$i;}  // 1부터 30까지 곱하기
    echo $multipl."<br />";
?>
<form method="post">
    10 이상 100이하의 정수를 입력하시오: <input type="number" name="num">
    <input type="submit" value="선택">
</form>
<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['num'])) {
        $n = $_POST['num'];
        $data = array();

        for ($i = 0; $i < $n; $i++) {
        $data[$i] = rand(1, 100);
        }
        sort($data);
        echo implode(", ", $data) . "\n";
        }
    else {
        echo " ";
    }
?>
<form method="post">
    100이하의 정수를 입력하시오: <input type="number" name="num1">
    <input type="submit" value="선택">
</form>
<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['num1'])) {
        $n = $_POST['num1']; 

        function generateFibonacci($n) {
            $fib = [0, 1]; 
            for ($i = 2; $i < $n; $i++) {
                $fib[$i] = $fib[$i - 1] + $fib[$i - 2];
            }
            return $fib; 
        }

        $fibonacci = generateFibonacci($n);
        
        for ($i = 1; $i < count($fibonacci); $i++) {
            if ($i == 1) {
                echo "1 1 1<br>"; 
            } else {
                $ratio = $fibonacci[$i] / $fibonacci[$i - 1];
                echo ($i + 1) . " " . $fibonacci[$i] . " " . number_format($ratio, 6) . "<br>";
            }
        }
        if ($n > 1) {
            echo ($n + 1) . " " . $fibonacci[$n - 1] . "<br>";
        }
    } else {
        echo " ";
    }
?>

</body>
</html>
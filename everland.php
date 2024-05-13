// everland.php
<?php
$link = mysqli_connect("localhost", 'root', '', 'amusementpark');

if (!$link) {
    die("연결 실패: " . mysqli_connect_error());
}

$order = isset($_GET['order']) ? $_GET['order'] : null;
?>
<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <title>Everland</title>
    <style>
        .input-wrap {
            width: 960px;
            margin: 0 auto;
        }
        h1 { text-align: center; }
        th, td { text-align: center; }
        table {
            border: 1px solid #000;
            margin: 0 auto;
        }
        td, th {
            border: 1px solid #ccc;
        }
        a { text-decoration: none; }
    </style>
</head>
<body>
    <div class="input-wrap">
        <h1>Everland</h1>
        <form action="everland.php" method="POST">
            <label for="name">고객 성명:</label>
            <input type="text" id="name" name="name" required>
            <table>
                <thead>
                    <tr>
                        <th>NO</th>
                        <th>구분</th>
                        <th colspan="2">어린이</th>
                        <th colspan="2">어른</th>
                        <th>비고</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th>1</th>
                        <th>입장권</th>
                        <th>7000</th>
                        <td>
                            <select name="child">
                                <option value="0" selected>0</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                            </select>
                        </td>
                        <th>10000</th>
                        <td>
                            <select name="adult">
                                <option value="0" selected>0</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                            </select>
                        </td>
                        <td>입장</td>
                    </tr>
                    <tr>
                        <th>2</th>
                        <th>BIG3</th>
                        <th>12000</th>
                        <td>
                            <select name="child_BIG3">
                                <option value="0" selected>0</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                            </select>
                        </td>
                        <th>16000</th>
                        <td>
                            <select name="adult_BIG3">
                                <option value="0" selected>0</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                            </select>
                        </td>
                        <td>입장+놀이3종</td>
                    </tr>
                    <tr>
                        <th>3</th>
                        <th>자유이용권</th>
                        <th>21000</th>
                        <td>
                            <select name="child_free">
                                <option value="0" selected>0</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                            </select>
                        </td>
                        <th>26000</th>
                        <td>
                            <select name="adult_free">
                                <option value="0" selected>0</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                            </select>
                        </td>
                        <td>입장+놀이자유</td>
                    </tr>
                    <tr>
                        <th>4</th>
                        <th>연간이용권</th>
                        <th>70000</th>
                        <td>
                            <select name="child_year">
                                <option value="0" selected>0</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                            </select>
                        </td>
                        <th>90000</th>
                        <td>
                            <select name="adult_year">
                                <option value="0" selected>0</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                            </select>
                        </td>
                        <td>입장+놀이자유</td>
                    </tr>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="6">
                            <input type="submit" name="submit" value="합계">
                        </td>
                    </tr>
                </tfoot>
            </table>
        </form>
        <?php
        if (isset($_POST['submit'])) {
            $name = mysqli_real_escape_string($link, $_POST['name']);
            $child = (int)$_POST['child'];
            $adult = (int)$_POST['adult'];
            $child_BIG3 = (int)$_POST['child_BIG3'];
            $adult_BIG3 = (int)$_POST['adult_BIG3'];
            $child_free = (int)$_POST['child_free'];
            $adult_free = (int)$_POST['adult_free'];
            $child_year = (int)$_POST['child_year'];
            $adult_year = (int)$_POST['adult_year'];

            $total_price = ($child * 7000) + ($adult * 10000) + ($child_BIG3 * 12000) + ($adult_BIG3 * 16000) + ($child_free * 21000) + ($adult_free * 26000) + ($child_year * 70000) + ($adult_year * 90000);

            $sql = "INSERT INTO ticket (name, child, adult, child_BIG3, adult_BIG3, child_free, adult_free, child_year, adult_year) 
                    VALUES ('$name', $child, $adult, $child_BIG3, $adult_BIG3, $child_free, $adult_free, $child_year, $adult_year)";

            if (mysqli_query($link, $sql)) {
                $current_date = date("Y년 m월 d일 A h:i분");
                echo "$current_date<br>";
                echo htmlspecialchars($name) . " 고객님 감사합니다.<br>";
                if ($child > 0) echo "어린이 입장권 $child 매<br>";
                if ($child_BIG3 > 0) echo "어린이 BIG3 $child_BIG3 매<br>";
                if ($child_free > 0) echo "어린이 자유이용권 $child_free 매<br>";
                if ($child_year > 0) echo "어린이 연간이용권 $child_year 매<br>";
                if ($adult > 0) echo "어른 입장권 $adult 매<br>";
                if ($adult_BIG3 > 0) echo "어른 BIG3 $adult_BIG3 매<br>";
                if ($adult_free > 0) echo "어른 자유이용권 $adult_free 매<br>";
                if ($adult_year > 0) echo "어른 연간이용권 $adult_year 매<br>";
                echo "합계 " . number_format($total_price) . "원입니다.<br>";
            } else {
                echo "오류: " . mysqli_error($link);
            }
        }

        echo date("h:i:sa");
        ?>
    </div>
</body>
</html>

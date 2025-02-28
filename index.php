<?php
//연도를 완전한 네 자리 숫자로 표현함.	1999나 2003
$year = date('Y');
//월을 숫자로 표현함.	1부터 12
$month = date('n');
//날짜를 숫자로 표현함.	1부터 31
$day = date('j');
//파라미터값이 있으면 year, month, date 값 수정정
if(isset($_GET['year'])) {
    $year = $_GET['year'];
}
if(isset($_GET['month'])) {
    $month = $_GET['month'];
}
if(isset($_GET['date'])) {
    $date = $_GET['date'];
}
$time_now = date("Ynj");

//다음 년도,월 1더하기 
//전 년도,월 1 빼기
$next_year = $year + 1;
$prev_year = $year - 1;
$next_month = $month + 1;
$prev_month = $month - 1;

//만약에 12월이면 다음 월은 1월로 바뀜 
// 1월이면 전 월은 12월로 바뀜
if($month == 12) {
    $next_month = 1;
} else if ($month == 1) {
    $prev_month = 12;
}

//총 일수
$monthnum = date('t', mktime(0, 0, 0, $month, 1, $year));

//시작 요일 0(일요일)부터 6(토요일)
$start_day = date('w', mktime(0, 0, 0, $month, 1, $year));

//총 몇 주인지
$total_week = ceil(($monthnum + $start_day) / 7);

//마지막 요일 0(일요일)부터 6(토요일)
$end_day = date('w', mktime(0, 0, 0, $month, $monthnum, $year));

?>

<!DOCTYPE html>
<html>
    <head>
        <style>
            .red {
                color:red;
            }
            .blue {
                color:blue;
            }
            table{
                border:1px solid black;
                text-align: center;
            }
            tr{
                border:1px solid black;
            }
            td{
                border:1px solid black;
                width:50px;
            }
            .when{
                width:100px;
            }
            .today{
                font-weight: bold;
                color : #fff;
                background-color: #000;
            }
        </style>
        <title>calander</title>
        <meta charset="utf-8">
    </head>
    <body>
        <div class="container">
            <table>
                    <td><a href="<?php echo 'index.php?year='.$prev_year.'&month='.$month.'&day=1'; ?>">◀◀</a></td>
                    <td><a href="<?php echo 'index.php?year='.$year.'&month='.$prev_month.'&day=1'; ?>">◀</a></td>
                    <td colspan="3"><?php echo $year."년 ".$month."월"; ?></td>
                    <td><a href="<?php echo 'index.php?year='.$year.'&month='.$next_month.'&day=1'; ?>">▶</a></td>
                    <td><a href="<?php echo 'index.php?year='.$next_year.'&month='.$month.'&day=1'; ?>">▶▶</a></td>
                </tr>
                <tr>
                    <td>일</td>
                    <td>월</td>
                    <td>화</td>
                    <td>수</td>
                    <td>목</td>
                    <td>금</td>
                    <td>토</td>
                </tr>
                    <?php
                    $day = 1;
                        //반복문 사용해서 total_week만큼 tr만들기
                        for($i = 0; $i < $total_week; $i++) {
                            echo "<tr>";
                            //0은 일요일, 6은 토요일
                            //일 월 화 수 목 금 토 0~6 반복해서 $day출력
                            //0 일요일이면 빨간 글씨 6 토요일이면 파란 글씨
                            //class 배열을 생성해놓고 0일 때 red 적용, 6일 때 blue 적용, 오늘 날짜랑 같을 때 today 적용
                            for($j = 0; $j < 7; $j++) {
                                $class = array();
                                if($j == 0) {
                                    $class[] = "red";
                                }
                                if($j == 6) {
                                    $class[] = "blue";
                                }
                                if($time_now == $year.$month.$day) {
                                    $class[] = "today";
                                }

                                echo "<td class='" . implode(" ", $class) . "'>";

                                //첫 주이고 j값이 시작요일 보다 작을 때 또는  day값이 총 일수보다 크면 공백 출력
                                if(($i == 0 && $j < $start_day) || ($day > $monthnum)) {
                                    echo '&nbsp;';
                                }else {
                                    echo $day++;
                                // $day++;
                                }
                                echo '</td>';
                            }

                            echo "</tr>";
                        }?>
                        
                        
                    
            </table>
        </div>
    </body>
</html>

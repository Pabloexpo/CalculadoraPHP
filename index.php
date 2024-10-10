<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Project/PHP/PHPProject.php to edit this template
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Calculadora</title>
        <style>
            table{
                border-collapse: collapse; /*juntamos las celdas*/
            }
            input[type="button"]{
                padding:10px; /*ajuste de tamaño*/
                margin:0; /*eliminamos margenes*/
                width: 100%;
            }
            input[type="submit"]{
                padding:10px; /*ajuste de tamaño*/
                margin:0; /*eliminamos margenes*/
                width: 100%;
            }
            #rdo{
                text-align: right; /*alineado a la derecha*/
            }
            button[type="submit"]{
                padding:10px;
                margin:0;
                width: 100%;
            }

        </style>
    </head>
    <body>
        <?php
        $rdo = isset($_POST['rdo']) ? $_POST['rdo'] : 0;
        $num = isset($_POST['num']) ? $_POST['num'] : '';
        $op = isset($_POST['op']) ? $_POST['op'] : '';
        $num2 = isset($_POST['num2']) ? $_POST['num2'] : 0;
        $op2 = isset($_POST['op2']) ? $_POST['op2'] : '';
        $igualDes=true; 
        if ($num!==''){
            $igualDes=false; 
        }
        if ($op === "C") {
            $rdo = 0;
            $num2 = 0;
            $op2 = '';
        } elseif ($op === "=") {
            switch ($op2) {
                case '+':
                    $rdo = $num2 + $rdo;
                    break;
                case '-':
                    $rdo = $num2 - $rdo;
                    break;
                case 'X':
                    $rdo = $num2 * $rdo;
                    break;
                case '/':
                    if ($rdo != 0) {
                        $rdo = $num2 / $rdo;
                    } else {
                        $rdo = 'Error División por 0';
                    }
                    break;
            }
            //reseteamos num2 y op2 después de la operación
            $num2 = 0;
            $op2 = '';
        } elseif ($op != '') { //cuando damos a un + por ejemplo
            $op2 = $op;
            $num2 = $rdo;
            $rdo = '';
        } else {
            $rdo .= $num;
        }
        ?>
    <center>
        <form action="" method="post">
            <table border="1">
                <tr>
                    <td colspan="4">
                        <input type="text" id="rdo" name="rdo" value="<?php echo $rdo; ?>" disabled>
                        <input type="hidden" name="rdo" value="<?php echo $rdo; ?>">                
                    </td>
                    
                </tr>
                <tr>
                    <td><button type="submit" name="num" value="7">7</button></td>
                    <td><button type="submit" name="num" value="8">8</button></td>
                    <td><button type="submit" name="num" value="9">9</button></td>
                    <td><button type="submit" name="op" value="+">+</button></td>
                </tr>
                <tr>
                    <td><button type="submit" name="num" value="4">4</button></td>
                    <td><button type="submit" name="num" value="5">5</button></td>
                    <td><button type="submit" name="num" value="6">6</button></td>
                    <td><button type="submit" name="op" value="-">-</button></td>
                </tr>
                <tr>
                    <td><button type="submit" name="num" value="1">1</button></td>
                    <td><button type="submit" name="num" value="2">2</button></td>
                    <td><button type="submit" name="num" value="3">3</button></td>
                    <td><button type="submit" name="op" value="X">X</button></td>
                </tr>
                <tr>
                    <td><button type="submit" name="num" value="0">0</button></td>
                    <td><button type="submit" name="op" value="C">C</button></td>
                    <td>
                        <button type="submit" name="op" value="=" <?php echo $igualDes ? 'disabled' : ''; ?>>=</button>                    
                    </td>
                    <td><button type="submit" name="op" value="/">/</button></td>
                </tr>  
                <input type="hidden" name="num2" value="<?php echo $num2; ?>">
                <input type="hidden" name="op2" value="<?php echo $op2; ?>">

            </table>
        </form>
    </center>

    </body>
</html>

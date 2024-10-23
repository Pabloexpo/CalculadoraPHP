<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Project/PHP/PHPProject.php to edit this template
-->
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>Calculadora</title>
        <style>
            body{
                display:flex;
                flex-direction: column;
                justify-content: center;
                align-items: center;
                align-content: center;
                background-color: lightcyan;
                height: 700px



            }
            main{
                align-items: center;
                background-color: white;
                border-radius: 20px;
            }

            table{
                border-collapse: collapse; /*juntamos las celdas*/


            }

            input[type="button"]{
                padding:100px; /*ajuste de tamaño*/
                margin:0; /*eliminamos margenes*/
                width: 100%;
            }
            input[type="submit"]{
                padding:100px; /*ajuste de tamaño*/
                margin:0; /*eliminamos margenes*/
                width: 100%;
                height: 100%;
                
            }
            #rdo{
                text-align: right; /*alineado a la derecha*/
                width: 94.5%;
                padding: 10px;
                font-size: xx-large;
                font-family: monospace;
                border-radius: 10px;
            }
            button[type="submit"]{
                padding:40px;
                margin:0;
                width: 100%;
                font-size: xx-large;
                font-family: monospace;
            }
            .seleccion{
                background-color: #d3d3d3;
            }



        </style>
    </head>
    <body>
        <?php
//        operadores ternarios para establecer el valor de las variables recogidas en
//        el formulario
        $rdo = isset($_POST['rdo']) ? $_POST['rdo'] : 0;
        $num = isset($_POST['num']) ? $_POST['num'] : '';
        $op = isset($_POST['op']) ? $_POST['op'] : '';
        $num2 = isset($_POST['num2']) ? $_POST['num2'] : 0;
        $op2 = isset($_POST['op2']) ? $_POST['op2'] : '';
        $igualDes = true;
        $opDes = false;
        $numDes = false;
//        utilizamos estos 3 booleanos para cuando estemos en el codigo html, 
//        podamos utilizar un operador ternario para que, cuando pulsemos un 
//        determinado botón, se nos deshabilite o no una celda
        if ($num !== '' && $rdo == 0) {
            $rdo = ''; //borramos el valor 0 de la pantalla al pulsar un botón
        }

        if ($op === "C") {
//            si pulsamos C se nos borrará todo, tanto lo almacenado en num2 que 
//            sería lo ya almacenado como primer operador como rdo que es lo 
//            almacenado en el segundo número
            $rdo = 0;
            $num2 = 0;
            $op2 = '';
        } elseif ($op === "=") {
            switch ($op2) {
//                realizamos las operaciones pertinentes 
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
            $numDes = true;
            $igualDes = true;
            $opDes = true;
            //reseteamos num2 y op2 después de la operación para volver a operar
            $num2 = 0;
            $op2 = '';
        } elseif ($op != '') { //cuando damos a un + por ejemplo
//           recogemos el valor de lo introducido en num2 y reseteamos 
//            el resultado para introducir un nuevo valor
            $opDes = true;
            $igualDes = false;
            $op2 = $op;
            $num2 = $rdo; //la variable oculta de num2 pasará a ser el resultado que hemos insertado como PRIMER NÚMERO
            $rdo = 0;
        } else {
//            recogemos lo introducido de primeras en rdo o en el segundo numero
            if (strlen($rdo) <= 9) { // Verificamos si $rdo tiene menos de 10 dígitos
                $rdo .= $num;
                if ($op2 != '') { //habilitamos el = si introducimos valor una vez recogido el operador
                    $igualDes = false;
                    $opDes = true;
                }

                if (strlen($rdo) == 9 && $op2 != '') {
                    $numDes = true; //bloqueamos que no se incluyan más numeros en el segundo operador
                }
            }
        }
        ?>
        <main>



            <form action="" method="post">
                <table>
                    <tr>
                        <td colspan="4">
                            <input type="text" id="rdo" name="rdo" value="<?php echo $rdo; ?>" disabled>

                            <!--                    utilizamos una caja oculta llamada igual para almacenar lo mismo que vayamos escribiendo en 
                                                    la casilla del resultado, que será nuestra "pantalla"-->
                            <input type="hidden" name="rdo" value="<?php echo $rdo; ?>">

                        </td>

                    </tr>
                    <tr>
                        <td><button type="submit" name="num" value="7" <?php echo $numDes ? 'disabled' : ''; ?>>7</button></td>
                        <td><button type="submit" name="num" value="8" <?php echo $numDes ? 'disabled' : ''; ?>>8</button></td>
                        <td><button type="submit" name="num" value="9" <?php echo $numDes ? 'disabled' : ''; ?>>9</button></td>
                        <td><button type="submit" name="op" value="+" class="<?php echo ($op2 == '+' && $rdo != '') ? 'seleccion' : ''; ?>" <?php echo $opDes ? 'disabled' : ''; ?>>+</button></td>
                        <!--                    utilizamos un ternario para establecer si pintamos el botón más oscuro y para deshabilitarlo con dos ternarios diferentes-->
                    </tr>
                    <tr>
                        <td><button type="submit" name="num" value="4"  <?php echo $numDes ? 'disabled' : ''; ?>>4</button></td>
                        <td><button type="submit" name="num" value="5" <?php echo $numDes ? 'disabled' : ''; ?>>5</button></td>
                        <td><button type="submit" name="num" value="6" <?php echo $numDes ? 'disabled' : ''; ?>>6</button></td>
                        <td><button type="submit" name="op" value="-" class="<?php echo ($op2 == '-' && $rdo != '') ? 'seleccion' : ''; ?>" <?php echo $opDes ? 'disabled' : ''; ?>>-</button></td>
                    </tr>
                    <tr>
                        <td><button type="submit" name="num" value="1" <?php echo $numDes ? 'disabled' : ''; ?>>1</button></td>
                        <td><button type="submit" name="num" value="2" <?php echo $numDes ? 'disabled' : ''; ?>>2</button></td>
                        <td><button type="submit" name="num" value="3"<?php echo $numDes ? 'disabled' : ''; ?>>3</button></td>
                        <td><button type="submit" name="op" value="X" class="<?php echo ($op2 == 'X' && $rdo != '') ? 'seleccion' : ''; ?>" <?php echo $opDes ? 'disabled' : ''; ?>>X</button></td>
                    </tr>
                    <tr>
                        <td><button type="submit" name="num" value="0"<?php echo $numDes ? 'disabled' : ''; ?>>0</button></td>
                        <td><button type="submit" name="op" value="C">C</button></td>
                        <td>
                            <button type="submit" name="op" value="=" class="<?php echo ($op == '=') ? 'seleccion' : ''; ?>" <?php echo $igualDes ? 'disabled' : ''; ?>>=</button>                    
                        </td>
                        <td><button type="submit" name="op" value="/" class="<?php echo ($op2 == '/') && $rdo != '' ? 'seleccion' : ''; ?>" <?php echo $opDes ? 'disabled' : ''; ?>>/</button></td>
                    </tr>  

                    <!--            hidden dedicados a guardar el primer número que insertemos en 
                                    resultado($rdo) y la operacion (que será $op)-->
                    <input type="hidden" name="num2" value="<?php echo $num2; ?>">
                    <input type="hidden" name="op2" value="<?php echo $op2; ?>">

                </table>
            </form>
        </main>

    </body>
</html>
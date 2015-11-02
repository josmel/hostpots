<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of JuegoDeVida
 *
 * @author noel
 */
class JuegoDeVida {

    public function Vida() {
        $valor [0] [0] = 1;
        $valor [0] [1] = 1;
        $valor [0] [2] = 0;
        $valor [0] [3] = 0;
        $valor [0] [4] = 1;
        $valor [0] [5] = 1;
        $valor [1] [0] = 1;
        $valor [1] [1] = 0;
        $valor [1] [2] = 1;
        $valor [1] [3] = 0;
        $valor [1] [4] = 1;
        $valor [1] [5] = 1;
        $valor [2] [0] = 1;
        $valor [2] [1] = 1;
        $valor [2] [2] = 0;
        $valor [2] [3] = 0;
        $valor [2] [4] = 1;
        $valor [2] [5] = 0;
        $valor [3] [0] = 0;
        $valor [3] [1] = 0;
        $valor [3] [2] = 0;
        $valor [3] [3] = 0;
        $valor [3] [4] = 0;
        $valor [3] [5] = 1;
        $valor [4] [0] = 1;
        $valor [4] [1] = 0;
        $valor [4] [2] = 0;
        $valor [4] [3] = 0;
        $valor [4] [4] = 0;
        $valor [4] [5] = 1;
        $valor [5] [0] = 1;
        $valor [5] [1] = 0;
        $valor [5] [2] = 0;
        $valor [5] [3] = 0;
        $valor [5] [4] = 0;
        $valor [5] [5] = 0;



//         echo '<br/><br/><br/><br/><br/><br/><br/><br/>';
        foreach ($valor as $key => $value) {

            foreach ($value as $ye) {
                echo $ye . ' ';
            }
            echo '<br/>';
        }

        foreach ($valor as $key => $value) {
            foreach ($value as $key2 => $ye) {
                if (($key - 1) < 0) {
                    if (($key2 - 1) < 0) {
                        $suma = $valor[$key + 1][$key2] + $valor[$key + 1][$key2 + 1] + $valor[$key][$key2 + 1];
                    } elseif (($key2 + 1) > 5) {
                        $suma = $valor[$key][$key2 - 1] + $valor[$key + 1][$key2 - 1] + $valor[$key + 1][$key2];
                    } else {
                        $suma = $valor[$key][$key2 - 1] + $valor[$key + 1][$key2 - 1] + $valor[$key + 1][$key2] +
                                $valor[$key + 1][$key2 + 1] + $valor[$key][$key2 + 1];
                    }
                } elseif (($key + 1) > 5) {
                    if (($key2 - 1) < 0) {
                        $suma = $valor[4][0] + $valor[4][1] + $valor[5][1];
                    } elseif (($key2 + 1) > 5) {
                        $suma = $valor[4][4] + $valor[4][5] + $valor[5][4];
                    } else {
                        $suma = $valor[5][$key2 - 1] + $valor[4][$key2 - 1] + $valor[4][$key2] +
                                $valor[4][$key2 + 1] + $valor[5][$key2 + 1];
                    }
                } else {
                    if (($key2 - 1) < 0) {
                        $suma = $valor[$key - 1][0] + $valor[$key - 1][1] + $valor[$key][1] + $valor[$key + 1][0] + $valor[$key + 1][1];
                    } elseif (($key2 + 1) > 5) {
                        $suma = $valor[$key - 1][4] + $valor[$key - 1][5] + $valor[$key][4] + $valor[$key + 1][4] + $valor[$key + 1][5];
                    } else {
                        $suma = $valor[$key - 1][$key2 - 1] + $valor[$key - 1][$key2] + $valor[$key - 1][$key2 + 1] +
                                $valor[$key][$key2 - 1] + $valor[$key][$key2 + 1] + $valor[$key + 1][$key2 - 1] + $valor[$key + 1][$key2] + $valor[$key - 1][$key2 + 1];
                    }
                }

                $valorFinal = $this->x($suma, $ye);
                $valor[$key][$key2] = $valorFinal;
            }
        }

        echo '<br/>';

        foreach ($valor as $key => $value) {

            foreach ($value as $ye) {
                echo $ye . ' ';
            }
            echo '<br/>';
        }
        exit;
    }

    public function x($suma, $igual) {
        if ($suma < 2) {
            $position = 0;
        } elseif ($suma == 3) {
            $position = 1;
        } elseif ($suma > 3) {
            $position = 0;
        } else {
            $position = $igual;
        }
        return $position;
    }

}

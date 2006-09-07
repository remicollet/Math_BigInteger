<?
// $Id$
// Example of how to use of Math_BigInteger.  The output can be compared to the output that the BCMath functions would yield.

if ( !function_exists('bcpowmod') ) {
    function bcpowmod($x,$y,$z) {
        $result = 1;
        while ( bccomp($y,0) > 0) {
            if ( bcmod($y,2) ) {
                $result = bcmod(bcmul($result, $x), $z);
            }
            $x = bcmod(bcmul($x, $x), $z);
            $y = bcdiv($y, 2);
        }
        return $result;
    }
}

include('../Math_BigInteger.php');

$x = mt_rand(1,10000000);
$y = mt_rand(1,10000000);
$z = mt_rand(1,10000000);

$_x = new Math_BigInteger($x);
$_y = new Math_BigInteger($y);
$_z = new Math_BigInteger($z);

echo "\$x = $x;\r\n";
echo "\$y = $y;\r\n";
echo "\$z = $z;\r\n";

echo "\r\n";

$result = bcadd($x,$y);
$_result = $_x->add($_y);

echo "\$result = \$x+\$y;\r\n";
echo "$result\r\n";
echo $_result->toString();
echo "\r\n\r\n";

$result = bcsub($result,$y);
$_result = $_result->subtract($_y);

echo "\$result = \$result-\$y;\r\n";
echo "$result\r\n";
echo $_result->toString();
echo "\r\n\r\n";

$result = bcdiv($x,$y);
list($_result,) = $_x->divide($_y);

echo "\$result = \$x/\$y;\r\n";
echo "$result\r\n";
echo $_result->toString();
echo "\r\n\r\n";

$result = bcmod($y,$z);
list(,$_result) = $_y->divide($_z);

echo "\$result = \$x%\$y;\r\n";
echo "$result\r\n";
echo $_result->toString();
echo "\r\n\r\n";

$result = bcmul($x,$z);
$_result = $_x->multiply($_z);

echo "\$result = \$x*\$z;\r\n";
echo "$result\r\n";
echo $_result->toString();
echo "\r\n\r\n";

$result = bcpowmod($x,$y,$result);
$_result = $_x->modPow($_y,$_result);

echo "\$result = (\$x**\$y)%\$result;\r\n";
echo "$result\r\n";
echo $_result->toString();
echo "\r\n\r\n";

// modInverse isn't demo'd because no equivalent to it exists in BCMath.

?>
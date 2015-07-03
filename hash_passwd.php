<?php

$cryptpw= generateHash("hashthis");
$verifypw= verify("hashthis", $cryptpw);

//echo $cryptpw;
if ($verifypw) {
echo $verifypw;
}

function generateHash($password) {
    if (defined("CRYPT_BLOWFISH") && CRYPT_BLOWFISH) {
        $salt = '$2y$15$' . substr(md5(uniqid(rand(), true)), 0, 22);
        return crypt($password, $salt);
		
    }
}

function verify($password, $hashedPassword) {
       return crypt($password, $hashedPassword) == $hashedPassword;
}

?>
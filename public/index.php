<?php

require_once "../Generator/NumberGenerator.php";

$generatedNumber = new NumberGenerator();
echo sprintf("Сгенерированный набор цифр: %s", $generatedNumber->generate());



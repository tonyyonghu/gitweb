<?php
function smarty_modifier_truncn ($string,$len=80) {
    return mb_substr($string,0,$len,'UTF-8');
}


<?php
function kg($hasher,$randstr)
{
return hash($hasher,$randstr);
}
echo kg("sha256","rdmM4drasahK3r3n");
?>

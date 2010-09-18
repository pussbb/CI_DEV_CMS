<?php

// Echo the image - timestamp appended to prevent caching
echo '<a href="" onclick="refreshimg(); return false;" title="Click to refresh image"><img src="/system/captcha/images/image.php?' . time() . '" width="132" height="46" alt="Captcha image" /></a>';

?>
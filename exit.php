<?php
session_start();
error_reporting(-1);
session_destroy();

echo '
<script>
delete localStorage.test;
delete localStorage.reg_remove;
location.replace("sign_in.php");
</script>
';
?>
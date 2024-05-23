<?php
session_start();
ob_start();
session_destroy();
header("Location:https://loopscards.com/?login=cikisyapildi");
ob_end_flush();

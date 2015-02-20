<?php

// admin access
session_start();
echo $_SESSION['uid'] == 1 ? "admin access" : "non-admin access";


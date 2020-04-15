<?php
if ($_GET['page']=='login') {
  echo "log in now";
} else if ($_GET['page']=='register'){
  echo "register now";
} elseif ($_SESSION) {
  // check if they are already logged in
}
else {
  echo "Return to home page";
}

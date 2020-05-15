  <?php

$swimmerIdentity = $swim->getSwimmerProfileDetails(trim($_GET['id']));
//Determine if user is minor
$adultAged = strtotime("-18 years", time());
$adultAged = date("Y-m-d", $adultAged);

//variable used to track access to editing this users data
$authorized = false;
//These are conditions for being permitted to edit. Only parents, admin, or adults can edit profiles
if ($_SESSION['id'] != $_GET['id']) {
  $parentCheck = $swim->isSwimmerParent($_SESSION['id'],$_GET['id']);
  if ($parentCheck == true) {
    $authorized = true;
  }
}

if ($swimmerIdentity->DOB < $adultAged && $_SESSION['id']==$_GET['id']) { //need to add amdmin authorization to change
  $authorized = true;
}
 ?>

<h1>User Info</h1>
<table>
  <tr>
    <td>First Name</td>
    <td><?php echo $swimmerIdentity->fname; ?></td>
  </tr>
  <tr>
    <td>Surname</td>
    <td><?php echo $swimmerIdentity->sname; ?></td>
  </tr>
  <tr>
    <td>DOB</td>
    <td><?php echo $swimmerIdentity->DOB ?></td>
  </tr>
  <tr>
    <td>Address</td>
    <td><?php echo $swimmerIdentity->address ?></td>
  </tr>
  <tr>
    <td>Post Code</td>
    <td><?php echo $swimmerIdentity->post ?></td>
  </tr>
  <tr>
    <td>email</td>
    <td><?php echo $swimmerIdentity->email ?></td>
  </tr>
  <tr>
    <td>phone</td>
    <td><?php echo $swimmerIdentity->phone ?></td>
  </tr>
</table>
<?php if ($authorized == true): ?>

  <fieldset>
    <h3>Update User Info:</h3>
    <form class="" action="" method="post">
      <input type='text' name='firstName' value='<?php echo $swimmerIdentity->fname; ?>'>
      <input type='text' name='surname' value='<?php echo $swimmerIdentity->sname; ?>'>
      <input type= 'email' name='email' value='<?php echo $swimmerIdentity->email; ?>'>
      <input type='text' name='address' value='<?php echo $swimmerIdentity->address; ?>'>
      <input type='text' name='postalCode' value='<?php echo $swimmerIdentity->post; ?>'>
      <input type='tel' name='phone' value='<?php echo $swimmerIdentity->phone; ?>'>
      <input type="hidden" name="userID" value="<?php echo $swimmerIdentity->uid; ?>">
      <input type="submit" name="updateUserInfo" value="updateUserInfo">
    </form>
  </fieldset>
<?php endif; ?>

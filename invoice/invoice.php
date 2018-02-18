<?php
include_once __DIR__.'/../config.php';

if(isset($_GET['page'])){
$page = $_GET['page'];
}else{
$page = 1;
}

if(isset($_POST['btn-postadd'])){
$title = trim($_POST['title']);
$text = trim($_POST['text']);
$item = trim($_POST['item']);
$quantity = trim($_POST['quantity']);
$price = trim($_POST['price']);
$totalPrice = $quantity * $price;
$author = $_SESSION['activeuser'];
$image = $_FILES['image']['name'];
$image = "/images/$image";
move_uploaded_file($_FILES['image']['tmp_name'],$image);
$invoice->AddPost($title,$text,$author,$image,$item,$quantity,$price,$totalPrice);
header('location:invoice.php');
}

?>
<html>
<head>
<?php $template->bootstrap(); ?>
</head>
<body>

<nav class="navbar navbar-default navbar-static-top">
<div class="container-fluid">
<?php $template->menu(); ?>
</div>
</nav>

<h3>Add Invoice</h3>
<div class="form">
<form method="post" enctype="multipart/form-data">
Image: <input type="file" name="image"><br>
Title: <input type="text" name="title"><br>
Text: <input type="text" name="text"><br>
Item: <input type="text" name="item"><br>
Price: <input type="text" name="price"><br>
Quantity: <input type="text" name="quantity"><br>
<button type="submit" name="btn-postadd">Submit</button>
</form>
</div>

<div class="container">

<div class="post-list">
  <table>
    <tr>
      <th>Invoice Name</th>
      <th>Item</th>
      <th>Amount</th>
      <th>Item</th>
      <th>Amount</th>
    </tr>
<?php
$list = $invoice->ViewPosts($page);
while($postRow = $list->fetch(PDO::FETCH_ASSOC)){
?>
<!--
<h3>
  <a href="detail.php?id=<?php echo $postRow['id']; ?>">
    <?php echo $postRow['title']; ?>
  </a>
</h3></br>
<h3>
  <?php echo $postRow['text']; ?>
</h3></br>
-->
  <tr>
  <?php
    $item = $invoice->ViewInvoiceItemDetail($postRow['id']);
    $amount = 0;
    $onlyOnceCategory = "";
    while($itemRow = $item->fetch(PDO::FETCH_ASSOC)){
      ?>
        <td>
          <a href="detail.php?id=<?php echo $postRow['id']; ?>">
            <?php

            if($onlyOnceCategory == ""){
              echo $postRow['title'];
              $onlyOnceCategory = $postRow['title'];
            }else{
              $onlyOnceCategory = "";
              echo $onlyOnceCategory;
            }
            ?>
          </a>
        </td>
        <td><?php echo $itemRow['item']; ?></td>
        <td><?php echo $itemRow['quantity']; ?></td>
        <td><?php echo $itemRow['price']; ?></td>
        <td><?php echo $itemRow['total_price']; ?></td>
        <?php $amount = $amount+$itemRow['total_price']; ?>
      </tr>

    <?php
  }
  ?>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td><?php echo $amount; ?></td>

</br>
<?php } ?>
  </table>
</div>

<?php $template->SpecialPagination("invoice"); ?>

</div>

</body>
<?php $template->bootstrap_footer(); ?>
</html>

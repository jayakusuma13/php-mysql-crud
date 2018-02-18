<?php
include_once'../config.php';
$id = $_GET['id'];

if(isset($_POST['addtocart'])){
$cart->additem($id);

}

//$cart->showitems();

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

<div class="container">

<div class="post-list">
<?php
$list = $invoice->ViewPostsDetail($id);
$item = $invoice->ViewInvoiceItemDetail($id);
while($postRow = $list->fetch(PDO::FETCH_ASSOC)){
?>
<h3><a href="detail.php?id=<?php echo $postRow['id']; ?>"><?php echo $postRow['title']; ?></a></h3></br>
<img src='<?php echo $postRow['image']; ?>'>
<h3><?php echo $postRow['text']; ?></h3></br>
<?php
    ?>
    <table>
    <tr>
      <th>Item</th>
      <th>Quantity</th>
      <th>Price/Item</th>
      <th>Total Price</th>
    </tr>
    <?php
    $amount = 0;
  while($itemRow = $item->fetch(PDO::FETCH_ASSOC)){
    ?>
      <tr>
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
        <td><?php echo $amount; ?></td>
      </table>

<form method="post">
<button type="submit" name="edit"><a href="edit.php?id=<?php echo $postRow['id']; ?>">Edit</a></button>

<button type="submit" name="delete"><a href="delete.php?id=<?php echo $postRow['id']; ?>">Delete</a></button>

</form>
<?php } ?>


</div>

</div>

</body>
<?php $template->bootstrap_footer(); ?>
</html>

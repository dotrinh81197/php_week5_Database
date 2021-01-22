<h2>Danh sách chi tiết Sản phẩm</h2>
<a href="./index.php?page=add">Thêm mới</a>
<table class="table">
    <thead>
        <tr>
            <th>Name</th>
            <th>Price</th>
            <th>Description</th>
            <th>Producer</th>
        </tr>
    </thead>
    <tbody>

        <tr>
            <td><?php echo $product->name ?></td>
            <td><?php echo $product->price ?></td>
            <td><?php echo $product->description ?>
            <td><?php echo $product->producer ?>

            <td><a href="./index.php?page=edit&id=<?php echo ($product->id) ?>">Edit</a></td>


    </tbody>
</table>
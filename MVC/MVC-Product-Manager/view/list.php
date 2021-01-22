<h2>Danh sách Sản phẩm</h2>
<a href="./index.php?page=add">Thêm mới</a>

<table class="table">
    <thead>
        <tr>
            <th>STT</th>
            <th>Name</th>
            <th>Price</th>
            <th>Description</th>
            <th>Producer</th>
        </tr>
    </thead>
    <tbody>

        <?php foreach ($products as $key => $product) : ?>
            <tr>
                <td><?php echo ++$key ?></td>
                <td><?php echo $product->name ?></td>
                <td><?php echo $product->price ?></td>
                <td><?php echo $product->description ?>
                <td><?php echo $product->producer ?>

                <td><a href="./index.php?page=edit&id=<?php echo ($product->id) ?>">Edit</a></td>
                <td><a href="./index.php?page=delete&id=<?php echo $product->id ?>">Delete</a></td>
                <td><a href="./index.php?page=detail&id=<?php echo $product->id ?>">Detail</a></td>

            <?php endforeach; ?>
    </tbody>
</table>
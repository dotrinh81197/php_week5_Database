<?php
if (isset($message)) {
    echo "<p class='alert-info'>$message</p>";
}
?>

<div class="col-12 col-md-12">
    <div class="row">
        <div class="col-12">
            <h1>Cập nhật sản phẩm</h1>
        </div>
        <div class="col-12">
            <form method="post">
                <div class="form-group">
                    <label>Tên sản phẩm</label>
                    <input type="text" value="<?php echo $product->name ?>" class="form-control" name="name" required>
                </div>
                <div class="form-group">
                    <label>Đơn giá</label>
                    <input type="number" value="<?php echo $product->price ?>" class="form-control" name="price" required>
                </div>
                <div class="form-group">
                    <label>Mô tả sản phẩm</label>
                    <input type="text" value="<?php echo $product->description ?>" class="form-control" name="description" required>
                </div>
                <div class="form-group">
                    <label>Nhà sản xuất</label>
                    <input type="text" value="<?php echo $product->producer ?>" class="form-control" name="producer" required>
                </div>
                <button type="submit" class="btn btn-primary">Cập nhật</button>
                <button class="btn btn-secondary" onclick="window.history.go(-1); return false;">Hủy</button>
            </form>
        </div>
    </div>
</div>
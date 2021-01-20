<?php
if(isset($message)){
  echo "<p class='alert-info'>$message</p>";
}
?>

<div class="col-12 col-md-12">
  <div class="row">
      <div class="col-12">
          <h1>Cập nhật khách hàng</h1>
      </div>
      <div class="col-12">
          <form method="post">
              <div class="form-group">
                  <label>Tên khách hàng</label>
                  <input type="text" value="<?php echo $customer->name ?>" class="form-control" name="name"  placeholder="Nhập tên" required>
              </div>
              <div class="form-group">
                  <label>Email</label>
                  <input type="email" value="<?php echo $customer->email ?>" class="form-control" name="email" placeholder="Nhập mail" required>
              </div>
              <div class="form-group">
                  <label>Địa chỉ</label>
                  <input type="text" value="<?php echo $customer->address ?>"  class="form-control" name="address" placeholder="Nhập địa chỉ" required>
              </div>
              <button type="submit" class="btn btn-primary">Cập nhật</button>
              <button class="btn btn-secondary" onclick="window.history.go(-1); return false;">Hủy</button>
          </form>       
     </div>   
   </div> 
</div> 
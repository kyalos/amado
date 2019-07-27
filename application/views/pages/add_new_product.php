
            <!-- MAIN CONTENT-->
            <div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-header">
                                        <strong>Company</strong>
                                        <small> Form</small>
                                    </div>
                                    <?php if ($this->session->flashdata('success')): ?>
                                                    <div class="alert alert-success block-inner">
                                                        <button type="button" class="close" data-dismiss="alert">×</button>
                                                        <?php echo $this->session->flashdata('success'); ?>
                                                    </div>                                    
                                                    <div class="clearfix"></div>
                                                    <br>
                                                <?php endif; ?>

                                                <?php if ($this->session->flashdata('error')): ?>
                                                    <div class="alert alert-danger block-inner">
                                                        <button type="button" class="close" data-dismiss="alert">×</button>
                                                        <?php echo $this->session->flashdata('error'); ?>
                                                    </div>                                    
                                                    <div class="clearfix"></div>
                                                    <br>
                                                <?php endif; ?>
                                                <?php if ($this->session->flashdata('warning')): ?>
                                                    <div class="alert alert-warning block-inner">
                                                        <button type="button" class="close" data-dismiss="alert">×</button>
                                                        <?php echo $this->session->flashdata('warning'); ?>
                                                    </div>                                    
                                                    <div class="clearfix"></div>
                                                    <br>
                                                <?php endif; ?> 
                                    <?php echo form_open_multipart('admin/create');?>
                                    <div class="card-body card-block">
                                        <div class="form-group">
                                            <label for="company" class=" form-control-label">Product firstname</label>
                                            <input type="text" id="company" placeholder="Enter Product firstname" name="product_firstname" class="form-control" required >
                                        </div>
                                        <div class="form-group">
                                            <label for="vat" class=" form-control-label">Product secondname</label>
                                            <input type="text" id="vat" placeholder="Enter Product lastname" name="product_lastname" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="street" class=" form-control-label">Description</label>
                                            <input type="text" id="street" placeholder="Enter Product description" name="description" class="form-control" required>
                                        </div>
                                        <div class="row form-group">
                                            <div class="col-8">
                                                <div class="form-group">
                                                    <label for="city" class=" form-control-label">Company</label>
                                                    <input type="text" id="city" placeholder="Enter Company" name="company" class="form-control" required>
                                                </div>
                                            </div>
                                            <div class="col-8">
                                                <div class="form-group">
                                                    <label for="postal-code" class=" form-control-label">In stock</label>
                                                    
                                                    <select class="form-control" name="in_stock">
                                                        <option value="1">Yes</option>
                                                         <option value="0">No</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="country" class=" form-control-label">Price</label>
                                            <input type="text" id="country" placeholder="Enter Price" name="price" class="form-control" required>
                                        </div>

                                        <div class="form-group">
                                            <label for="country" class=" form-control-label">Quantity</label>
                                            <input type="text" id="country" placeholder="Enter Quantity" name="quantity" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                                    <label for="postal-code" class=" form-control-label">Shop</label>
                                                    
                                                    <select class="form-control" name="shop">
                                                        <?php foreach ($shops as $row): ?>
                                                        <option value="<?php echo $row->shop_id; ?>"><?php echo $row->shop_name; ?></option>
                                                    <?php endforeach; ?>
                                                    </select>
                                                </div>

                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="file-input" class=" form-control-label">Product image</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <input type="file" id="file-input" name="image_1" class="form-control-file" required>
                                                </div>
                                            </div>

                                        <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block" onclick="updateTable()">
                                                    <span id="payment-button-amount">Submit</span>
                                                    <span id="payment-button-sending" style="display:none;">Uploading…</span>

                                                </button>
                                    </div>
                                </form>
                                </div>
                            </div>
                            
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="copyright">
                                    <p>Copyright © 2018 Colorlib. All rights reserved. Template by <a href="https://colorlib.com">Colorlib</a>.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

     <script type="text/javascript">
        
        function updateTable()
        {
            window.location.href = "<?php echo site_url('admin/add_new_product');?>";
        }
     </script>
    
    
    
    <!-- Jquery JS-->
    <script src="<?php echo base_url(); ?>assets/admin/vendor/jquery-3.2.1.min.js"></script>
    <!-- Bootstrap JS-->
    <script src="<?php echo base_url(); ?>assets/admin/vendor/bootstrap-4.1/popper.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/admin/vendor/bootstrap-4.1/bootstrap.min.js"></script>
    <!-- Vendor JS       -->
    <script src="<?php echo base_url(); ?>assets/admin/vendor/slick/slick.min.js">
    </script>
    <script src="<?php echo base_url(); ?>assets/admin/vendor/wow/wow.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/admin/vendor/animsition/animsition.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/admin/vendor/bootstrap-progressbar/bootstrap-progressbar.min.js">
    </script>
    <script src="<?php echo base_url(); ?>assets/admin/vendor/counter-up/jquery.waypoints.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/admin/vendor/counter-up/jquery.counterup.min.js">
    </script>
    <script src="<?php echo base_url(); ?>assets/admin/vendor/circle-progress/circle-progress.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/admin/vendor/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="<?php echo base_url(); ?>assets/admin/vendor/chartjs/Chart.bundle.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/admin/vendor/select2/select2.min.js">
    </script>

    <!-- Main JS-->
    <script src="<?php echo base_url(); ?>assets/admin/js/main.js"></script>

</body>

</html>
<!-- end document-->

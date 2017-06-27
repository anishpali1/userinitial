<?php
$this->title = 'Dashboard';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="admin-default-index">
    <div class="row">
        
        
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <!-- Apply any bg-* class to to the icon to color it -->
                    <span class="info-box-icon bg-teal"><i class="fa fa-star-o"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Users</span>
                        <span class="info-box-number"><?= $customerCount ?></span>
                    </div><!-- /.info-box-content -->
                </div><!-- /.info-box -->
        </div>       
        
        
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <!-- Apply any bg-* class to to the icon to color it -->
                    <span class="info-box-icon bg-blue"><i class="fa fa-star-o"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Accessed Codes</span>
                        <span class="info-box-number"><?= $accessedCodes ?></span>
                    </div><!-- /.info-box-content -->
                </div><!-- /.info-box -->
        </div>
        
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <!-- Apply any bg-* class to to the icon to color it -->
                    <span class="info-box-icon bg-yellow" ><i class="fa fa-star-o"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Test</span>
                        <span class="info-box-number">93,139</span>
                    </div><!-- /.info-box-content -->
                </div><!-- /.info-box -->
        </div>
        
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <!-- Apply any bg-* class to to the icon to color it -->
                    <span class="info-box-icon bg-red"><i class="fa fa-star-o"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Test</span>
                        <span class="info-box-number">93,139</span>
                    </div><!-- /.info-box-content -->
                </div><!-- /.info-box -->
        </div>
        
        
    </div>
   


</div>

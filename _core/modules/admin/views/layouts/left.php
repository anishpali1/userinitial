<aside class="main-sidebar">

    <section class="sidebar">

        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <?php if(!empty(Yii::$app->user->identity->profile_picture)):  ?>                      
                      <img src="<?= Yii::$app->urlManager->createAbsoluteUrl('') . "uploads/profile/" .Yii::$app->user->identity->profile_picture ?>" class="img-circle" alt="User Image"/>
                <?php else: ?>                        
                       <img src="<?= $directoryAsset ?>/img/user2-160x160.jpg" class="img-circle" alt="User Image"/>
                <?php endif;  ?>
                
            </div>
            <div class="pull-left info">
                <p><?= ucwords(Yii::$app->user->identity->full_name); ?></p>

<!--                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>-->
            </div>
        </div>

        <!-- search form -->
<!--        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search..."/>
              <span class="input-group-btn">
                <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
            </div>
        </form>-->
        
        <!-- /.search form -->

        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu'],
                'items' => [
                    ['label' => 'Menu', 'options' => ['class' => 'header']],
                    ['label' => 'Dashboard', 'icon' => 'file-code-o', 'url' => ['/admin/dashboard']],
                    ['label' => 'Customers', 'icon' => 'adjust', 'url' => ['/admin/customer']],
                    ['label' => 'Category', 'icon' => 'adjust', 'url' => ['/admin/category']],
                    ['label' => 'Relationships', 'icon' => 'adjust', 'url' => ['/admin/relationship']],
                    ['label' => 'Request Log', 'icon' => 'adjust', 'url' => ['/admin/requestlog']],
//                    ['label' => 'Debug', 'icon' => 'dashboard', 'url' => ['/debug']],
//                    ['label' => 'Login', 'url' => ['site/login'], 'visible' => Yii::$app->user->isGuest],
//                    [
//                        'label' => 'Same tools',
//                        'icon' => 'share',
//                        'url' => '#',
//                        'items' => [
//                            ['label' => 'Gii', 'icon' => 'file-code-o', 'url' => ['/gii'],],
//                            ['label' => 'Debug', 'icon' => 'dashboard', 'url' => ['/debug'],],
//                            [
//                                'label' => 'Level One',
//                                'icon' => 'circle-o',
//                                'url' => '#',
//                                'items' => [
//                                    ['label' => 'Level Two', 'icon' => 'circle-o', 'url' => '#',],
//                                    [
//                                        'label' => 'Level Two',
//                                        'icon' => 'circle-o',
//                                        'url' => '#',
//                                        'items' => [
//                                            ['label' => 'Level Three', 'icon' => 'circle-o', 'url' => '#',],
//                                            ['label' => 'Level Three', 'icon' => 'circle-o', 'url' => '#',],
//                                        ],
//                                    ],
//                                ],
//                            ],
//                        ],
//                    ],
                ],
            ]
        ) ?>

    </section>

</aside>

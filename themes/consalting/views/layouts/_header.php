 <header class="header">
  <div class="content-site">
    <div class="header-content fl fl-ai-c fl-jc-sb">
      <div class="header-logo">
        <a href="/" class="logo fl fl-ai-c fl-jc-c">
          <img src="<?= $this->mainAssets . '/images/logo.svg' ?>" alt="АС-Консалтинг">
        </a>
      </div><!-- logo --> 
      <div class="header-menu menu">
        <?php if (Yii::app()->hasModule('menu')) : ?>
          <?php $this->widget('application.modules.menu.widgets.MenuWidget', ['name' => 'top-menu', 'view' => 'menu']); ?>
        <?php endif; ?>      
      </div><!-- menu -->
      <div class="header-social social">
        <?php if (Yii::app()->hasModule('contentblock')): ?>
          <?php $this->widget("application.modules.contentblock.widgets.ContentBlockWidget", ['code'=>'social']); ?>
        <?php endif; ?>
      </div><!-- social -->
    
      <div class="header-phone">
        <div class="mode">
          <?php if (Yii::app()->hasModule('contentblock')): ?>
            <?php $this->widget("application.modules.contentblock.widgets.ContentBlockWidget", ['code'=>'mode']); ?>
          <?php endif; ?>
        </div>
        <?php if (Yii::app()->hasModule('contentblock')): ?>
          <?php $this->widget("application.modules.contentblock.widgets.ContentBlockWidget", ['code'=>'phone']); ?>
        <?php endif; ?>
      </div>
      <div class="mobile-panel">
        <a href="#menuModal" data-toggle="modal">
          <button class="m-menu-button m-menu-open fl fl-ai-c fl-jc-c">
              <span class="line"></span>
              <span class="line"></span>
              <span class="line"></span>
              <span class="line"></span>
          </button>
        </a>
      </div><!-- mobile-panel -->
    </div>
  </div> 
</header>

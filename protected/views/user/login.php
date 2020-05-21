

<div class="container">
  <div class="login-wrap rounded">
     
   <h2 class="text-center"><?php echo "Login into ChatApp"?></h2>
   
    <form id="frm" class="frm rounded3" method="POST" onsubmit="return false;">
    <div class="inner">
    <?php echo CHtml::hiddenField('action','login')?>
    <div>
    <?php 
    echo CHtml::textField('email',
     ''
    ,array(
      'placeholder'=>"Email",
      'class'=>"lightblue-fields rounded",
      'required'=>true
    ));
    ?>
    </div>
    
    <div class="top20">
    <?php 
    echo CHtml::passwordField('password',
     ''
    ,array(
      'placeholder'=>"Password",
      'class'=>"lightblue-fields rounded",
      'required'=>true
    )); 
    ?>
    </div>
    
    <div class="top20">
    <button class="yellow-button large rounded3 relative">
       <?php echo "Login"?> <i class="ion-ios-arrow-thin-right"></i>
    </button>
    </div>
    
    </div> <!--inner-->
    
  
    
    </form> <!--login-->
    
    
    <hr/>
    <a href="<?php echo Yii::app()->createUrl('/user/register/', array())?>" class="yellow-button large rounded3 relative">
       <?php echo "REGISTER"?> <i class="ion-ios-arrow-thin-right"></i>
    </a>
       
  </div> <!--login-wrap-->
</div> <!--container-->
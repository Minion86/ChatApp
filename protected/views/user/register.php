
<div class="container">
    <div class="login-wrap rounded">

        <h2 class="text-center"><?php echo "Signup" ?></h2>


        <form id="frm"  class="frm rounded3"  method="POST" onsubmit="return false;">
            <?php echo CHtml::hiddenField('action', 'addUser') ?>

            <div class="inner">
                <div class="top20">
                    <?php
                    echo CHtml::textField('name', ''
                            , array('placeholder' => "Name",
                        'class' => "lightblue-fields rounded",
                        'required' => true
                    ))
                    ?>
                </div>
                <div class="top20">
                    <?php
                    echo CHtml::textField('email', $email_address
                            , array(
                        'placeholder' => "Email",
                        'class' => "lightblue-fields rounded",
                        'required' => true
                    ))
                    ?>
                </div>


                <div class="top20">
                    <?php
                    echo CHtml::passwordField('password', ''
                            , array(
                        'placeholder' => "Password",
                        'class' => "lightblue-fields rounded",
                        'required' => true
                    ))
                    ?>
                </div>

                <div class="top20">
                    <?php
                    echo CHtml::dropDownList('currency', ''
                            , array())
                    ?>
                </div>   




                <div class="top20">
                    <button class="yellow-button large rounded3 relative">
                        <?php echo "Sign up" ?>
                    </button>
                </div>

            </div>

        </form>


    </div> <!--login-wrap-->
</div> <!--container-->
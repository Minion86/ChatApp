
<div class="container">
    <h3 class=" text-center">Messaging</h3>
    <div class="messaging">
        <div class="inbox_msg">

            <div class="mesgs">
                <div class="msg_history"  id="msg_history">
                    <?php if (is_array($chats) && count($chats) >= 1): ?>
                        <?php foreach ($chats as $val): ?>
                            <?php if ($val['sender'] == "user"): ?>
                                <div class="outgoing_msg">
                                    <div class="sent_msg">
                                        <p><?php echo $val['message'] ?></p>
                                        <span class="time_date"> <?php echo $val['date_sent'] ?></span> </div>
                                </div>
                            <?php endif; ?>   
                            <?php if ($val['sender'] == "chatbot"): ?>
                                <div class="incoming_msg">
                                    <div class="incoming_msg_img"> <img src="https://ptetutorials.com/images/user-profile.png" alt="sunil"> </div>
                                    <div class="received_msg">
                                        <div class="received_withd_msg">
                                            <p><?php echo $val['message'] ?></p>
                                            <span class="time_date"> <?php echo $val['date_sent'] ?></span></div>
                                    </div>
                                </div>
                            <?php endif; ?> 

                        <?php endforeach; ?>
                    <?php endif; ?>      

                </div>
                <div class="type_msg">
                    <form id="frm"  class="frm rounded3"  method="POST" onsubmit="return false;">
                        <?php echo CHtml::hiddenField('action', 'addMessage') ?>
                        <div class="input_msg_write">
                            <?php
                            echo CHtml::textField('message', ''
                                    , array(
                                'placeholder' => "Type a message",
                                'class' => "write_msg",
                                'required' => true
                            ))
                            ?>
                            <button class="msg_send_btn" type="submit"><i class="fa fa-paper-plane-o" ></i></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div></div>
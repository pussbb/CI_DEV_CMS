<div class="title">
    <?php echo $this->lang->line('logintitle'); ?></div>
<form action="<?php echo base_url(true) . 'login'; ?>" id="login_box" method="post" >
    <div class="login_form_row">
        <label class="login_label"><?php echo $this->lang->line('username'); ?>:</label>
        <input type="text" name="name" class="login_input " required="required" />
    </div>

    <div class="login_form_row">
        <label class="login_label"><?php echo $this->lang->line('password'); ?>:</label>
        <input type="password" name="pass" min="6" class="login_input " required="required" />
    </div>
       
           <button class="buttons" style="float:right;margin-top: 30px;" type="submit"><?= $this->lang->line('login_button');?></button>
 
</form>
<div style="width: 60%;float:left;display: table;padding: 3px;">
<a class="buttons" style="float:left;margin-right: 4px;" href="<?php echo base_url(true) . 'register'; ?>">
    <?= $this->lang->line('reg');?>
</a>

<!---<a class="buttons" style="float:left;" href="#"  >buttons</a>-->
</div>
<script>
$("#login_box").validator();

</script>
<div id="ajax_content">
    <script type="text/javascript">
        function display_msg(id)
        {
            $('#msg'+id).toggle();
        }
        function delete_me(file,id)
        {   <?php
if ($this->config->item('folder') == true)
    $url = base_url() . $this->config->item('folder_name') . "/";
else
    $url= base_url();
?>
                    $.post("<?= $url ?>actions/delete_logfile",{"id":file},function(data)
                    {

                    });
                    $('#msg'+id).remove();
                    $('#title'+id).remove();

                }
                
    </script>
    <table id="rounded-corner" style="width:95%;" summary="inbox pms">
        <thead>
            <tr>
                <th scope="col" class="rounded-company">#</th>
                <th scope="col" class="rounded-q3">Descriptionl</th>
                <th scope="col" class="rounded-q4"><?= lang('option'); ?></th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <td colspan="3" class="rounded-foot-left"><em><?= lang('inbox_help'); ?></em></td>

            </tr>


        </tfoot>
        <tbody>
            <?php
            foreach ($files as $file => $name) {
                if($name=='index.html') return;
                echo '<tr id="title' . $file. '"><td>' . $name . '</td><td></td>
                    <td><img title="' . lang('delete') . '" onclick="delete_me(\'' .$name .'\','.$file.');" src="' . base_url() . 'images/Remove.png">

           <img title="' . lang('view') . '"  onclick="display_msg(' . $file . ');" src="' . base_url() . 'images/Preview.png">
</td></tr>';

                echo '<tr id="msg' . $file . '" new="" style="display:none;"><td colspan="3">' . str_replace("\n","<br>",read_file($path.$name))  . '</td></tr>';
            }
            ?>
        </tbody>
    </table>

</div>
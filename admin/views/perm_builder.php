<legend>Permissions </legend> <br/>
      <table border="1" >
          <thead>
              <tr>
                  <th>User Type</th>
                  <th>Edit</th>
                  <th>add</th>
                  <th>Read</th>
              </tr>
          </thead>
          <tbody>

                  <?php $all=1;
                  foreach (unserialize($permission) as $key => $value) {

                      if(is_array($value))
                      { echo "<tr><td>$key</td>";
                      $i=0;

                          foreach ($value as $item)
                          {
                              $checked="";
                              if($item>0) $checked="checked";
                              echo '<td><input type="checkbox" id="permission'.$id.'"   value="'.$id.$all.'" '.$checked.'  /> </td>';
                              echo '<input id="'.$id.$all++.'" type="hidden" name="'.$key.'['.$i++.']" value="'.$item.'" />';
                          }
                          echo "</tr>";
                      }
                       else
                      {
                          echo '<input name="'.$key.'" type="hidden" value="'.$value.'" />';
                      }
                  }
                  ?>
          </tbody>
      </table>

<script type="text/javascript" >

        //var v=$(this).val;
        $('input:checkbox').click(function(){
            if($(this).attr('id')=='permission<?=$id?>')
                {
                    if($(this).is(':checked'))
                       $('#'+$(this).val()).val(1);
                   else $('#'+$(this).val()).val(0);

                }

        });

</script>
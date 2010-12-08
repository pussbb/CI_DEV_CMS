<div class="sitemap">
		<ul id="utilityNav">
                    <li><a href="/<?=lang_id()?>/about"><?=lang('contact');?></a></li>
			<li><a href="/<?=lang_id()?>/register"><?=lang('reg');?></a></li>
			<li><a href="/forum"><?=lang('forum');?></a></li>
		</ul>

		<ul id="primaryNav" >
			<li id="home"><a href="/<?=lang_id()?>/"><?=lang('home');?></a></li>
<?php
                        //apps
                        echo ' <li><a href="/'.  lang_id().'/apps">'.lang('apps').'</a>';
                        $query=$this->db->get($this->db->dbprefix('downcat'));
                        if($query->num_rows()>0)
                        {
                          echo '<ul>';
                          foreach ($query->result() as $row) {
                          echo '<li><a href="/'.  lang_id().'/apps/viewcat/'.$row->id.'">'.$row->catname.'</a></li>';
                        }
                        echo '</ul>';
                        }
                        //blog
                        echo ' <li><a href="/'.  lang_id().'/blog">'.lang('blog').'</a>';
                         $query = $this->db->get($this->db->dbprefix('catblog'));
                        if($query->num_rows()>0)
                            {
                              echo '<ul>';
                              foreach ($query->result() as $row) {
                              echo '<li><a href="/'.  lang_id().'/blog/viewcat/'.$row->id.'">'.$row->blogcat_name.'</a></li>';
                            }
                            echo  $qhda;
                            echo '</ul>';
                            //blog
                        }
                        
    

                        ?>
                       
		</ul>

	</div>
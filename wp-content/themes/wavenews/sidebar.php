<aside id="sidebar">
    <div class="sidebar_content animated fadeInUp">
    <?php  if(isset($post)){theme_function('sidebar',$post->ID);}else{theme_function('sidebar');} ?>
    </div>
</aside>
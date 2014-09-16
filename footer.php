<div id="footer" class="fullwidth g4">
    <div class="container">
    <div id="footerlogo">
      <a href="http://essentialhospitals.org"><img src="<?php bloginfo('template_directory'); ?>/img/footer-logo.png"></a>
    </div>
     <div id="footer_address" class="four columns element">
          <div class="footer-address">
        <span class="footHead">AMERICA'S ESSENTIAL HOSPITALS</span>
              <br />
              <span class="serif">1301 Pennsylvania Ave. NW, Suite 950
              <br />
              Washington, DC 20004</span>
              <br />
              <br />
              202.585.0100
              <br />
              info@essentialhospitals.org
              <br />
              <br />
           </div>
          <div id="newsletter">
            <form>
              <span>Essential Hospitals news in your inbox:</span>
              <input type="text" class="newsletter_btn_input" value="Enter Email Here"><input class="newsletter_btn"  type="submit" >
              <div class="clear"></div>
            </form>
            <div class="clear"></div>
          </div>
         </div>
     <div id="footer_contact" class="four columns element"><div class="gutter">
          <span class="footHead">Media Inquiries</span><br />
          <span class="serif"><a href="COMM.admin@essentialhospitals.org">COMM.admin@essentialhospitals.org</a></span>
          <br /><br />
          <span class="footHead">Association Membership</span><br />
          <span class="serif"><a href="MS.admin@essentialhospitals.org">MS.admin@essentialhospitals.org</a></span>
          <br /><br />
          <span class="footHead">Meetings and Conferences</span><br />
          <span class="serif"><a href="MS.admin@essentialhospitals.org">MS.admin@essentialhospitals.org</a></span>
          <br /><br />
          <span class="footHead">Website and<br />
          Sign in Questions</span><br />
          <span class="serif"><a href="COMM.admin@essentialhospitals.org">COMM.admin@essentialhospitals.org</a></span>

				 </div></div>
     <div id="footer_sponsors" class="one-half floatright">

       <h3>Sponsors</h3>
       <div class="sponsors">
         <?php $sponsors = get_field('footer_sponsors');
          foreach($sponsors as $sponsor){
            echo '<div class="onefourth floatleft sponsor-entry">
                <a target="_blank" href="http://'.$sponsor['url'].'"><img src="'.$sponsor['logo'].'"></a>
                </div>';
          }
         ?>
       </div>

     </div>
        <div class="clear"></div>

      <!-- END CONTAINER -->
      </div>

    <div class="clear"></div>
  <!-- END FOOTER -->
  </div>


<?php wp_footer(); ?>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-47673413-1', 'essentialhospitals.org');
  ga('send', 'pageview');

</script>
</body>
</html>
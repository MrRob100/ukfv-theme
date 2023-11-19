
			</div><!-- .layout-page -->
		</div><!-- #s-main-inner -->
	</div><!-- #s-main -->


	<footer role="contentinfo">
		
	<div class="layout-page s-footer-figure">
		<img id="footer-figure" src="<?php echo THEME_URI; ?>/assets/img/logo-figure--red.png" alt="" />
	</div>

		<div class="s-footer-content">
			<div id="s-footer-contacts" class="layout-page layout-page--padding">

				<h3>Get in touch</h3>

				<div class="vcard">
					<div class="adr">
						<div class="fn org visuallyhidden">UK Footvolley Association</div>
						<?php  ?>
					</div>	
					<div class="email"><span class="value"><a href="&#109;&#097;&#105;&#108;&#116;&#111;:&#110;&#105;&#99;&#107;&#64;&#102;&#111;&#111;&#116;&#118;&#111;&#108;&#108;&#101;&#121;&#46;&#99;&#111;&#46;&#117;&#107;">&#110;&#105;&#99;&#107;&#64;&#102;&#111;&#111;&#116;&#118;&#111;&#108;&#108;&#101;&#121;&#46;&#99;&#111;&#46;&#117;&#107;</a></span></div>

				</div> 

			</div>
		</div>

		<div class="s-footer-legal">
			<div class="layout-page layout-page--padding">
				<?php ?>

				<p class="copyright">
					&copy; <?php echo date('Y'); ?> <a class="fn org url" rel="me" href="<?php echo home_url('/') ?>"><?php bloginfo('name'); ?></a>
				</p>
			</div>
		</div>

	</footer>


	<?php if (WP_DEBUG) {
	    echo '<!-- '.get_num_queries().' queries in '.timer_stop(0).' seconds -->';
	} ?>

	<!-- jQuery -->
	<script>window.jQuery || document.write('<script src="<?php echo THEME_URI; ?>/assets/js/libs/jquery-1.11.3.min.js"><\/script>')</script>
	<script src="<?php echo THEME_URI; ?>/assets/js/libs/jquery-migrate-1.2.1.min.js"></script>

	<script src="<?php echo THEME_URI; ?>/assets/fancybox/jquery.fancybox.pack.js"></script>




	<?php  ?>
	<script src="<?php echo THEME_URI; ?>/assets/js/libs/enquire.min.js"></script>

	<!-- <script src="<?php echo THEME_URI; ?>/assets/js/libs/jquery.ba-hashchange.min.js"></script>	 -->
	<!-- <script src="<?php echo THEME_URI; ?>/assets/js/libs/jquery.easytabs.min.js"></script>	 -->
	<!-- <script src="<?php echo THEME_URI; ?>/assets/js/libs/bootstrap-transition.js"></script>	 -->
	<!-- <script src="<?php echo THEME_URI; ?>/assets/js/libs/bootstrap-dropdown.js"></script>	 -->
	<!-- <script src="<?php echo THEME_URI; ?>/assets/js/libs/bootstrap-tooltip-custom.js"></script>	 -->

	<script src="<?php echo THEME_URI; ?>/assets/js/libs/hoverIntent.js"></script>
	<script src="<?php echo THEME_URI; ?>/assets/js/libs/superfish.js"></script>
	<script src="<?php echo THEME_URI; ?>/assets/js/libs/jquery.fitvids.js"></script>
	
	<script src="<?php echo THEME_URI; ?>/assets/js/plugins.js"></script>	
	<script src="<?php echo THEME_URI; ?>/assets/js/scripts.js"></script>


	<?php if (! WP_DEBUG) { ?>
	<script>
		(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
		(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
		m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
		})(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

		ga('create', 'UA-96521722-1', 'auto');
		ga('send', 'pageview');
	</script>
	<?php } ?>

	<?php if (! WP_DEBUG) { ?>
	<script>
		var MTIProjectId='ba08a262-cb6d-4601-a76a-c9c0ab3eed4c';
		(function() {
			var mtiTracking = document.createElement('script');
			mtiTracking.type='text/javascript';
			mtiTracking.async='true';
			mtiTracking.src='<?php echo THEME_URI; ?>/assets/fonts/mtiFontTrackingCode.js';
			(document.getElementsByTagName('head')[0]||document.getElementsByTagName('body')[0]).appendChild( mtiTracking );
		})();
	</script>
	<?php } ?>

	<?php wp_footer(); ?>
</body>
</html>

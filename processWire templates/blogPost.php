<?php
/*
	Blog Post Template
*/
include("./header.inc");
?>
	<div id="main" class="container">

		<div id="content">
			<div id="blogPost-container">
			<div id ="author">
				<div id ="profile"></div>
					<script>
						document.getElementById("profile").style.backgroundImage = "url('<?php echo $page->author->profile->url?>')";
					</script>
				<div id ="name" class="red"><a href="<?php echo $page->author->url?>"><?php echo $page->author->title?></a></div>
				<div id ="status" class="grey">
					<?php printStatus($page->author)?>
				</div>
				<div id ="team" class="grey"><?php printTeam(($page->author), $pages); ?></div>
				<?php 
					// If the page is editable, then output a link that takes us straight to the page edit screen:
					if($page->editable()) {
						echo "<a class='red' href='{$config->urls->admin}page/edit/?id={$page->id}'>Edit</a>"; 
					}
				?>
			</div><!--author-->
			<div id ="post">
				<div id ="post-header">
					<div id ="details" class="grey">
					<?php echo $page->date ?>
					</div>
					<div id ="title">
						<h1 class="red"><?php echo $page->title ?></h1>
					</div>
				</div>
				<div id ="post-content">
					<?php
					/*display featured image. If slider is not empty, display slider instead*/
						if($page->featuredImage && (count($page->sliderImage) == 0)){
							echo "<div id='featured'><img src='".$page->featuredImage->url." '></div>";
							echo "<div id='blogPost'>".$page->postContent."</div>";
							echo "</div></div><!--post-->";
						}
						else if($page->sliderImage){
							echo "<div id='blogPost'>".$page->postContent."</div>";
							//end post after text, so slider appears below
							echo "</div></div><!--post-->";
							
							
							echo"<div class='flexslider'><ul class='slides'>";
									if($page->featuredImage->width >= 790){
										echo "<li><img src='{$page->featuredImage->url}'/></li>";
									}
									foreach($page->sliderImage as $i){
										echo "<li><img src='{$i->url}'/>";
										if($i->description != NULL){
											echo "<p class='flex-caption'>{$i->description}</p>";
										}
										echo "</li>";
									}
							echo"</ul></div><!--flexSlider-->";
						}
						
					?>
				
		</div><!--blogPost-container-->
		</div><!--content-->
		
		<aside id="sidebar">
			
			<!-- include sidebar from template file-->
			<?php include("./sidebarNav.inc"); ?>
			
		</aside> <!-- sidebar -->
		
	</div> <!--container-->
<?php
include("./footer.inc");
?>
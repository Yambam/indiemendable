<?php
	define('indiemendable',true,true);
	include('config.php');
	$domain_sql = mysqli_escape_string($con,$_SESSION['domain']);
	
	$result = mysqli_query($con,"SELECT * FROM games WHERE domain = '$domain_sql' AND state >= 2 ORDER BY id DESC LIMIT 1");
	if (mysqli_num_rows($result)>=1) {
		$game_info = mysqli_fetch_array($result);
		$game_info['tags'] = explode(',',$game_info['tags']);
		for($i=0;$i<sizeof($game_info['tags']);$i+=1) {
			$game_info['tags'][$i] = preg_replace('/^\s*(.*)\s*$/','$1',$game_info['tags'][$i]);
		}
		
		$game_author_id = mysqli_escape_string($con,$game_info['author']);
		$result = mysqli_query($con,"SELECT * FROM users WHERE id = '$game_author_id'");
		if (mysqli_num_rows($result)>=1) {
			$game_author = mysqli_fetch_assoc($result);
			if ($game_author['picture']=='') {
				$game_author['picture'] = $no_picture;
			}
		} elseif ($game_info['domain']!='yoyogames') {
			include("index-no-games.php");
			exit;
		}
		
		if (!empty($game_info['author_str'])) {
			$game_author['username'] = $game_info['author_str'];
		}
		if (!empty($game_info['author_picture'])) {
			$game_author['picture'] = str_replace('/web/','http://web.archive.org/web/',$game_info['author_picture']);
		}
		
		$result = mysqli_query($con,"SELECT * FROM uploaded_files WHERE type = 2 AND place = '{$game_info['id']}'");
		while($row = mysqli_fetch_array($result)) {
			$row['filename'] = str_replace('/large/','/original/',$row['filename']);
			$game_info['screenshots'][] = $row;
		}
		
		$_SERVER['REQUEST_URI'] = str_replace('random',$game_info['id'].'-'.slugify($game_info['name']),$_SERVER['REQUEST_URI']);
	} else {
		include("index-no-games.php");
		exit;
	}
	
	$css[] = '/css/responsive-alt.css';
	$js[] = '/blog/wp-content/plugins/email-subscribers/widget/es-widget.js';
	$page_title = gettext("Home");
	include("default-top.php");
	include('blog/wp-load.php');
?>
				<div class="container-lt float-right" style="width: 250px; min-height: 0; margin-bottom: -40px;">
					<div class="container-title-lt"><?php echo gettext("News"); ?>
						<a class="arrow-link-lt" href="/blog" title="<?php echo gettext("News"); ?>"></a>
					</div>
					<!--<div class="news-item"><i>October 25th</i><br>I added a new dark theme (it's the new default). And there's a new search field at the top of the website.</div>
					<div class="news-item"><i>October 11th</i><br>This is GameMaker Sandbox Beta! I just started working on it today. :)</div>-->
<?php
	global $post;
	$recent_posts = wp_get_recent_posts(array('numberposts' => 1,'post_status' => 'publish'));
	foreach($recent_posts as $_post) { $post = $_post['ID']; setup_postdata($post);
		//if ($_post['post_status']!='publish') continue; ?>
					<div class="news-item"><h3 style="margin-bottom: 5px;"><a href="<?php echo the_permalink(); ?>"><?php echo $_post['post_title']; ?></a></h3><i><?php echo get_the_date(); ?></i><br><?php echo substr(strip_tags($_post['post_content']),0,80); if (strlen(strip_tags($_post['post_content']))>80) echo '...'; ?></div><?php
	}
?>
					<div class="news-item"><a href="/blog"><?php echo gettext("View all news..."); ?></a></div>
				</div>
				<div class="container-lt float-right" style="clear: right; width: 250px; min-height: 0; margin-top: 55px; margin-bottom: -640px;">
					<div class="container-title-lt"><?php echo gettext("Community"); ?>
						<a class="arrow-link-lt" href="<?php echo $language_url; ?>/users" title="<?php echo gettext("Community"); ?>"></a>
					</div>
<?php if (empty($_SESSION['logged_in'])) { ?>
					<div><i><?php echo str_replace('/register',"$language_url/register",gettext("Hello! Click <a href=\"register\">register</a> to make your account!")); ?></i></div>
<?php } ?>
					<h4 style="margin: 15px 0 10px; text-align: center;"><?php echo ngettext("Newest member","Newest members",10); ?></h4>
					<div class="seperators even-odd" style="line-height: 30px;">
						<div></div>
<?php
	require_once 'config.php';
	$result = mysqli_query($con,"SELECT * FROM users WHERE type != 0 AND visible != 0 ORDER BY id DESC LIMIT 5");
	if ($result) {
		while($row = mysqli_fetch_assoc($result)) {
			if ($row['picture']=='') {
				$row['picture'] = $no_picture;
			}
?>
						<div class="user-link" style="text-align: center;"><a href="<?php echo $language_url; ?>/users/<?php echo $row['username']; ?>"><div class="picture" style="background-image: url('<?php echo str_replace('/original/','/thumb/',$row['picture']); ?>');"></div><?php echo $row['username']; ?></a></div>
<?php	}
	} else {
		echo 'An error occurred: ' . mysqli_error($con);
	}
?>
						<div></div>
					</div>
					
					<p style="text-align: center;">
						<i><?php echo gettext("Note for older members: log in again to show your account here."); ?></i>
					
					<h4 style="margin: 15px 0 10px; text-align: center;"><?php echo ngettext("Statistic","Statistics",2); ?></h4>
					<div class="statistics">
						<?php echo ngettext("Member","Members",10); ?>: <span style="color: #7BB640;"><?php $result = mysqli_query($con,"SELECT username FROM users WHERE type != 0 AND visible != 0"); echo mysqli_num_rows($result); ?></span><br>
						<?php echo ngettext("Game created","Games created",10); ?>: <span style="color: #7BB640;"><?php $result = mysqli_query($con,"SELECT id FROM games WHERE state >= 1 AND domain = '$domain_sql'"); echo mysqli_num_rows($result); ?></span><br>
						<?php echo ngettext("Game played","Games played",10); ?>: <span style="color: #7BB640;"><?php $result = mysqli_query($con,"SELECT id FROM downloads WHERE type = 1 AND ip != 'google' AND ip != 'facebook'"); echo mysqli_num_rows($result); ?></span><br>
					</div>
					<h5 style="margin: 15px 0 5px; text-align: center;"><?php echo gettext("YYG archive"); ?></h5>
					<div class="statistics">
						<?php echo ngettext("Game indexed","Games indexed",10); ?>: <span style="color: #7BB640;"><?php $result = mysqli_query($con,"SELECT id FROM games WHERE state >= 1 AND domain = 'yoyogames' AND game != ''"); echo mysqli_num_rows($result); ?></span><br>
						<?php echo ngettext("Game archived","Games archived",10); ?>: <span style="color: #7BB640;"><?php $result = mysqli_query($con,"SELECT id FROM games WHERE state >= 1 AND domain = 'yoyogames' AND game != '' AND !INSTR(game,'http://')"); echo mysqli_num_rows($result); ?></span>
					</div>
					
					<div class="newsletter less" tabindex="2">
						<h4 style="margin: 30px 0 10px; text-align: center;"><?php echo gettext("Subscribe to the newsletter..."); ?></h4>
						<?php es_subbox( $namefield = "YES", $desc = "", $group = "" ); ?>
						<div class="game-short-fade"></div>	
					</div>
				</div>
<?php
	include('index-widgets.php');
?>
				<div id="spotlight" class="container dark" style="overflow: auto; float: none; margin-right: 280px;">
					<div class="container-title" style="font-size: 1.1em;"><?php echo gettext("Spotlight"); ?></div>
					<div class="game-screenshots game-spotlight">
<?php
	$result = mysqli_query($con,"SELECT * FROM games WHERE domain = '$domain_sql' AND featured = 1 ORDER BY added DESC");
	if (!$result) {
		echo mysqli_error($con);
	}
?>
						<div class="shift" data-count="<?php echo mysqli_num_rows($result); ?>" style="margin-left: 0;">
						</div><?php while($row = mysqli_fetch_assoc($result)) { ?><a href="<?php echo $language_url; ?>/games/<?php echo $row['id'].'-'.slugify($row['name']); ?>" tabindex="-1" style="background-image: url('<?php echo str_replace('/original/','/large/',$row['picture']); ?>')">
							<div><div><?php echo $row['name']; ?></div></div>
						</a><?php } ?>

					</div>
					<div class="shine"></div>
				</div>
				<div id="spotlight-extra" class="container dark" style="overflow: auto; float: none; margin-right: 280px; min-height: 85px;">
					<table style="width: 100%;">
						<tr>
							<td>
								<div style="margin: 0 auto; max-width: 180px; margin-top: 20px;">
									<a href="<?php echo $language_url; ?>/games/random/download" class="game-button-play" style="max-width: 180px;"><?php echo gettext("I'm feeling lucky"); ?></a>
									<div style="text-align: right; color: #808080; font-size: .8em; margin-bottom: 20px;">
										<strong><?php echo gettext("Picks a random game"); ?></strong>
									</div>
								</div>
							</td>
							<td>
								<div style="margin: 0 auto; max-width: 180px; margin-top: 20px;">
									<a href="<?php echo $language_url; ?>/games/latest/download" class="game-button-play" style="max-width: 180px; margin-top: 20px;"><?php echo gettext("Try latest game"); ?></a>
									<div style="text-align: right; color: #808080; font-size: .8em; margin-bottom: 20px;">
										<strong><a href="<?php echo $language_url; ?>/games/<?php echo $game_info['id'].'-'.slugify($game_info['name']); ?>"><?php echo htmlspecialchars($game_info['name']); ?></a></strong><br>
										<strong><?php echo gettext("Version"); ?>: </strong><?php if ($game_info['stage']==2) echo 'Beta '; if ($game_info['stage']==3) echo 'WIP '; echo htmlspecialchars($game_info['version']); ?><br>
										<?php echo date('d F Y',strtotime($game_info['last_updated'])); ?>
									</div>
								</div>
							</td>
						</tr>
					</table>
				</div>
				<div class="container-seamless category-list" style="margin-right: 280px; float: none;">
<?php
	require_once 'config.php';
	$_result = mysqli_query($con,"SELECT * FROM categories ORDER BY id");
	if ($_result) {
		while($_row = mysqli_fetch_assoc($_result)) {
?>
					<div class="category">
						<div class="container-title"><?php echo gettext($_row['name']); ?>
							<a class="arrow-link" href="<?php echo $language_url; ?>/browse?category=<?php echo $_row['slug']; ?>" title="<?php echo gettext('View all ') . lcfirst(gettext($_row['name'])); ?>..."></a>
						</div>
						<div class="game-screenshots game-spotlight">
<?php
	$result = mysqli_query($con,"SELECT * FROM games WHERE domain = '$domain_sql' AND featured = 2 AND category = '{$_row['slug']}' ORDER BY added DESC");
	if (!$result) {
		echo mysqli_error($con);
	}
?>
							<div class="shift" data-count="<?php echo min(mysqli_num_rows($result),1); ?>" style="margin-left: 0;">
							</div><?php while($row = mysqli_fetch_assoc($result)) { ?><a href="<?php echo $language_url; ?>/games/<?php echo $row['id'].'-'.slugify($row['name']); ?>" tabindex="-1" style="background-image: url('<?php echo str_replace('/original/','/large/',$row['picture']); ?>')">
								<div><div><?php echo $row['name']; ?></div></div>
							</a><?php break; } ?>

						</div>
					</div>
<?php
			$_row = mysqli_fetch_assoc($_result);
			if ($_row) {
?>
					<div class="category float-right">
						<div class="container-title"><?php echo gettext($_row['name']); ?>
							<a class="arrow-link" href="<?php echo $language_url; ?>/browse?category=<?php echo $_row['slug']; ?>" title="<?php echo gettext('View all ') . lcfirst(gettext($_row['name'])); ?>..."></a>
						</div>
						<div class="game-screenshots game-spotlight">
<?php
	$result = mysqli_query($con,"SELECT * FROM games WHERE domain = '$domain_sql' AND featured = 2 AND category = '{$_row['slug']}' ORDER BY added DESC");
	if (!$result) {
		echo mysqli_error($con);
	}
?>
							<div class="shift" data-count="<?php echo min(1,mysqli_num_rows($result)); ?>" style="margin-left: 0;">
							</div><?php while($row = mysqli_fetch_assoc($result)) { ?><a href="<?php echo $language_url; ?>/games/<?php echo $row['id'].'-'.slugify($row['name']); ?>" tabindex="-1" style="background-image: url('<?php echo str_replace('/original/','/large/',$row['picture']); ?>')">
								<div><div><?php echo $row['name']; ?></div></div>
							</a><?php break; } ?>

						</div>
					</div>
<?php
			}
		}
	} else {
		echo 'An error occurred: ' . mysqli_error($con);
	}
?>
					<div class="clearfix"></div>
					<div style="text-align: right; font-size: .9em;">
						<a href="<?php echo $language_url; ?>/browse"><?php echo gettext('View all games...'); ?></a>
					</div>
				</div>
				<div class="container dark" style="overflow: auto; float: none; margin-right: 280px; margin-top: 30px; padding: 0;">
					<div class="container-title" style="font-size: 1.1em; margin: 0;"><?php echo gettext('Latest archive additions'); ?></div>
					<div class="game-screenshots game-spotlight">
<?php
	$result = mysqli_query($con,"SELECT * FROM games WHERE domain = 'yoyogames' AND picture != '' ORDER BY last_updated DESC LIMIT 8");
	if (!$result) {
		echo mysqli_error($con);
	}
?>
						<div class="shift" data-count="<?php echo mysqli_num_rows($result); ?>" style="margin-left: 0;">
						</div><?php while($row = mysqli_fetch_assoc($result)) { ?><a href="<?php echo $language_url; ?>/games/<?php echo $row['id'].'-'.slugify($row['name']); ?>" tabindex="-1" style="background-image: url('<?php echo str_replace('/original/','/large/',$row['picture']); ?>')">
							<div><div><?php echo $row['name']; ?></div></div>
						</a><?php } ?>

					</div>
				</div>
<?php include("default-bottom.php"); ?>
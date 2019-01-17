<!DOCTYPE html>
<!--[if IE 8]> <html lang="ru" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="ru" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="ru"> <!--<![endif]-->
<head>
    <title>Responsive Resume/CV Template for Developers</title>
    <!-- Meta -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="favicon.ico">
    <link href='https://fonts.googleapis.com/css?family=Roboto:400,500,400italic,300italic,300,500italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
    <!-- Global CSS -->
    <link rel="stylesheet" href="assets/plugins/bootstrap/css/bootstrap.min.css">
    <!-- Plugins CSS -->
    <link rel="stylesheet" href="assets/plugins/font-awesome/css/font-awesome.css">

    <!-- Theme CSS -->
    <link id="theme-style" rel="stylesheet" href="assets/css/styles.css">
    <link id="theme-style" rel="stylesheet" href="assets/css/custom.css">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>
<?php extract(include 'model/data.php'); ?>
<div class="wrapper">
    <div class="sidebar-wrapper">
        <div class="profile-container">
            <img class="profile" src="assets/images/profile.jpg<?= '?' . mt_rand(100,999) ?>" height="150" style="border-radius: 80px;" onerror="this.src ='assets/images/default.png'" />
            <h1 class="name"><?= $name ?></h1>
            <h3 class="tagline"><?= $tagline ?></h3>
        </div><!--//profile-container-->

        <div class="contact-container container-block">
            <ul class="list-unstyled contact-list">
                <li class="email"><i class="fa fa-envelope"></i><a href="mailto: <?= $email ?>"><?= $email ?></a></li>
                <li class="phone"><i class="fa fa-phone"></i><a href="<?=$phone ?>"><?=$phone ?></a></li>
                    <li class="website"><i class="fa fa-globe"></i><a href="<?= $website_url ?>" target="_blank"><?=$website_name ?></a></li>
            </ul>
        </div><!--//contact-container-->
        <div class="education-container container-block">
            <h2 class="container-block-title">Education</h2>
            <?php foreach ($education as $key => $value): ?>
                <div class="item">
                    <h4 class="degree"><?=$value['degree'] ?></h4>
                    <h5 class="meta"><?=$value['meta'] ?></h5>
                    <div class="time"><?=$value['time_from'] . $value['time_to'] ? $value['time_to'] : '...'?></div>
                </div><!--//item-->
            <?php endforeach; ?>
        </div><!--//education-container-->

        <div class="languages-container container-block">
            <h2 class="container-block-title">Languages</h2>
            <ul class="list-unstyled interests-list">
                <?php foreach ($language as $language): ?>
                    <li><?=$language['language']?> <span class="lang-desc">(<?=$language['level']?>)</span></li>
                <?php endforeach; ?>
            </ul>
        </div><!--//interests-->

        <div class="interests-container container-block">
            <h2 class="container-block-title">Interests</h2>
            <ul class="list-unstyled interests-list">
                <?php foreach ($interests as $interest): ?>
                    <li><?=$interest['interest']?></li>
                <?php endforeach; ?>
            </ul>
        </div><!--//interests-->

    </div><!--//sidebar-wrapper-->

    <div class="main-wrapper">

        <section class="section summary-section">
            <h2 class="section-title"><i class="fa fa-user"></i>Career Profile</h2>
            <div class="summary">
                <p><?=$summary?> </p>
            </div><!--//summary-->
        </section><!--//section-->

        <section class="section experiences-section">
            <h2 class="section-title"><i class="fa fa-briefcase"></i>Experiences</h2>
            <?php foreach ($experiences as $exp): ?>
                <div class="item">
                    <div class="meta">
                        <div class="upper-row">
                            <h3 class="job-title"><?=$exp['job'] ?></h3>
                            <div class="time"><?=$exp['date_from'] ?> - <?=$exp['date_to'] ?></div>
                        </div><!--//upper-row-->
                        <div class="company"><?=$exp['company'] ?></div>
                    </div><!--//meta-->
                    <div class="details">
                        <p><?=$exp['details'] ?></p>
                    </div><!--//details-->
                </div><!--//item-->
            <?php endforeach; ?>
        </section><!--//section-->

        <section class="section projects-section">
            <h2 class="section-title"><i class="fa fa-archive"></i>Projects</h2>
            <div class="intro">
                <!--                    <p>You can list your side projects or open source libraries in this section. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum et ligula in nunc bibendum fringilla a eu lectus.</p>-->
            </div><!--//intro-->
            <?php foreach ($projects as $item): ?>
                <div class="item">
                    <span class="project-title"><a href="<?=$item['url']?>"><?=$item['title']?></a></span> - <span class="project-tagline"><?=$item['description']?></span>
                </div><!--//item-->
            <?php endforeach; ?>

        </section><!--//section-->

        <section class="skills-section section">
            <h2 class="section-title"><i class="fa fa-rocket"></i>Skills &amp; Proficiency</h2>
            <div class="skillset">
                <?php foreach ($skills as $skill): ?>
                    <div class="item">
                        <h3 class="level-title"><?=$skill['title']?></h3>
                        <div class="level-bar">
                            <div class="level-bar-inner" data-level="<?=$skill['level'] ?>%">
                            </div>
                        </div><!--//level-bar-->
                    </div><!--//item-->
                <?php endforeach; ?>
            </div>
        </section><!--//skills-section-->
        <section class="comment-section section">
            <div class="user-comments">
                <ol>
                <?php foreach ($connection->getComments() as $comment): ?>
                <?php if (strpos($comment['comment'], "редиска")) continue; ?>
                    <li>
                        <div class="user-comment">
                            <span class="user-comment-name"><?= $comment['name']?></span>
                            <span class="user-comment-date"><?= $comment['date_submit']?></span>
                            <br/>
                            <span class="user-comment-comment"><?= $comment['comment']?></span>
                        </div>
                    </li>
                <?php endforeach; ?>
                </ol>
            </div>
            <div class="input-area">
                <form method="post" action="controllers/commentaction.php">
                    <span>Please enter your name: </span>
                    <br />
                    <input class="input-area-name" type="text" name="name" />
                    <br />
                    <span>Please enter your message</span>
                    <textarea name="comment"></textarea>
                    <input class="input-area-button" type="submit" />
                </form>
            </div>

        </section>
    </div><!--//main-body-->
</div>

<footer class="footer">
    <div class="text-center">
        <!--/* This template is released under the Creative Commons Attribution 3.0 License. Please keep the attribution link below when using for your own project. Thank you for your support. :) If you'd like to use the template without the attribution, you can check out other license options via our website: themes.3rdwavemedia.com */-->
        <small class="copyright">Designed with <i class="fa fa-heart"></i> by <a href="http://themes.3rdwavemedia.com" target="_blank">Xiaoying Riley</a> for developers</small>
    </div><!--//container-->
</footer><!--//footer-->

<!-- Javascript -->
<script type="text/javascript" src="assets/plugins/jquery-1.11.3.min.js"></script>
<script type="text/javascript" src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>
<!-- custom js -->
<script type="text/javascript" src="assets/js/main.js"></script>
</body>
</html> 


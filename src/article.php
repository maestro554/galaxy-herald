<?php
include('./templates/head.tpl');
include('./templates/header-logo.tpl');

require_once "functions.php";

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    echo "<p>Новость не найдена</p>";
    exit;
}

$id = (int)$_GET['id'];
$newsItem = getNewsById($id);

if (!$newsItem) {
    echo "<p>Новость не найдена</p>";
} else {
?>
    <div class="header-border"></div>
    <main>

        <div class="page-path">
            <p>
                Главная / <span class="article-name">
                    <?= htmlspecialchars($newsItem['title']) ?>
                </span>
            </p>
        </div>
        <div class="single-news">
            <div class="single-news__title">
                <?= htmlspecialchars($newsItem['title']) ?>
            </div>
            <div class="single-news__date">
                <?= (new DateTime($newsItem['date']))->format('d.m.Y') ?>
            </div>
            <div class="single-news__description">
                <div class="single-news__text-container">
                    <div class="text-container__title">
                        <?= nl2br($newsItem['announce']) ?>
                    </div>
                    <div class="text-container__text">
                        <?= nl2br($newsItem['content']) ?>
                    </div>
                    <div class="btn-main-page">
                        <a href="index.php"><span class="arrow"></span>назад к новостям</a>
                    </div>
                </div>
                <div class="single-news__img">
                    <img src="images/<?= htmlspecialchars($newsItem['image']) ?>" alt="<?= htmlspecialchars($newsItem['title']) ?>">
                </div>
                
            </div>
        </div>
    </main>
<?php
}

include('./templates/footer.tpl');
$conn->close();

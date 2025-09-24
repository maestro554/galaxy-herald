<?php
include('./templates/head.tpl');         //HTML                                   
include('./templates/header-logo.tpl');  //HTML logo

require_once "functions.php";
$latestNew = getNews(1);

$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
if ($page < 1) $page = 1;

// 2. Кол-во новостей на странице
$limit = 4;
$offset = ($page - 1) * $limit;

// 3. Достаем новости
$fourNew = getNewsPag($limit, $offset);

// 4. Считаем общее количество новостей
$totalNews = getNewsCount();
$totalPages = ceil($totalNews / $limit);
?>

<main>

<?php foreach ($latestNew as $newsItem): ?>
    <div class="main__latestNew">
        <div class="latestNew__title"><?= htmlspecialchars($newsItem['title']) ?></div>
        <div class="latestNew__img">
            <img src="images/<?= htmlspecialchars($newsItem['image']) ?>" alt="<?= htmlspecialchars($newsItem['title']) ?>">
        </div>
        <div class="latestNew__subtext"><?= $newsItem['announce'] ?></div>
    </div>
<?php endforeach; ?>


<div class="main__news">
    <p>Новости</p>
    <div class="news-container">
        <?php foreach ($fourNew as $newsItem): ?>            
            <div class="news-item">
                <div class="news-item__date">
                    <p>
                        <?= (new DateTime($newsItem['date']))->format('d.m.Y') ?>
                    </p>
                </div>
                <div class="news-item__description">
                    <div class="news-item__title">
                        <p>
                            <?= ($newsItem['title']) ?>
                        </p>
                    </div>
                    <div class="news-item__announce">
                        <p>
                            <?= ($newsItem['announce']) ?>
                        </p>
                    </div>
                </div>
                <div class="news-item__btn">
                    <a href="article.php?id=<?= $newsItem['id'] ?>">Подробнее <span class="arrow"></span></a>
                </div>
            </div>
        <?php endforeach; ?>            
    </div>
    <div class="main__news-pagination">
        <?php
    // всегда первые 3 кнопки
    for ($i = 1; $i <= min(3, $totalPages); $i++): ?>
        <a href="?page=<?= $i ?>" class="<?= ($i == $page) ? 'active' : '' ?>">
            <?= $i ?>
        </a>
    <?php endfor; ?>

    <?php if ($page > 4): ?>
        <span class="dots">...</span>
    <?php endif; ?>

    <?php if ($page > 3 && $page <= $totalPages): ?>
        <a href="?page=<?= $page ?>" class="active"><?= $page ?></a>
    <?php endif; ?>

    <?php if ($page < $totalPages): ?>
        <a href="?page=<?= $page + 1 ?>" class="next"></a>
    <?php endif; ?>
    </div>
</div>


</main>



<?php
include('./templates/footer.tpl');       //HTML
$conn->close();
?>


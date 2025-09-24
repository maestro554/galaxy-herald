<?php
require_once "db.php";

function getNews($limit = 1) {
    global $conn;

    // Получаем новости, отсортированные по дате по убыванию
    $sql = "SELECT id, date, title, announce, image FROM news ORDER BY date DESC LIMIT " . intval($limit);
    $result = $conn->query($sql);

    $news = [];
    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $news[] = $row; // добавляем каждую строку как массив
        }
    }

    return $news; // массив массивов
}

function getNewsPag($limit, $offset = 0) {
    global $conn;
    $sql = "SELECT * FROM news ORDER BY date DESC LIMIT ? OFFSET ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $limit, $offset);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_all(MYSQLI_ASSOC);
}

function getNewsCount() {
    global $conn;
    $sql = "SELECT COUNT(*) as cnt FROM news";
    $result = $conn->query($sql);
    return $result->fetch_assoc()['cnt'];
}

function getNewsById($id) {
    global $conn;
    $stmt = $conn->prepare("SELECT * FROM news WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_assoc();
}

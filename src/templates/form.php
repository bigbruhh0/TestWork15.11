<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Добавить поездку</title>
    <script src="../assets/script.js"></script>
</head>
<body>
    <h1>Добавить поездку</h1>
    <form id="add-trip-form">
        <label>Регион:
            <select id="region-select"></select>
        </label>
        <br>
        <label>Курьер:
            <select id="courier-select"></select>
        </label>
        <br>
        <label>Дата выезда:
            <input type="date" id="departure-date">
        </label>
        <br>
        <button type="submit">Добавить</button>
    </form>
    <div id="response"></div>
    <div class="menu-button-container">
    <a href="/index.php" class="btn btn-primary">Главное меню</a>
    </div>
</body>
</html>

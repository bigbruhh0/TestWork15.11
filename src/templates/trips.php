<!DOCTYPE html>
<html lang="en">
<head>

    <title>Расписание поездок</title>
    <script src="../assets/script.js" defer></script>

</head>
<body>
    <h1>Расписание поездок</h1>
    <div class="filter-container">
        <label>
            Фильтр по дате выезда:
            <input type="date" id="filter-departure-date">
        </label>
        <label>
            Фильтр по дате прибытия:
            <input type="date" id="filter-arrival-date">
        </label>
        <button id="filter-btn" class="btn">Применить</button>
    </div>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Регион</th>
                <th>Курьер</th>
                <th>Дата выезда</th>
                <th>Дата прибытия</th>
            </tr>
        </thead>
        <tbody id="trips-table">

        </tbody>
    </table>
    <div class="menu-button-container">
        <a href="/index.php" class="btn">Главное меню</a>
    </div>
</body>
</html>

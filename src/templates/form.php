<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Добавить поездку</title>
    <script src="../assets/script.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Добавить поездку</h1>
        <form id="add-trip-form">
            <div class="mb-3">
                <label for="region-select" class="form-label">Регион:</label>
                <select id="region-select" class="form-select" aria-label="Регион">

                </select>
            </div>

            <div class="mb-3">
                <label for="courier-select" class="form-label">Курьер:</label>
                <select id="courier-select" class="form-select" aria-label="Курьер">

                </select>
            </div>

            <div class="mb-3">
                <label for="departure-date" class="form-label">Дата выезда:</label>
                <input type="date" id="departure-date" class="form-control" aria-label="Дата выезда">
            </div>

            <button type="submit" class="btn btn-primary">Добавить</button>
        </form>

        <div id="response" class="mt-3"></div>

        <div class="mt-4">
            <a href="/index.php" class="btn btn-secondary">Главное меню</a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Расписание поездок</title>
    <script src="../assets/script.js" defer></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            overflow: hidden;
        }

        .table-container {
            max-height: 400px;
            overflow-y: auto;
            margin-bottom: 20px;
        }

        .filter-container {
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            table-layout: fixed;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Расписание поездок</h1>

        <div class="filter-container mb-4">
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="filter-departure-date" class="form-label">Фильтр по дате выезда:</label>
                    <input type="date" id="filter-departure-date" class="form-control">
                </div>
                <div class="col-md-6">
                    <label for="filter-arrival-date" class="form-label">Фильтр по дате прибытия:</label>
                    <input type="date" id="filter-arrival-date" class="form-control">
                </div>
            </div>
            <div>
            <button id="filter-btn" class="btn btn-primary">Применить</button>

            <a href="/index.php" class="btn btn-secondary menu-button-container">Главное меню</a>
            </div>
        </div>

        <div class="table-container">
            <table class="table table">
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
        </div>     
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

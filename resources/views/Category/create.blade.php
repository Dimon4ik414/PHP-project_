<!DOCTYPE html>
<html>
<head>
    <title>Создать категорию</title>
<body>
    <div class="container mt-5">
        <form action="/categories" method="POST">
            @csrf
            <div class="mb-3">
                <label>Название</label>
                <input type="text" name="name" class="form-control" required>
            </div>
            
            <div class="mb-3">
                <label>Slug</label>
                <input type="text" name="slug" class="form-control" required>
            </div>
            
            <div class="mb-3">
                <label>Описание</label>
                <textarea name="description" class="form-control" rows="3"></textarea>
            </div>

            <div class="mb-3">
                <label>Порядок сортировки</label>
                <input type="number" name="sort_order" class="form-control" value="0">
            </div>
            
            <button type="submit" class="btn btn-primary">Сохранить</button>
            <a href="/categories" class="btn btn-secondary">Назад</a>
        </form>
    </div>
</body>
</html>
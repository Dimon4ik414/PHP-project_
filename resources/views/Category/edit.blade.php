<!DOCTYPE html>
<html>
<head>
    <title>Редактировать категорию</title>
</head>
<body>
    <div class="container mt-5">
        <form action="/categories/{{ $category->id }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="mb-3">
                <label>Название</label>
                <input type="text" name="name" class="form-control" value="{{ $category->name }}" required>
            </div>
            
            <div class="mb-3">
                <label>Slug</label>
                <input type="text" name="slug" class="form-control" value="{{ $category->slug }}" required>
            </div>
            
            <div class="mb-3">
                <label>Описание</label>
                <textarea name="description" class="form-control" rows="3">{{ $category->description }}</textarea>
            </div>
            
            <div class="mb-3">
                <label>Порядок сортировки</label>
                <input type="number" name="sort_order" class="form-control" value="{{ $category->sort_order }}">
            </div>
            
            <button type="submit" class="btn btn-primary">Обновить</button>
            <a href="/categories" class="btn btn-secondary">Назад</a>
        </form>
    </div>
</body>
</html>
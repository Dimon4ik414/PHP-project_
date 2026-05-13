<!DOCTYPE html>
<html>
<head>
    <title>Категории</title>
</head>
    <title>Категории</title>
    <div class="container mt-5">
        <a href="/categories/create" class="btn btn-success mb-3">Создать</a>

        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Название</th>
                    <th>Slug</th>
                    <th>Действия</th>
                </tr>
            </thead>
            <tbody>
                @foreach($categories as $category)
                <tr>
                    <td>{{ $category->id }}</td>
                    <td>{{ $category->name }}</td>
                    <td>{{ $category->slug }}</td>
                    <td>
                        <a href="/categories/{{ $category->id }}/edit" class="btn btn-sm btn-primary">Ред.</a>
                        <form action="/categories/{{ $category->id }}" method="POST" style="display:inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Удалить?')">Уд.</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>

# Задание на собеседование на должность «Программист-разработчик»

**1. Функция.**

Реализуйте функцию, которая получает на вход URL строку вида

[http://example.com/app.php?id=10&type=payment&status=paid](http://example.com/app.php?id=10&type=payment&status=paid)

и возвращает массив всех составляющих. Возможно использование любых методов PHP.

*Пример результата выполнения:*
```
Array (
    [scheme] => http
    [host] => example.com
    [path] => /app.php
    [query] => id=10&type=payment&status=paid
    [id] => 10
    [type] => payment
    [status] => paid
)
```

**2. Сортировка.**

Выполните сортировку массива следующей структуры по полю "date" (по убыванию):
```
Array (
    Array (
        "name" => "test1",
        "date" => "18.05.2018 18:32:45" // dd.mm.YYYY HH:ii:ss
    ),
    Array (…),
)
```
Выведите информацию из отсортированного массива в формате:

"name" от "date (формат `YYYY-mm-dd HH:ii:ss`)"

Возможно использование любых методов PHP.

**3. API.**

Ссылка: [https://online.moysklad.ru/](https://online.moysklad.ru/)

Логин: `admin@kit-cons1`

Пароль: `17c5e8b29d`

Документация API: [https://online.moysklad.ru/api/remap/1.2/doc](https://online.moysklad.ru/api/remap/1.2/doc)

a) Выведите значение поля «Комментарий» в заказе покупателя.

b) Выведите список позиций в заказе покупателя.

c) Измените поле «Комментарий» в заказе.
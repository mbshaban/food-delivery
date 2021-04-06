<form action="/sender" method="post">
    <input type="text" name="content">
    <input type="submit">
    {{csrf_field()}}
</form>

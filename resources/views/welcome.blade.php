<script>
    axios.post('binance.com/api/v1/login', {
        'phone': document.getElementById('phone'),
    }).then((data) => {
        document.getElementById("token").innerHTML = data.request
    });

    /*[{"id": 1,"name": "mc"},{"id": 2,"name": "pr"}]*/
</script>
<form action="">
    <input type="number" name="phone" id="phone">
    <input type="submit">
</form>
<h1 id="token"></h1>

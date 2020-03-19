

<input id="id" oninput="alert('here')">
<button onclick="input()">click</button>

<script>
    var i=0;
    function input()
    {
        document.getElementById("id").value=i;
        ++i;
    }

</script>
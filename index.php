
<ul >
    <li >
        <a href="#" onclick="migrarEmpleados()">Active</a>
    </li>
    <li >
        <a href="#">Link</a>
    </li>
    <li >
        <a href="#">Link</a>
    </li>
    <li >
        <a href="#">Disabled</a>
    </li>
</ul>
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script>
    function migrarEmpleados(){
    $.ajax({
        data: "",
        url: "Vista/Empleado.php",
        method: "get",
        success: function(data) {
            console.log(data);
            /*La variable data contiene la respuesta de tu script PHP*/
        }
    });
    }
</script>
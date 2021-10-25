<!DOCTYPE html>
<!--
This program is the front-end HTML for Larson's code example.

This code creates input and output spaces for the mySQL query, as well as some basic
labels.
The input can be either a parent part name (drivetrain, suspension or cooling_system)or a part attribute (metal or rubber).
This code also parses the string returned from the AJAX call into seperate elements to display.

This code was written by Larson Long.
-->

<style>
<?php include 'nysus_css.css'; ?>
</style>

<html>

    <script>
        // function to call AJAX and all that
        function parentChildQuery() {
            var inp = document.getElementById("input_box").value;
            var xhttp = new XMLHttpRequest();
            parent_output = [];

            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    var out = this.responseText;
                    parent_output = out.split('#');
                    document.getElementById("parent").innerHTML = parent_output[0]; //parent output
                    document.getElementById("children").innerHTML = parent_output[1]; //child output
                }
            };
            xhttp.open("GET", "nysus_ajax.php?q=" + inp, true);
            xhttp.send();
        }
    </script>

    <body>

        <!-- initialize interface -->
        <h1>
        Parent/Child Lookup
        </h1>
        <div class="split">
            <div class="leftCol">
                <p>
                Name/attribute
                </p>
                <input type="text" id="input_box" value=""></input>
                <button onclick="parentChildQuery()">Lookup</button>
            </div>
            
            <div class= "rightCol">
                <p>
                parents
                </p>
                <textarea id="parent" name="parent_box" rows="4" cols="50">
                N/A
                </textarea>
                <p>
                children
                </p>
                <textarea id="children" name="children_box" rows="4" cols="50">
                N/A
                </textarea>
            </div>
        </div>
    </body>
</html>


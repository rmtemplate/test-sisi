<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Test No 1</title>
</head>

<body>
    <div style="margin-bottom: 10px;">
        <h2>Test No 1</h2>

        <div>
            <input type="number" id="inp-NUMBER"> <button id="inp-BUTTON">Klik</button>
        </div>
        <div id="RESULT">

        </div>
    </div>

    <div style="margin-bottom: 10px;">
        <h2>Test No 2</h2>

        <div>
            <input type="number" id="inp-NUMBER-2"> <button id="inp-BUTTON-2">Klik</button>
        </div>
        <div id="RESULT-2">

        </div>
    </div>
</body>

<script>
    // Soal No 1
    function pattern(number) {
        var pattern = '';
        for (var i = 1; i <= number; i++) {

            for (var j = 1; j <= number - 1; j++) {
                pattern += ' ';
            }

            for (var k = 0; k < i; k++) {
                pattern += "*"
            }

            pattern += "<br>";

        }
        console.log(pattern);

        var result = document.getElementById("RESULT");
        result.innerHTML = pattern;


    }

    var input = document.getElementById("inp-NUMBER");
    var button = document.getElementById("inp-BUTTON");
    button.onclick = function () {
        pattern(input.value);
        false;
    }

    // End Soal No 1



    // Soal No 2
    function prima(number) {
        var i = 0;
        var cek;
        var bilangan = 2;
        var result = "";
        while (i < number) {
            cek = 0;
            for (let j = 2; j <= bilangan; j++) {
                if (bilangan % j == 0) {
                    cek++;
                }
            }
            if (cek == 1) {
                result = bilangan;

                if (i < number - 1) {
                    result += ","
                } else {
                    result +=".";
                }
                document.getElementById("RESULT-2").innerHTML += result;
                i++;
            }
            bilangan++;
        }
    }

    var input2 = document.getElementById("inp-NUMBER-2");
    var button2 = document.getElementById("inp-BUTTON-2");
    button2.onclick = function () {
        document.getElementById("RESULT-2").innerHTML = "";
        prima(input2.value);
        false;
    }

    // End Soal No 2

</script>

</html>

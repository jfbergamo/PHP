<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Elefante</title>
    <style>
        /* Reset di base */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* Corpo della pagina */
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f0f4f8;
            color: #333;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        /* Contenitore del form */
        form {
            background-color: #ffffff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            text-align: center;
            width: 100%;
            max-width: 400px;
        }

        /* Titolo del form */
        form p {
            font-size: 18px;
            margin-bottom: 20px;
            color: #4CAF50;
        }

        /* Campo input numerico */
        input[type="number"] {
            padding: 10px;
            border: 2px solid #4CAF50;
            border-radius: 8px;
            width: 80%;
            margin: 10px 0;
            font-size: 16px;
            text-align: center;
        }

        /* Pulsanti */
        button {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 12px 20px;
            margin: 10px;
            border-radius: 8px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s, transform 0.3s;
        }

        /* Effetto hover sui pulsanti */
        button:hover {
            background-color: #45a049;
            transform: scale(1.05);
        }

        /* Pulsante reset */
        button[type="reset"] {
            background-color: #f44336;
        }

        /* Effetto hover per il pulsante reset */
        button[type="reset"]:hover {
            background-color: #e53935;
        }
    </style>
</head>
<body>
    <form method="post" action="/Bergamasco/elefanti.php">
        Quanti elefanti vuoi veder dondolare?
        <input type="number" name="elefanti" min="1" max="200" value="3">
        <br>
        <button type="submit">Conferma!</button>
        <button type="reset">Cancella!</button>
    </form>
</body>
</html>
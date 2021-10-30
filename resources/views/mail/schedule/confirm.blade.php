<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700">

    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <style>
        * {
            margin: 0;
            border: none;
            font-family: 'Source Sans Pro', 'Helvetica Neue', Helvetica, Arial, sans-serif;
        }

        main {
            margin: 5rem auto;
            max-width: 55rem;
            background: #ccc;
            padding: 5rem;
            color: #121212;
        }

        p,
        li {
            font-size: 1.1rem;
        }

        ul {
            margin-top: 2rem;
            padding: 0;
            margin-left: 0;
        }

        li {
            line-height: 2rem;
            list-style: none;
        }

        li>span {
            font-weight: 700;
        }

    </style>
</head>

<body>
    <main>
        <p>Olá, {{ $schedule->specialist->name }}!</p>

        <p>
            Um usuário acabou de confirmar o agendamento, veja abaixo os detalhes:
        </p>
        <ul>
            <li><span>Data:</span> {{ convertDateUSAtoBrazil($schedule->date) }}</li>
            <li><span>Horário:</span> {{ $schedule->init_hour }} - {{ $schedule->final_hour }}</li>
            <li><span>Valor:</span> R$ {{ $schedule->price }}</li>
            <li><span>Local:</span> {{ $schedule->place_id != null ? $schedule->place->full_address : 'Atendimento online' }}
            </li>
        </ul>
    </main>
</body>

</html>

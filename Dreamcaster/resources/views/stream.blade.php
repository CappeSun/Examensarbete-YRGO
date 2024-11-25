<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Dreamcaster</title>
    <script type="text/javascript">
        const laraName = '<?= $user['name']; ?>';
        const laraId = <?= $user['id']; ?>;
        const laraChannel = '<?= $channel; ?>';
        const assetPath = "{{ asset('') }}";
    </script>
    <link href="https://vjs.zencdn.net/8.16.1/video-js.css" rel="stylesheet">
    @vite(['resources/js/app.js'])
</head>
<body>
    <div id="app" class="app">
        <div class="Headerr">
            <Headerr/>
        </div>
        <div class="Stream">
            <Stream/>
        </div>
        <div class="Chat">
            <Chat/>
        </div>
    </div>
</body>
<style type="text/css">
    body{
        height: 100vh;
        width: 100vw;
        margin: 0;
        color: rgb(250, 250, 250);
        background-color: rgb(50, 50, 50);
        font-family: RodinNTLG Pro;
        font-weight: 200;
    }
    button, input{
        font-family: RodinNTLG Pro;
    }
    .app{
        height: 100vh;
        width: 100vw;
        margin: 0;
        display: grid;
        grid-template-columns: 80vw 20vw;
        grid-template-rows: 4vw calc(100vh - 4vw);
        grid-column-gap: 0;
        grid-row-gap: 0;
    }
    .Headerr{
        grid-area: 1 / 1 / 2 / 3;
        margin: 0;
    }
    .Stream{
        grid-area: 2 / 1 / 3 / 2;
        margin: 0;
    }
    .Chat{
        grid-area: 2 / 2 / 3 / 3;
        margin: 0;
    }
    /* FONTS */
    @font-face{
        font-family: "NewRodin Pro";
        src:
            local("FOT-NewRodin Pro B"),
            url("fonts/FOT-NewRodin Pro B.otf");
        font-weight: 500;
    }
    @font-face{
        font-family: "NewRodin Pro";
        src:
            local("FOT-NewRodin Pro EB"),
            url("fonts/FOT-NewRodin Pro EB.otf");
        font-weight: 900;
    }
    @font-face{
        font-family: "NewRodin Pro";
        src:
            local("FOT-NewRodin Pro M"),
            url("fonts/FOT-NewRodin Pro M.otf");
        font-weight: 200;
    }
    @font-face{
        font-family: "RodinNTLG Pro";
        src:
            local("FOT-RodinNTLG Pro M"),
            url("fonts/FOT-RodinNTLG Pro M.otf");
        font-weight: 200;
    }
    @font-face{
        font-family: "RodinNTLG Pro";
        src:
            local("FOT-RodinNTLG Pro B"),
            url("fonts/FOT-RodinNTLG Pro B.otf");
        font-weight: 500;
    }
    @font-face{
        font-family: "RodinNTLG Pro";
        src:
            local("FOT-RodinNTLG Pro EB"),
            url("fonts/FOT-RodinNTLG Pro EB.otf");
        font-weight: 900;
    }
</style>
</html>
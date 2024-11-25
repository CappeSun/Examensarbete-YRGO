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
        const assetPath = "{{ asset('') }}";
    </script>
    @vite(['resources/js/app.js'])
</head>
<body>
    <div id="app" class="app">
        <div class="Headerr">
            <Headerr/>
        </div>
        <div class="StreamList">
            <stream-list/>
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
        grid-template-columns: 100vw;
        grid-template-rows: 4vw 1fr;
        grid-column-gap: 0;
        grid-row-gap: 0;
    }
    .Headerr{
        grid-area: 1 / 1 / 2 / 3;
        margin: 0;
    }
    .StreamList{
        margin: 0;
        overflow: scroll;
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
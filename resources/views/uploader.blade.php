<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <title>Trains!</title>
    <link rel="stylesheet" href="/resources/assets/css/normalize.css">
    <link rel="stylesheet" href="/resources/assets/css/skeleton.css">
</head>
<body>
    <div class="container">
        <h1>Hello, {{ $version }}</h1>

        {{--@if (count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif--}}

        <div id="form" class="section">
            <form action="/" enctype="multipart/form-data" method="POST">
                <input type="file" name="csv_upload" id="csv-upload" accept="text/csv">
                <input type="submit" value="Upload CSV">
            </form>
        </div>
        <div id="results" class="section">
            <table class="u-full-width">
                @if ($header)
                    <thead>
                    <tr>
                    @foreach($header as $item)
                        <td>{{$item}}</td>
                    @endforeach
                    </tr>
                    </thead>
                @endif
                @if ($data)
                    <tbody>
                    @foreach($data as $key=>$value)
                        {{ $key }}
                        {{ $value }}
                        <tr>
                            <td>Dave Gamache</td>
                            <td>26</td>
                            <td>Male</td>
                            <td>San Francisco</td>
                        </tr>
                    @endforeach
                    </tbody>
                @endif
            </table>

        </div>
    </div>
</body>
<script src="../resources/assets/scripts/main.js"></script>
</html>
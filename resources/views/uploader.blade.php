<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <title>Trains!</title>
    <!-- Would normally self host -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/skeleton/2.0.4/skeleton.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/skeleton/2.0.4/skeleton.min.css">
</head>
<body>
    <div class="container">
        <h1>Trains!</h1>

        @if ($errors && (count($errors) > 0))
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div id="form" class="section">
            <form id="uploader" action="/" enctype="multipart/form-data" method="POST">
                <input type="file" name="csv_upload" id="csv-upload" accept="text/csv">
                <input type="submit" value="Upload CSV">
            </form>
        </div>
        <div id="results" class="section">
            <table class="u-full-width">
                    <thead>
                    <tr>
                        <td>ID</td>
                        <td>Train Line</td>
                        <td>Route Name</td>
                        <td>Run Number</td>
                        <td>Operator ID</td>
                    </tr>
                    </thead>
                @if ($data)
                    <tbody>
                    @foreach($data as $key=>$value)
                        <tr>
                            @foreach($value as $column)
                            <td>{{ $column }}</td>
                            @endforeach
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
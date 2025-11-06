<!DOCTYPE html>
<html>
<head>
    <title>Image Test</title>
</head>
<body>
    <h1>Image Path Test</h1>
    
    <h2>Settings Data:</h2>
    <pre>{{ json_encode($webSettings, JSON_PRETTY_PRINT) }}</pre>
    
    <h2>Image Path:</h2>
    <p><strong>{{ $webSettings->image }}</strong></p>
    
    <h2>Full URL:</h2>
    <p><strong>{{ url($webSettings->image) }}</strong></p>
    
    <h2>Asset URL:</h2>
    <p><strong>{{ asset($webSettings->image) }}</strong></p>
    
    <h2>Image Display:</h2>
    <img src="{{ $webSettings->image }}" alt="Test" style="width: 200px; height: 200px; border: 2px solid red;">
    
    <h2>With Asset Helper:</h2>
    <img src="{{ asset($webSettings->image) }}" alt="Test" style="width: 200px; height: 200px; border: 2px solid blue;">
    
    <h2>File Exists Check:</h2>
    <p>{{ file_exists(public_path($webSettings->image)) ? 'YES - File exists!' : 'NO - File not found!' }}</p>
    
    <h2>Public Path:</h2>
    <p>{{ public_path($webSettings->image) }}</p>
</body>
</html>

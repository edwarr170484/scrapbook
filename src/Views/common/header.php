<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Фотогаллерея | <?php echo $title;?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta content="true" name="HandheldFriendly" />
    <meta content="width" name="MobileOptimized" />
    <meta content="yes" name="apple-mobile-web-app-capable" />
    <meta name="description" content="">
    <link rel="shortcut icon" type="image/ico" href="/assets/images/icons/favicons/favicon.ico">
    <link rel="apple-touch-icon" sizes="180x180" href="/assets/images/icons/favicons/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/assets/images/icons/favicons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/assets/images/icons/favicons/favicon-16x16.png">
    <link rel="stylesheet" href="/assets/css/styles.css" />
</head>
<body class="d-flex flex-column h-100">
<header>
  <!-- Fixed navbar -->
  <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
    <div class="container-fluid">
      <a class="navbar-brand d-flex align-items-center gap-1" href="/">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-2"><path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z"></path><circle cx="12" cy="13" r="4"></circle></svg>
        <strong>Фотогаллерея</strong>
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse ml-auto flex-grow-0" id="navbarCollapse">
        <button class="btn btn-outline-success" type="submit" onclick="album.add()">Добавить альбом</button>
      </div>
    </div>
  </nav>
</header>
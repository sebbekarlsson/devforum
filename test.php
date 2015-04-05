<meta charset="utf-8">
<?php
  $content = "
  <h1>Att skriva för webben</h1>
  <p>Vem skriver du för? Tänk på vem som ska läsa texten.</p>

  <h2>En snabb sammanfattning</h2>
  <ul>
      <li>Tänk dig in i mottagarens perspektiv.</li>
      <li>Skapa ett innehåll som är luftigt och lättläst, och där det viktigaste kommer först.</li>
      <li>Formatera innehållet korrekt.</li>
      <li>Skriv självförklarande länktexter</li>
      <li>Skriv alternativtexter till betydelsebärande bilder.</li>
  </ul>

  <h2>Hur läser vi på webben?</h2>
  <p>
    Skumläser
    De två första styckena är oerhört viktiga. Det är lätt att missa nyckelord som inte ligger i början av rubriker, underrubriker och stycken.
    Klassificerar
    Vi undviker ointressant information som reklam. Vi undviker till exempel bilder som ser ut som annonser.
    Ord-för-ord
    Vi börjar läsa ord för ord först när vi hittar något intressant.
  </p>
  ";

  $ingress = false;

  $first = explode("</p>", $content)[0]; $first = explode("<p>", $first)[1];

  $paras = substr_count($content, "</p>");
  $uls = substr_count($content, "</ul>");
  $ols = substr_count($content, "</ol>");

  if($paras > 1 || $uls >= 1 || $ols >= 1){
    $first =  "<p class='ingress'>$first</p>";
  }

  echo $first;
?>
